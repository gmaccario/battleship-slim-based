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
            
            <?php /*
            <div class="container-fluid game-over">
                <div class="row">
                	<div class="col">
                		<span class="message over">Game over</span>
                		<span class="message win">You win!</span>
                		<p>
                			<a href="/">
                				<span>New game</span>
                			</a>
                		</p>
                	</div>
                </div>
			</div>
			
			<div class="container-fluid">
            	<div class="row">
            		<div class="col">
            			<button type="button" class="btn btn-primary start-new-game">
                			<span>New game</span>
                		</button>
            		</div>
            	</div>
            </div>
            
            <div class="container-fluid game">
            	<div class="row">
            		<div class="col">
            			<div id="player1-board">
                    		<h3>My Board</h3>
                    		
                    		<table class="board player1">
                                <tbody>
                                	<?php for($row=0; $row <= 9; $row++): ?>
                                		<tr class="<?php echo $row; ?>">
                                			<td class="cell">
                                				<div class="table-content">
                                					<?php echo $row; ?>
                                				</div>
                                			</td>
                                            <?php for($col=0; $col <= 9; $col++): ?>
                                            	<td class="cell row-<?php echo $row; ?> col-<?php echo $col; ?>">
                                            		<div class="table-content">
	                                            		<i class="fas fa-align-justify"></i>
	                                            	</div>
                                            	</td>
                                            <?php endfor; ?>
                                       	</tr>
                                    <?php endfor; ?>
                                    
                                    <tr>
                                        <td>&nbsp;</td>
                                    	<?php for($col=0; $col <= 9; $col++): ?>
                                            <td><?php echo $col; ?></td>
                                    	<?php endfor; ?>
                                	</tr>
                                </tbody>
                            </table>
                    	</div>
                    	
                    	<?php <div id="player1-fleet">
                        	<h4>Enemy's fleet</h4>
                            
                            <div class="fleet player1"></div>
                        </div> ?>
            		</div>
            		
            		<div class="col">
						<div id="player2-board">
                    		<h3>Enemy's Board</h3>
                    		
							<table class="board player2">
                                <tbody>
                                	<?php for($row=0; $row <= 9; $row++): ?>
                                		<tr class="<?php echo $row; ?>">
                                			<td class="cell">
                                				<div class="table-content">
                                					<?php echo $row; ?>
                                				</div>
                                			</td>
                                            <?php for($col=0; $col <= 9; $col++): ?>
                                            	<td class="cell row-<?php echo $row; ?> col-<?php echo $col; ?>">
                                            		<div class="table-content">
	                                            		<i class="fas fa-align-justify"></i>
	                                            	</div>
                                            	</td>
                                            <?php endfor; ?>
                                       	</tr>
                                    <?php endfor; ?>
                                    
                                    <tr>
                                        <td>&nbsp;</td>
                                    	<?php for($col=0; $col <= 9; $col++): ?>
                                            <td><?php echo $col; ?></td>
                                    	<?php endfor; ?>
                                	</tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <?php <div id="player2-fleet">
                        	<h4>Enemy's fleet</h4>
                            
                            <div class="fleet player2"></div>
                        </div>
            		</div>
            	</div>
            </div>
            */ ?>
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
        
        <script src="/src/public/js/main.js"></script>
    </body>
</html>