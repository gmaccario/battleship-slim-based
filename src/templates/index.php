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
                
                <div class="row" v-if="!gameStarted">
                	<div class="col">
                		<div class="intro">
                			
                			<h3>Setup</h3>
                			<p>Each player's fleet contains 5 different ships:</p>

							<ul>
                                <li>Battleship (4 holes)</li>
                                <li>Aircraft Carrier (3 holes)</li>
                                <li>Destroyer (2 holes)</li>
                                <li>Small Ship (1 holes)</li>
                            </ul>
                            
                            <h3>Game Play</h3>

                            <p>You and your opponent will alternate turns, calling out one shot per turn to try to hit each other's ships.
                            On your turn, pick a target hole on Board 2 (enemy's board) and click out its location. Hit or miss?</p>
							
							<h3>End of the Game</h3>
							<p>If you are the first player to sink your opponent's entire fleet of 5 ships, you win the game.</p>

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
                
                <div class="row" v-if="difficulty && gameStarted && !gameOver">
                	
                	<div v-if="difficultyLevel == '1'" >
                        <div class="alert alert-primary float-left" role="alert">
                        	<span>{{ difficulty.charAt(0).toUpperCase() + difficulty.split('-').join(' ').toLowerCase().slice(1) }}</span>
                        </div>
                        <countdown class="float-right" :timer=5 :speed=1></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '2'" >
    					<div class="alert alert-secondary float-left" v-if="difficulty == 'too-young-to-die'" role="alert">
                        	<span>{{ difficulty.charAt(0).toUpperCase() + difficulty.split('-').join(' ').toLowerCase().slice(1) }}</span>
                        </div>
                        <countdown class="float-right" :timer=4 :speed=1></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '3'" >
                        <div class="alert alert-warning float-left" v-if="difficulty == 'warning-zone'" role="alert">
                        	<span>{{ difficulty.charAt(0).toUpperCase() + difficulty.split('-').join(' ').toLowerCase().slice(1) }}</span>
                        </div>
                        <countdown class="float-right" :timer=3 :speed=2></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '4'" >
                        <div class="alert alert-danger float-left" v-if="difficulty == 'danger-zone'" role="alert">
                        	<span>{{ difficulty.charAt(0).toUpperCase() + difficulty.split('-').join(' ').toLowerCase().slice(1) }}</span>
                        </div>
                        <countdown class="float-right" :timer=2 :speed=3></countdown>
                    </div>
                    
                    <div v-if="difficultyLevel == '5'" >
                        <div class="alert alert-dark float-left" v-if="difficulty == 'ultre-nightmare'" role="alert">
                        	<span>{{ difficulty.charAt(0).toUpperCase() + difficulty.split('-').join(' ').toLowerCase().slice(1) }}</span>
                        </div>
                        <countdown class="float-right" :timer=1 :speed=4></countdown>
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
                    	<section id="footer">
                        	<div class="container">
                        		<div class="row text-center text-xs-center text-sm-left text-md-left">
                        			<div class="col-xs-12 col-sm-4 col-md-4">
                        				<h5>Quick links</h5>
                        				<ul class="list-unstyled quick-links">
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                        				</ul>
                        			</div>
                        			<div class="col-xs-12 col-sm-4 col-md-4">
                        				<h5>Quick links</h5>
                        				<ul class="list-unstyled quick-links">
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                        				</ul>
                        			</div>
                        			<div class="col-xs-12 col-sm-4 col-md-4">
                        				<h5>Quick links</h5>
                        				<ul class="list-unstyled quick-links">
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                        					<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                        					<li><a href="https://wwwe.sunlimetech.com" title="Design and developed by"><i class="fa fa-angle-double-right"></i>Imprint</a></li>
                        				</ul>
                        			</div>
                        		</div>
                        		<div class="row">
                        			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                        				<ul class="list-unstyled list-inline social text-center">
                        					<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                        					<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                        					<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                        					<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                        					<li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                        				</ul>
                        			</div>
                        			</hr>
                        		</div>	
                        		<div class="row">
                        			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                        				<p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                        				<p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
                        			</div>
                        			</hr>
                        		</div>	
                        	</div>
                        </section>
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