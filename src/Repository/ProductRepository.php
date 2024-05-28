<?php
namespace Repository;

use PDO;
class ProductRepository
{
    protected PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct(?int $productId, string $title = '', float $price = 0.00)
    {
        $sql = 'INSERT INTO products (id, title, price) VALUES (?, ?, ?)'; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productId, $title, $price]);
    }

    public function findAll()
    {
        $sql = 'SELECT title, price
                FROM products p 
                ORDER BY title ASC, price DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as &$value) {
            unset($value[0]);
            unset($value[1]);
        }
        return $result;
    }
}
