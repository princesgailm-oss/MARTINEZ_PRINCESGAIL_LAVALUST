<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f3e8ff;
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            padding: 3rem 1rem;
        }
        .form-card {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .header-title {
            color: #6b21a8;
            font-weight: 700;
        }
        .btn-submit {
            background-color: #7e22ce;
            border: none;
            color: #ffffff;
            font-weight: 600;
        }
        .btn-submit:hover {
            background-color: #6b21a8;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2 class="header-title mb-4">Edit Product</h2>

            <form action="<?= site_url('products/update/' . $product['id']); ?>" method="POST">
                <div class="mb-3">
                    <label for="product_name" class="form-label font-weight-bold">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label font-weight-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label font-weight-bold">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label font-weight-bold">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($product['quantity']); ?>" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('products'); ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-submit px-4">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>