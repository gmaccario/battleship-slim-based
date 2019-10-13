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
                <div class="row">
                	<div class="col">
                		<div class="levels">
                    		<p>Choose your level</p>
                    		<difficulty level="be-gentle" cls="btn-primary"></difficulty>
                    		<difficulty level="too-young-to-die" cls="btn-secondary"></difficulty>
                    		<difficulty level="warning-zone" cls="btn-warning"></difficulty>
                    		<difficulty level="danger-zone" cls="btn-danger"></difficulty>
                    		<difficulty level="ultre-nightmare" cls="btn-dark"></difficulty>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="token">
					<div class="col">
						<div id="player1">
                			<board player=1 :token="token"></board>
                			<fleet player=1 :token="token" :game-started="gameStarted"></fleet>
                		</div>
                	</div>
					<div class="col">
                		<div id="player2">
                			<board player=2 :token="token"></board>
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