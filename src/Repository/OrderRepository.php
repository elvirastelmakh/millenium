<?php
namespace Repository;

use PDO;
class OrderRepository
{
    protected PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByUser(int $userId)
    {
        $sql = 'SELECT title, price
                FROM products p 
                JOIN user_order uo ON uo.product_id = p.id
                WHERE uo.user_id = ?
                ORDER BY title ASC, price DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll();
        foreach ($result as &$value) {
            unset($value[0]);
            unset($value[1]);
        }
        return $result;
    }
}