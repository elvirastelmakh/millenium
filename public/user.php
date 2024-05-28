<?php
use Repository\UserRepository;
use Repository\OrderRepository;
class UserController
{
    public function actionUserInfo()  {
        $id = $_GET['id'];
        $pdo = Connection::getConnection();
        $userRepo = new UserRepository($pdo);
        $user = $userRepo->find($id);
        $orderRepo = new OrderRepository($pdo);
        $products = $orderRepo->findByUser($id);
        return ['user' => $user, 'order' => $products];
    }
}
require_once '../vendor/autoload.php';
$controller = new UserController();
header('Content-Type: application/json');
echo json_encode($controller->actionUserInfo());