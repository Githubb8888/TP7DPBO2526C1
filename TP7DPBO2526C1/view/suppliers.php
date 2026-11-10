<?php
$editRow = $editId ? $supplier->getById($editId) : null;
$rows = $supplier->getAll();
?>
<h2>Suppliers</h2>

<form method="post" action="index.php?page=suppliers" class="card">
    <h3><?= $editRow ? 'Edit Supplier' : 'Add Supplier' ?></h3>
    <input type="hidden" name="action" value="<?= $editRow ? 'update' : 'create' ?>">
    <?php if ($editRow): ?>
        <input type="hidden" name="id" value="<?= $editRow['id'] ?>">
    <?php endif; ?>
    <label>Name</label>
    <input type="text" name="name" required value="<?= htmlspecialchars($editRow['name'] ?? '') ?>">
    <label>Phone</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($editRow['phone'] ?? '') ?>">
    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($editRow['email'] ?? '') ?>">
    <div class="actions">
        <button type="submit"><?= $editRow ? 'Update' : 'Save' ?></button>
        <?php if ($editRow): ?>
            <a href="index.php?page=suppliers" class="btn-cancel">Cancel</a>
        <?php endif; ?>
    </div>
</form>

<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['phone'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['email'] ?? '') ?></td>
            <td class="row-actions">
                <a href="index.php?page=suppliers&edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                <form method="post" action="index.php?page=suppliers" onsubmit="return confirm('Delete this supplier?')">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$rows): ?>
        <tr><td colspan="5">No data yet.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
