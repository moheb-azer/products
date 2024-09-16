<?php

namespace App\Models;

use PDO;
use PDOException;
use RuntimeException;

abstract class Product
{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $productType;
    protected $connection;

    public function __construct( $connection)
    {
        $this->connection = $connection;
    }

    // Getters and setters for SKU, name, price, and product type
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setProductType($productType): void
    {
        $this->productType = $productType;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    // Get all products from the database

    /**
     * @throws \Exception
     */
    public static function getAll($connection)
    {
        try {
            return $connection->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function massDelete($connection, $productIds): true
    {
//        dd($productIds);
        try {
            foreach ($productIds as $id) {
                $connection->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
            }
            return true;
        } catch (PDOException $e) {
            // Handle the exception or log the error
            throw new RuntimeException("Failed to delete products: " . $e->getMessage());
        }

    }

    // Abstract methods to be implemented by child classes
    abstract public function save();
}
