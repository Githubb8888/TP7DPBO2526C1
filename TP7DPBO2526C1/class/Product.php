<?php

class Product
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare(
            "SELECT p.id, p.name, p.price, p.stock, p.category_id, p.supplier_id,
                    c.name AS category_name, s.name AS supplier_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             JOIN suppliers s ON p.supplier_id = s.id
             ORDER BY p.id"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $price, $stock, $categoryId, $supplierId)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO products (name, price, stock, category_id, supplier_id) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$name, $price, $stock, $categoryId, $supplierId]);
    }

    public function update($id, $name, $price, $stock, $categoryId, $supplierId)
    {
        $stmt = $this->db->prepare(
            "UPDATE products SET name = ?, price = ?, stock = ?, category_id = ?, supplier_id = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $price, $stock, $categoryId, $supplierId, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
