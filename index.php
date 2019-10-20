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

use Controllers\HomeController;
use Controllers\TokenController;
use Controllers\HitCoordinatesController;
use Controllers\NewGameController;
use Controllers\GetFleetController;
use Controllers\FightBackController;
use Controllers\UsernameAddController;

// PSR-4: Autoloader - PHP-FIG
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Debug only
$config = ['settings' => ['displayErrorDetails' => true]];

// New Slim App
$app = new \Slim\App($config);

// Set templates directory
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./src/templates");

// GET
$app->get('/', HomeController::class)->setName('homepage'); // Homepage
$app->get('/api/token', TokenController::class)->setName('getToken'); // Get new Token
$app->get('/api/new-game[/difficulty/{difficulty}]', NewGameController::class)->setName('setupNewGame'); // Setup new Game
$app->get('/api/get-fleet/{player}', GetFleetController::class)->setName('getFleetXPlayer'); // Get a list of ships per player
$app->get('/api/hit-coordinates/{player}/{x}/{y}', HitCoordinatesController::class)->setName('hitCoords'); // Hit coordinates
$app->get('/api/fight-back/{player}', FightBackController::class)->setName('fightBack'); // Fight Back

// POST
$app->post('/api/username', UsernameAddController::class)->setName('usernameAdd'); // Username add

// Run Slim Engine
$app->run();