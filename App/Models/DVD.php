<?php

namespace App\Models;


use PDOException;
use RuntimeException;

class DVD extends Product
{
    private float $size;

    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getSpecialAttributes(): array
    {
        $size = $_POST['size'] ?? '';
        return ['size' => $size];
    }

    public function save(): true|array
    {
        try {
            $this->connection->query(
                "INSERT INTO products (sku, name, price, size, productType)
                        VALUES (:sku, :name, :price, :size, 'DVD')",
                [
                    'sku' => $_POST['sku'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'size' => $_POST['size']
                ]
            );
            return true;  // Success message
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to save book: " . $e->getMessage());
        }
    }
}
