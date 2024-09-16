<?php

namespace App\Models;

use Exception;
use PDOException;
use RuntimeException;

class Book extends Product
{
    private float $weight;

    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getSpecialAttributes(): array
    {
        $weight = $_POST['weight'] ?? '';
        return ['weight' => $weight];
    }

    /**
     * @throws Exception
     */
    public function save(): bool
    {
        try {
            $this->connection->query(
                "INSERT INTO products (sku, name, price, weight, productType)
                        VALUES (:sku, :name, :price, :weight, 'Book')",
                [
                    'sku' => $_POST['sku'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'weight' => $_POST['weight']
                ]
            );
            return true;  // Success message
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to save book: " . $e->getMessage());
        }
    }
}
