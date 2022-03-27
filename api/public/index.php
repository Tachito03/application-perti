<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../../model/Database.php';
//require '../src/config/database.php';

// Create and configure Slim app
$app = new \Slim\App();

// Define app routes
require '../src/routes/usuario.php';

// Run app
$app->run();