<?php
namespace Repository;

use Exception;
use PDO;
class UserRepository
{
    protected PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function find(int $id)
    {
        $sql = 'SELECT first_name, second_name
                FROM user WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        if (count($result)>1) {
            throw new Exception('More than 1 user was founud by id!');
        } else if (count($result)==0) {
            throw new Exception('User was not found by id!');
        }
        return $result[0]['second_name'] . ' ' . $result[0]['first_name'];
    }

    public function findAll()
    {
        $sql = "SELECT id, CONCAT(second_name, ' ', first_name) as full_name, birthday
                FROM user
                ORDER BY full_name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as &$value) {
            unset($value[0]);
            unset($value[1]);
            unset($value[2]);
        }
        return $result;
    }
}