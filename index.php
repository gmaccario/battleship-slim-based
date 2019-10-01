<?php 
/*
Name: Battleship
URI: 
Description: The Battleship board game
Version: 1.0
Author: Giuseppe Maccario
Author URI: giuseppemaccario.com
License: GPL2
*/

use Slim\Views\PhpRenderer;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Services\Battleship;
use Services\Auth;

/* PSR-4: Autoloader - PHP-FIG */
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/* Debug only */
$config = ['settings' => ['displayErrorDetails' => true]];
 
/* New Slim App */
$app = new \Slim\App($config);

 /* Set templates directory */
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./src/templates");

/* Template - HomePage */
$app->get('/', function (Request $request, Response $response, array $args) {
    
    return $this->renderer->render($response, "game.php", array());
});
/* API - setup new game */
$app->get('/setup-new-game', function (Request $request, Response $response, array $args) {
    
    /*
     * Create a new token
     */
    $auth = new Auth();
    $token = $auth->generateSignature();
    
    /*
     * Setup a new game
     */
    $battleshipService = new Battleship($auth);
    $battleshipService->setup();
    
    /*
     * Prepare data
     */
    $data = array('token' => $token);
    
    /*
     * Send Json response
     */
    return $response->withJson($data);
});

/* API - hit coordinates */
$app->get('/hit-coordinates/{x}/{y}/{player}', function (Request $request, Response $response, array $args) {

    /*
     * prepare parameters
     */
    $x = $args['x'];
    $y = $args['y'];
    $player = $args['player'];
    
    /*
     * Set authorization token
     */
    $token = $request->getHeaderLine('Authorization');
    
    $auth = new Auth();
    $auth->setToken($token);
    
    /*
     * Hit the coordinates and get the result
     */
    $battleshipService = new Battleship($auth);
    $resultHitting = $battleshipService->hitCoordinates($x, $y, $player);
    
    /*
     * Send Json response
     */
    return $response->withJson($resultHitting);
});

/**
 * Run Slim Engine
 */
$app->run();