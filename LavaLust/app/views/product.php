<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f3e8ff;
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            padding: 3rem 1rem;
        }

        .main-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-title {
            color: #6b21a8;
            font-weight: 700;
            font-size: 2.25rem;
        }

        .btn-add {
            background-color: #7e22ce;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 6px;
        }

        .btn-add:hover {
            background-color: #6b21a8;
            color: #ffffff;
        }

        .btn-logout {
            background-color: #dc2626;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 6px;
        }

        .btn-logout:hover {
            background-color: #b91c1c;
            color: #ffffff;
        }

        .card-table-wrapper {
            background: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .custom-table thead th {
            background-color: #7e22ce;
            color: #ffffff;
            padding: 0.85rem 1rem;
            font-weight: 600;
            border: none;
        }

        .custom-table thead th:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .custom-table thead th:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .custom-table td {
            padding: 1.25rem 1rem;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>

<div class="container main-container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="header-title mb-0">
            Product Management
        </h1>

        <div class="d-flex gap-2">

            <a href="<?= site_url('products/create'); ?>"
               class="btn btn-add">
                + Add Product
            </a>

            <a href="<?= site_url('logout'); ?>"
               class="btn btn-logout">
                Logout
            </a>

        </div>
    </div>


    <!-- TABLE -->
    <div class="card-table-wrapper">

        <table class="table custom-table">

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

                <?php foreach ($products as $p): ?>

                <tr>

                    <td>
                        <?= $p['id']; ?>
                    </td>

                    <td>
                        <?= $p['product_name']; ?>
                    </td>

                    <td>
                        <?= $p['description']; ?>
                    </td>

                    <td>
                        <?= $p['price']; ?>
                    </td>

                    <td>
                        <?= $p['quantity']; ?>
                    </td>

                    <td>
                        <?= isset($p['created_at'])
                            ? $p['created_at']
                            : '—'; ?>
                    </td>

                    <td>

                        <!-- EDIT -->
                        <a href="<?= site_url('products/edit/' . $p['id']); ?>"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <a href="<?= site_url('products/delete/' . $p['id']); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7"
                        class="text-center text-muted py-5">
                        No products found.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>