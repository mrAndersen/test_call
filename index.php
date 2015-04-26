<?php
require_once "vendor/autoload.php";

if(empty($_GET)){
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('src/Resources');
    $twig = new Twig_Environment($loader);

    echo $twig->render('index.html.twig');
}elseif(isset($_GET['request_call'])){
    $phone = $_GET['phone'];
    //Тут должна быть валидация телефона...
    $pwd = rand(1000,9999);

    if(\Main\Call::call($pwd,$phone)){
        header('Content-Type: application/json');
        echo json_encode(['pwd' => $pwd]);
    }else{
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    }
}



