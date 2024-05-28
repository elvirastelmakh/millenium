<?php
use Repository\ProductRepository;
class ProductController{
    public function actionAddProduct($params)  {
        $id = (isset($params['id'])) ? intval($params['id']) : 0;
        $title = (isset($params['title'])) ? trim(strip_tags($params['title'])) : '';
        $price = (isset($params['price'])) ? floatval($params['price']) : 0.00;
        $pdo = Connection::getConnection();
        $productRepo = new ProductRepository($pdo);
        try {
            $productRepo->addProduct($id, $title, $price);
        } catch (\Exception $exc) {
            echo 'Произошла ошибка при добавлении товара в каталог'; 
        }
       
        return true;
    }

    public function actionList()
    {
        $pdo = Connection::getConnection();
        $productRepo = new ProductRepository($pdo);
        $products = $productRepo->findAll();
        return $products;
    }
}
require_once '../vendor/autoload.php';
$controller = new ProductController();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $params = json_decode(file_get_contents('php://input'), true);
    echo json_encode($controller->actionAddProduct($params));
}
echo json_encode($controller->actionList());