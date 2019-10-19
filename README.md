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

6. /api/fight-back/{player}
- Player (mandatory): Player1 search inside Player 1 Fleet
- Authentication Header token

## Difficulty
1. Be gentle
- 5 minutes
- speed x 1 (1 second)
- no intelligence

2. Too young to die
- 4 minutes
- speed x 1 (1 second)
- horizontal scraping on enemy hit (memory on previous hit)

3. Warning zone
- 3 minutes
- speed x 2 (0.5 second)
- only horizontal scraping on enemy hit (memory on previous hit)

4. Danger zone
- 2 minutes
- speed x 3 (0.33 second)
- horizontal and vertical scraping on enemy hit (memory on previous hit)

4. Ultra nightmare
- 1 minutes
- speed x 4 (0.25 second)
- horizontal and vertical scraping on enemy hit (memory on previous hit)

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