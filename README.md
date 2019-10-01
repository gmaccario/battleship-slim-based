# Battleship (Slim based)
We're going to play Battleship!

## Installation
- Download/Clone the package from Github
- Setup your database connection conf/config.php
- Create a Virtual Host on your Apache
- Run composer install (on your local machine) to install the required packages
- Play the game via browser and have fun!

## Endpoints
/hit-coordinates/8/0/player2?token=cd0cf1a576a90a08f449de09e566d1890f5e55c2330f82d872fe07dd0778d4ad
- Parameters
* X (mandatory): Row coordinate
* Y (mandatory): Row coordinate
* Player1 or Player (mandatory): If Player 1 search inside Player 1 Fleet
* Token (mandatory): Authentication token

## Test
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/BoardTest.php

## Valid HTML
https://validator.w3.org/
Document checking completed. No errors or warnings to show.

## Author
Giuseppe Maccario

## Author URI
[https://www.giuseppemaccario.com](https://www.giuseppemaccario.com "Giuseppe Maccario")

## Live Demo
[Battleship Online](https://www.giuseppemaccario.com/battleship "Battleship online")