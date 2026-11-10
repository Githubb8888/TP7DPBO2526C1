<?php

require_once 'config/db.php';
require_once 'class/Category.php';
require_once 'class/Supplier.php';
require_once 'class/Product.php';

try {
    $database = new Database();
    $db = $database->connect();
} catch (PDOException $e) {
    die('Database connection failed. Check config/db.php and make sure MySQL is running.');
}

$category = new Category($db);
$supplier = new Supplier($db);
$product = new Product($db);

$allowedPages = ['products', 'categories', 'suppliers'];
$page = $_GET['page'] ?? 'products';
if (!in_array($page, $allowedPages, true)) {
    $page = 'products';
}

$editId = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;
$message = $_GET['msg'] ?? null;
$error = null;
$done = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);

    try {
        if ($page === 'categories') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            if ($action === 'create') {
                $category->create($name, $description);
                $done = 'created';
            } elseif ($action === 'update') {
                $category->update($id, $name, $description);
                $done = 'updated';
            } elseif ($action === 'delete') {
                $category->delete($id);
                $done = 'deleted';
            }
        } elseif ($page === 'suppliers') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if ($action === 'create') {
                $supplier->create($name, $phone, $email);
                $done = 'created';
            } elseif ($action === 'update') {
                $supplier->update($id, $name, $phone, $email);
                $done = 'updated';
            } elseif ($action === 'delete') {
                $supplier->delete($id);
                $done = 'deleted';
            }
        } else {
            $name = trim($_POST['name'] ?? '');
            $price = $_POST['price'] ?? 0;
            $stock = (int) ($_POST['stock'] ?? 0);
            $categoryId = (int) ($_POST['category_id'] ?? 0);
            $supplierId = (int) ($_POST['supplier_id'] ?? 0);
            if ($action === 'create') {
                $product->create($name, $price, $stock, $categoryId, $supplierId);
                $done = 'created';
            } elseif ($action === 'update') {
                $product->update($id, $name, $price, $stock, $categoryId, $supplierId);
                $done = 'updated';
            } elseif ($action === 'delete') {
                $product->delete($id);
                $done = 'deleted';
            }
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            $error = 'Action failed: this record is still used by other data or violates a constraint.';
        } else {
            $error = 'Action failed because of a database error.';
        }
    }

    if ($done !== null) {
        header('Location: index.php?page=' . $page . '&msg=' . $done);
        exit;
    }
}

require 'view/header.php';
require 'view/' . $page . '.php';
require 'view/footer.php';
