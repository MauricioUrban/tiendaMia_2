<?php

require_once 'libs/Router.php';
require_once 'controllers/apiCommentController.php';

$router = new Router();
$router->addRoute('api/comments', 'GET', 'apiCommentController', 'getAll');
$router->addRoute('api/comments', 'POST', 'apiCommentController', 'addComment');
$router->addRoute('api/comments/product/:ID', 'GET', 'apiCommentController', 'getAllCommentsByProduct');
$router->addRoute('api/comments/:ID', 'GET', 'apiCommentController', 'getOneComment');
$router->addRoute('api/comments/:ID', 'DELETE', 'apiCommentController', 'removeComment');
                 
$resource = $_GET["resource"];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);


