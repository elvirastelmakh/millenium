<?php
use Repository\UserRepository;
class UsersController
{
    public function actionList()  {
        $pdo = Connection::getConnection();
        $userRepo = new UserRepository($pdo);
        $users = $userRepo->findAll();
        return $users;
    }
}
require_once '../vendor/autoload.php';
$controller = new UsersController();
header('Content-Type: application/json');
echo json_encode($controller->actionList());