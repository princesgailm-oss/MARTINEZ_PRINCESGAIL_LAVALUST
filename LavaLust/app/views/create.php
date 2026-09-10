<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden border border-sky-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-sky-500 to-blue-600 px-8 py-6 text-white flex justify-between items-center">
            <h2 class="text-2xl font-bold">Add New Product</h2>
            <a href="<?= site_url('products'); ?>" class="text-sky-100 hover:text-white text-sm font-medium transition">
                &larr; Back to List
            </a>
        </div>

        <!-- Form Body -->
        <form action="<?= site_url('products/store'); ?>" method="POST" class="p-8 space-y-5">
            
            <div>
                <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                <input type="text" id="product_name" name="product_name" placeholder="Enter product name" required
                    class="w-full px-4 py-2.5 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter product description"
                    class="w-full px-4 py-2.5 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price (₱)</label>
                    <input type="number" step="0.01" id="price" name="price" placeholder="0.00" required
                        class="w-full px-4 py-2.5 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="0" required
                        class="w-full px-4 py-2.5 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="<?= site_url('products'); ?>" 
                    class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 text-sm font-semibold transition">
                    Cancel
                </a>
                <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-sky-500 hover:bg-blue-600 text-white text-sm font-semibold shadow-md transition">
                    Save Product
                </button>
            </div>

        </form>
    </div>

</body>
</html>