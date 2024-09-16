<?php
namespace Core;

class Validator
{
    private array $errors = [];

    public function validateRequired($fields): void
    {
        foreach ($fields as $field => $value) {
            if (empty($value)) {
                $this->errors[$field] = "Product $field is required";
            }
        }
    }
    public function validateUnique($connection, $table, $field, $value): void
    {
        $stmt = $connection->query(
            "SELECT COUNT(*) FROM {$table} WHERE {$field} = :value",
            [':value' => $value]
        );
        if ($stmt->fetchColumn() > 0) {
            $this->errors[$field] = "$field must be unique";
        }
    }
    public function addError($field, $message): void
    {
        $this->errors[$field] = $message;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

}