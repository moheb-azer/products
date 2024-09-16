<?php

namespace App\Controllers;

use App\Models\Product;
use App\Validators\ProductValidator;
use Core\App;
use Core\Database;

require_once base_path('App/Models/DVD.php');
require_once base_path('App/Models/Book.php');
require_once base_path('App/Models/Furniture.php');

class ProductController
{
    // Retrieve the database connection from the app container
    private function getDbConnection()
    {
        return App::getContainer()->resolve(Database::class);
    }

    // Dynamically get the available product types by checking which classes extend the Product class
    private function getProductTypes(): array
    {
        $productTypes = [];
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, Product::class)) {
                $productTypes[] = basename(str_replace('\\', '/', $class));
            }
        }
        return $productTypes;
    }

    // Build the fully qualified class name for a given product type
    private function getClassName($class): string
    {
        return "App\\Models\\{$class}";
    }

    // Display the list of products on the index page
    public function index(): void
    {
        $connection = $this->getDbConnection();
        $products = Product::getAll($connection);
        view('products/index.view.php', [
            'pageTitle' => 'Product List',
            'products' => $products
        ]);
    }

    // Render the form to create a new product, passing the product types to the view
    public function create()
    {
        $productTypes = $this->getProductTypes();
        view('products/create.view.php', [
            'pageTitle' => 'Product Add',
            'productTypes' => $productTypes
        ]);
    }

    // Handle the form submission to store a new product
    public function store(): void
    {
        $connection = $this->getDbConnection();
        $sku = $_POST['sku'] ?? '';
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? '';
        $productType = $_POST['productType'] ?? '';

        // Get the full class name for the selected product type
        $productClass = !empty($productType) ? $this->getClassName($productType) : null;

        // Validate inputs using external validator
        $validator = ProductValidator::validateProductInputs
        ($connection, $sku, $name, $price, $productType, $productClass);

        // If validation fails, return to form with errors
        if ($validator->hasErrors()) {
            $errors = $validator->getErrors();
            $productTypes = $this->getProductTypes();
            view('products/create.view.php', [
                'pageTitle' => 'Product Add',
                'productTypes' => $productTypes,
                'errors' => $errors
            ]);
            return;
        }
        try {
            // Save the product and redirect to the product list page
            $product = new $productClass($connection);
            $product->save();
            redirect('/');
        } catch (\Exception $e) {
            // If an error occurs, catch the exception and pass the error message to the view
            $errors = ['save_error' => $e->getMessage()];
            $productTypes = $this->getProductTypes();
            view('products/create.view.php', [
                'pageTitle' => 'Product Add',
                'productTypes' => $productTypes,
                'errors' => $errors
            ]);
        }
    }

    // Handle the deletion of selected products
    public function destroy(): void
    {
        $productIds = $_POST['productIds'] ?? [];

        if (empty($productIds)) {
            redirect('/');
        }

        $connection = $this->getDbConnection();
        Product::massDelete($connection, $productIds);

        redirect('/');
    }
}
