<!DOCTYPE html>
<html lang="en">
	<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="/src/public/css/main.css" >
    
        <title>Battleship</title>
    </head>
    
    <body>
    	<div class="container-fluid">
    	
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                    	<h1>
                    		<i class="fas fa-ship"></i>
                    		<span>Battleship</span>
                    	</h1>
                    	<h2>We’re going to play Battleship!</h2>
                	</div>
                </div>
            </div>
            
            <div id="app" class="container-fluid">
                <div class="row" v-if="!gameStarted">
                	<div class="col">
                		<div class="levels">
                    		<p>Choose your level</p>
                    		<difficulty label="be-gentle" level="1" cls="btn-primary"></difficulty>
                    		<difficulty label="too-young-to-die" level="2" cls="btn-secondary"></difficulty>
                    		<difficulty label="warning-zone" level="3" cls="btn-warning"></difficulty>
                    		<difficulty label="danger-zone" level="4" cls="btn-danger"></difficulty>
                    		<difficulty label="ultre-nightmare" level="5" cls="btn-dark"></difficulty>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="gameOver">
                	<div class="alert alert-success" role="alert" v-if="won == 1">
						<p>You win!</p>
                    </div>
                    <div class="alert alert-danger" role="alert" v-else>
						<p>Game over</p>
                    </div>
                </div>
                
                <div class="row" v-if="difficulty">
                	<p>Level</p>
                	
                	<div v-if="difficultyLevel == '1'" >
                        <div class="alert alert-primary" role="alert">
                        	<span>{{ difficulty }}</span>
                        </div>
                        <countdown :timer=5 :speed=1 v-if="gameStarted"></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '2'" >
    					<div class="alert alert-secondary" v-if="difficulty == 'too-young-to-die'" role="alert">
                        	<span>{{ difficulty }}</span>
                        </div>
                        <countdown :timer=4 :speed=1 v-if="gameStarted"></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '3'" >
                        <div class="alert alert-warning" v-if="difficulty == 'warning-zone'" role="alert">
                        	<span>{{ difficulty }}</span>
                        </div>
                        <countdown :timer=3 :speed=2 v-if="gameStarted"></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '4'" >
                        <div class="alert alert-danger" v-if="difficulty == 'danger-zone'" role="alert">
                        	<span>{{ difficulty }}</span>
                        </div>
                        <countdown :timer=2 :speed=3 v-if="gameStarted"></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '5'" >
                        <div class="alert alert-dark" v-if="difficulty == 'ultre-nightmare'" role="alert">
                        	<span>{{ difficulty }}</span>
                        </div>
                        <countdown :timer=1 :speed=4 v-if="gameStarted"></countdown>
                    </div>
                </div>
                
                <div class="row" v-if="token">
					<div class="col">
						<div id="player1">
                			<board player=1 :token="token" :game-over="gameOver"></board>
                			<fleet player=1 :token="token" :game-started="gameStarted"></fleet>
                		</div>
                	</div>
					<div class="col">
                		<div id="player2">
                			<board player=2 :token="token" :game-over="gameOver"></board>
                			<fleet player=2 :token="token" :game-started="gameStarted"></fleet>
                		</div>
                    </div>
                </div>
            </div>
            
			<div class="container-fluid">
				<div class="row">
                    <div class="col">
                    	<footer>
                    		<a href="https://www.giuseppemaccario.com/" target="_blank">
                    			<span>G. Maccario</span>
                    		</a>
                    	</footer>
					</div>
                </div>
            </div>
		</div>
		
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		
        <script src="/src/public/js/main.js"></script>
    </body>
</html>