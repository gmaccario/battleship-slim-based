# Battleship (Slim based)
We're going to play Battleship!

## Installation
- Download/Clone the package from Github
- Setup your database connection conf/config.php
- Create a Virtual Host on your Apache
- Play the game via browser and have fun!

## Endpoints
1. /

- Visit the Homepage

2. /api/token

- Get a new token

3. /api/new-game[/difficulty/{difficulty}]

- Prepare a new game
- Authentication Header token
- difficulty [optional]

4. /api/get-fleet/{player}

- Get a list of ships per player (with ids)
- Authentication Header token

5. /api/hit-coordinates/{player}/{x}/{y}

- Player (mandatory): Player1 search inside Player 1 Fleet
- X (mandatory): Row coordinate
- Y (mandatory): Col coordinate
- Authentication Header token

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