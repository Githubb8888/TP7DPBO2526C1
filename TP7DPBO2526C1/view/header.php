<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Product Catalog</h1>
    <nav>
        <a href="index.php?page=products" class="<?= $page === 'products' ? 'active' : '' ?>">Products</a>
        <a href="index.php?page=categories" class="<?= $page === 'categories' ? 'active' : '' ?>">Categories</a>
        <a href="index.php?page=suppliers" class="<?= $page === 'suppliers' ? 'active' : '' ?>">Suppliers</a>
    </nav>
</header>
<main>
<?php if ($message === 'created'): ?>
    <div class="alert success">Data created successfully.</div>
<?php elseif ($message === 'updated'): ?>
    <div class="alert success">Data updated successfully.</div>
<?php elseif ($message === 'deleted'): ?>
    <div class="alert success">Data deleted successfully.</div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
