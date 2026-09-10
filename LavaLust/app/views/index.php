<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Product Management</h2>
    <a href="<?= site_url('products/create'); ?>" class="btn btn-primary mb-3">Add New Product</a>
    <a href="<?= site_url('profile'); ?>" class="btn btn-secondary mb-3">Back to Profile</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($products)): ?>
                <?php foreach($products as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['product_name']; ?></td>
                    <td><?= $p['description']; ?></td>
                    <td><?= $p['price']; ?></td>
                    <td><?= $p['quantity']; ?></td>
                    <td>
                        <a href="<?= site_url('products/edit/'.$p['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('products/delete/'.$p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No products found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>