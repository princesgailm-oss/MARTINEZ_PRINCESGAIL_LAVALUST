<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e0f2fe; /* Light Sky Blue Background */
            color: #0f172a;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-bar h1 {
            margin: 0;
            font-size: 32px;
            color: #0369a1; /* Darker Blue */
            font-weight: 700;
        }

        .action-btns {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background-color: #0284c7; /* Sky Blue Accent */
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
        }

        .btn-add:hover {
            background-color: #0369a1;
            transform: translateY(-1px);
        }

        .btn-logout {
            background-color: #ef4444; /* Red Logout */
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
        }

        .btn-logout:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.1);
            border: 1px solid #bae6fd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead tr {
            background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); /* Blue to Sky Blue Header */
            color: #ffffff;
        }

        th {
            padding: 14px 16px;
            font-size: 14px;
            font-weight: 600;
        }

        th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        td {
            padding: 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f0f9ff;
        }

        .btn-edit {
            background-color: #eab308; /* Yellow Edit */
            color: #ffffff;
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 6px;
            margin-right: 4px;
        }

        .btn-edit:hover {
            background-color: #ca8a04;
        }

        .btn-delete {
            background-color: #ef4444; /* Red Delete */
            color: #ffffff;
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 6px;
        }

        .btn-delete:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header-bar">
        <h1>Product Management</h1>
        <div class="action-btns">
            <a href="<?= site_url('products/create'); ?>" class="btn btn-add">+ Add Product</a>
            <a href="<?= site_url('logout'); ?>" class="btn btn-logout">Logout</a>
        </div>
    </div>

    <div class="card">
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
                            <td><?= htmlspecialchars($product['id']); ?></td>
                            <td><?= htmlspecialchars($product['name']); ?></td>
                            <td><?= htmlspecialchars($product['description']); ?></td>
                            <td><?= number_format($product['price'], 2); ?></td>
                            <td><?= htmlspecialchars($product['quantity']); ?></td>
                            <td><?= htmlspecialchars($product['created_at']); ?></td>
                            <td>
                                <a href="<?= site_url('products/edit/' . $product['id']); ?>" class="btn btn-edit">Edit</a>
                                <a href="<?= site_url('products/delete/' . $product['id']); ?>" class="btn btn-delete" onclick="return confirm('Sigurado ka bang gusto mong burahin ito?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #64748b;">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>