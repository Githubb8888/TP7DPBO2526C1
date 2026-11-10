<?php
$editRow = $editId ? $product->getById($editId) : null;
$rows = $product->getAll();
$categoryList = $category->getAll();
$supplierList = $supplier->getAll();
?>
<h2>Products</h2>

<form method="post" action="index.php?page=products" class="card">
    <h3><?= $editRow ? 'Edit Product' : 'Add Product' ?></h3>
    <input type="hidden" name="action" value="<?= $editRow ? 'update' : 'create' ?>">
    <?php if ($editRow): ?>
        <input type="hidden" name="id" value="<?= $editRow['id'] ?>">
    <?php endif; ?>
    <label>Name</label>
    <input type="text" name="name" required value="<?= htmlspecialchars($editRow['name'] ?? '') ?>">
    <label>Price</label>
    <input type="number" name="price" min="0" step="0.01" required value="<?= htmlspecialchars($editRow['price'] ?? '') ?>">
    <label>Stock</label>
    <input type="number" name="stock" min="0" required value="<?= htmlspecialchars($editRow['stock'] ?? '0') ?>">
    <label>Category</label>
    <select name="category_id" required>
        <option value="">Select category</option>
        <?php foreach ($categoryList as $c): ?>
            <option value="<?= $c['id'] ?>" <?= ($editRow && $editRow['category_id'] == $c['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Supplier</label>
    <select name="supplier_id" required>
        <option value="">Select supplier</option>
        <?php foreach ($supplierList as $s): ?>
            <option value="<?= $s['id'] ?>" <?= ($editRow && $editRow['supplier_id'] == $s['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="actions">
        <button type="submit"><?= $editRow ? 'Update' : 'Save' ?></button>
        <?php if ($editRow): ?>
            <a href="index.php?page=products" class="btn-cancel">Cancel</a>
        <?php endif; ?>
    </div>
</form>

<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Category</th><th>Supplier</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= number_format($row['price'], 2) ?></td>
            <td><?= $row['stock'] ?></td>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td><?= htmlspecialchars($row['supplier_name']) ?></td>
            <td class="row-actions">
                <a href="index.php?page=products&edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                <form method="post" action="index.php?page=products" onsubmit="return confirm('Delete this product?')">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$rows): ?>
        <tr><td colspan="7">No data yet.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
