<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            color: #075c36;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button,
        .cancel {
            padding: 12px 20px;
            border-radius: 5px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: #075c36;
            color: white;
        }

        button:hover {
            background: #064a2d;
        }

        .cancel {
            background: #ddd;
            color: #222;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="form-box">

        <h1>Add Product</h1>

        <form action="<?= site_url('products/store'); ?>" method="POST">

            <label for="product_name">Product Name</label>
            <input
                type="text"
                id="product_name"
                name="product_name"
                placeholder="Enter product name"
                required
            >

            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                placeholder="Enter product description"
                required
            ></textarea>

            <label for="price">Price</label>
            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                placeholder="0.00"
                required
            >

            <label for="quantity">Quantity</label>
            <input
                type="number"
                id="quantity"
                name="quantity"
                min="0"
                placeholder="Enter quantity"
                required
            >

            <div class="buttons">

                <button type="submit">
                    Save Product
                </button>

                <a href="<?= site_url('products'); ?>" class="cancel">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>