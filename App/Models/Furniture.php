<?php

namespace App\Models;

use PDOException;
use RuntimeException;

class Furniture extends Product
{
    private float $height;
    private float $width;
    private float $length;
    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function setDimensions($height, $width, $length): void
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getDimensions(): array
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length,
        ];
    }

    public function getSpecialAttributes(): array
    {
        $height = $_POST['height'] ?? '';
        $width = $_POST['width'] ?? '';
        $length = $_POST['length'] ?? '';
        return [
            'height' => $height,
            'width' => $width,
            'length' => $length,
        ];
    }

    public function save(): bool
    {
//        dd($_POST);
        try {
            $this->connection->query(
                "INSERT INTO products (sku, name, price, height, width, length, productType)
                VALUES 
                (:sku, :name, :price, :height, :width, :length, 'Furniture')"
                , [
                'sku' => $_POST['sku'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'height' => $_POST['height'],
                'width' => $_POST['width'],
                'length' => $_POST['length']
            ]);
            return true;
        }catch (PDOException $e) {
           throw new RuntimeException("Failed to save furniture: " . $e->getMessage());
        }

    }
}
