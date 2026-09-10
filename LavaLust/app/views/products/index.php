<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 30px;
            color: #222;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 5px;
            color: white;
            display: inline-block;
        }

        .add-btn {
            background: #198754;
        }

        .logout-btn {
            background: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
            font-weight: bold;
        }

        .edit {
            color: #0d6efd;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete {
            color: #dc3545;
            text-decoration: none;
        }

        .empty {
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Product Management</h1>

        <div class="buttons">
            <a href="<?= site_url('products/create'); ?>" class="btn add-btn">
                + Add Product
            </a>

            <a href="<?= site_url('logout'); ?>" class="btn logout-btn">
                Logout
            </a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($products)): ?>

            <?php foreach ($products as $product): ?>

                <tr>
                    <td><?= $product['id']; ?></td>

                    <td>
                        <?= htmlspecialchars($product['product_name']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['description']); ?>
                    </td>

                    <td>
                        ₱<?= number_format($product['price'], 2); ?>
                    </td>

                    <td>
                        <?= $product['quantity']; ?>
                    </td>

                    <td>
                        <?= $product['created_at']; ?>
                    </td>

                    <td>
                        <a
                            href="<?= site_url('products/edit/' . $product['id']); ?>"
                            class="edit">
                            Edit
                        </a>

                        <a
                            href="<?= site_url('products/delete/' . $product['id']); ?>"
                            class="delete"
                            onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7" class="empty">
                    No products found.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>