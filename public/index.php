<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .formControl {
            display: flex;
            justify-content: center;
        }

    </style>
</head>
<body>
<?php
require_once '../src/components/DataProvider.php';
require_once '../src/components/CheckUserInputs.php';
require_once '../src/components/ReadFile.php';
require_once '../src/components/GetResponse.php';
require_once '../src/models/ProductCollection.php';
require_once '../src/views/ProductView.php';
require_once '../src/exceptions/CustomExceptions.php';
require_once '../src/models/Products/ProductOne.php';
require_once '../src/models/Products/ProductTwo.php';
require_once '../src/models/Products/ProductThree.php';
?>
<div class="formControl">
    <form action="" method="post" class="userForm">
        <label>Form for validation</label><br/>
        <label>
            <input type="text" name="code" autocomplete="off" placeholder="product code">
        </label> <br/>
        <label>
            <input type="text" name="price" autocomplete="off" placeholder="price">
        </label> <br/>
        <label>
            <input type="text" name="name" autocomplete="off" placeholder="name">
        </label> <br/>
        <label>
            <input type="text" name="description" autocomplete="off" placeholder="description">
        </label> <br/><br/>
        <button type="submit">Submit</button>
    </form>
    <div>
    </div>
    <?php
    $requestUri = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    const isAuthenticated = true;
    const patternQueryProduct = '/\/v1\/products\/\d+$/';
    const patternPutProductPrice = '/\/products\/(\d+)\/price/';
    const patternPutProductCount = '/\/products\/(\d+)\/count/';
    const patternPutProductInStock = '/\/products\/(\d+)\/instock/';

    if ($requestUri === '/v1/products') {
        require_once '../src/controllers/ProductsController.php';
        $model = new ProductCollection();
        $view = new ProductView();
        $controller = new ProductsController($model, $view);
        if ($requestMethod === 'GET') {
            echo $controller->getAllProducts();
        } else if ($requestMethod === 'POST' && isAuthenticated) {
            $controller->createProduct($_POST);
        } else {
            http_response_code(401);
            echo '401 Unauthorized';
        }
    } else if (preg_match(patternQueryProduct, $requestUri)) {
        require_once '../src/controllers/ProductController.php';
        $requestUriParts = explode('/', $requestUri);
        $productId = $requestUriParts[3];
        $model = new ProductCollection();
        $view = new ProductView();
        $controller = new ProductController($model, $view);
        if ($requestMethod === 'GET') {
            echo $controller->getProduct($productId);
        } else if ($requestMethod === 'PUT' && isAuthenticated) {
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            echo $controller->updateProduct($productId, $_PUT);
        } else if ($requestMethod === 'DELETE' && isAuthenticated) {
            echo $controller->deleteProduct($productId);
        }
    } else if (preg_match(patternPutProductPrice, $requestUri)) {
        require_once '../src/controllers/ProductPutPrice.php';
        $requestUriParts = explode('/', $requestUri);
        $productId = $requestUriParts[3];
        $model = new ProductCollection();
        $view = new ProductView();
        $controller = new ProductPutPrice($model, $view);
        if ($requestMethod === 'PATCH' && isAuthenticated) {
            $_PATCH = [];
            parse_str(file_get_contents("php://input"), $_PATCH);
            echo $controller->putPrice($productId, $_PATCH['price']);
        }
    } else if (preg_match(patternPutProductInStock, $requestUri)) {
        require_once '../src/controllers/ProductPutInStock.php';
        $requestUriParts = explode('/', $requestUri);
        $productId = $requestUriParts[3];
        $model = new ProductCollection();
        $view = new ProductView();
        $controller = new ProductPutInStock($model, $view);
        if ($requestMethod === 'PATCH' && isAuthenticated) {
            $_PATCH = [];
            parse_str(file_get_contents("php://input"), $_PATCH);
            echo $controller->putInStock($productId, $_PATCH['inStock']);
        }
    } else if (preg_match(patternPutProductCount, $requestUri)) {
        require_once '../src/controllers/ProductPutCount.php';
        $requestUriParts = explode('/', $requestUri);
        $productId = $requestUriParts[3];
        $model = new ProductCollection();
        $view = new ProductView();
        $controller = new ProductPutCount($model, $view);
        if ($requestMethod === 'PATCH' && isAuthenticated) {
            $_PATCH = [];
            parse_str(file_get_contents("php://input"), $_PATCH);
            echo $controller->putCount($productId, $_PATCH['count']);
        }
    } else if ($requestUri !== '/') {
        header("HTTP/1.0 404 Not Found");
        header("Location: /404.php");
        exit();
    }

    if ($requestMethod === "POST" and $requestUri === '/') {
        $dataProvider = new DataProvider();
        $dataForValidation = $dataProvider->chooseData($_POST, '../files/test.csv', '../files/test.xml');
        $checkUserInputs = new CheckUserInputs();
        $getResponse = new GetResponse();
        $checkedUserInputs = $checkUserInputs->runCheck($dataForValidation, $getResponse);
        echo $checkedUserInputs;

        $readFile = new ReadFile();
        $filePath = '../resources/Downloaded.csv';
        $readLinesFromFile = $readFile->readLinesFromFile($filePath);
        foreach ($readLinesFromFile as $line) {
            echo '<br />' . $line;
        }
    }
    ?>
</body>
</html>