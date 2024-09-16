<?php

namespace App\Validators;

use App\Models\Product;
use Core\Validator;

class ProductValidator
{
    public static function validateProductInputs
    ($connection, $sku, $name, $price, $productType, $productClass = null): Validator
    {
        $validator = new Validator;

        // Validate common fields
        $validator->validateRequired([
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'productType' => $productType,
        ]);
        if (!empty($productType)) {
            // Validate special attributes if the product class is valid
            if ($productClass && is_subclass_of($productClass, Product::class)) {
                $product = new $productClass($connection);
                $specialAttributes = $product->getSpecialAttributes();
                $validator->validateRequired($specialAttributes);
            } else {
                $validator->addError('productType', 'Invalid product type selected.');
            }
        }


        // Validate SKU uniqueness
        $validator->validateUnique($connection, 'products', 'sku', $sku);

        return $validator;
    }
}
