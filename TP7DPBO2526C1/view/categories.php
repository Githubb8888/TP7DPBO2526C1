<?php
$editRow = $editId ? $category->getById($editId) : null;
$rows = $category->getAll();
?>
<h2>Categories</h2>

<form method="post" action="index.php?page=categories" class="card">
    <h3><?= $editRow ? 'Edit Category' : 'Add Category' ?></h3>
    <input type="hidden" name="action" value="<?= $editRow ? 'update' : 'create' ?>">
    <?php if ($editRow): ?>
        <input type="hidden" name="id" value="<?= $editRow['id'] ?>">
    <?php endif; ?>
    <label>Name</label>
    <input type="text" name="name" required value="<?= htmlspecialchars($editRow['name'] ?? '') ?>">
    <label>Description</label>
    <input type="text" name="description" value="<?= htmlspecialchars($editRow['description'] ?? '') ?>">
    <div class="actions">
        <button type="submit"><?= $editRow ? 'Update' : 'Save' ?></button>
        <?php if ($editRow): ?>
            <a href="index.php?page=categories" class="btn-cancel">Cancel</a>
        <?php endif; ?>
    </div>
</form>

<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Description</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['description'] ?? '') ?></td>
            <td class="row-actions">
                <a href="index.php?page=categories&edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                <form method="post" action="index.php?page=categories" onsubmit="return confirm('Delete this category?')">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$rows): ?>
        <tr><td colspan="4">No data yet.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
