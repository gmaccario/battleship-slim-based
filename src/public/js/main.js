jQuery( document ).ready(function() {
	
	console.log( "We're going to play Battleship!" );
	
	/*
	 * Game = 0 (Game Over)
	 * Game = 1 (Game On)
	 */
	var game = 1;
	
	var player = 1;
	
	var totalHitPlayer1 = 0;
	var totalHitPlayer2 = 0;
	
	var maxHit = 20;
	
	/*
	 * Functions
	 * 
	 * Call hit() function when player1 (human) click on player2 (enemy) board.
	 * 
	 * The function is called recursevely with new values for player 2
	 * 
	 */
	function hit(target, row, col, token)
	{
		let szPlayer = ((player === 1) ? 'player2' : 'player1');
		
		/**
		 * Player 1 hits now 
		 */
		jQuery.ajax({
			url: `/hit-coordinates/${row}/${col}/${szPlayer}`,
			type: "get",
			data: {},
			headers: {"Authorization": token},
			error: function(xhr) {
				console.log("Some errors occurred, please try later.");
			},
			success: function(response) {
				
				/*
				 * Error on token
				 */
				if(response.error)
				{
					alert('Illegal token!');
					
					return false;
				}
				
				if(response.hit !== true)
				{
					/*
					 * Miss
					 */
					target.addClass('water');
					
					target.find('i').removeClass('fa-align-justify').addClass('fa-tint').addClass('clicked');
				}
				else {
					/*
					 * Hit
					 */
					target.addClass('bomb');
					
					target.find('i').removeClass('fa-align-justify').addClass('fa-bomb').addClass('clicked');
					
					/*
					 * Flag to red the ship into the fleet
					 * 
					 * @bug Not adjacient ship hull
					 */
					let shipHulls = jQuery('.fleet.' + szPlayer + ' .ship.' + response.ship.split(' ').join('.') + ' .ship-hull');
					
					jQuery.each(shipHulls, function( index, hull ){

						if(!jQuery(hull).hasClass('hit'))
						{
							jQuery(hull).addClass('hit');
							
							return false
						}
					});
					
					/**
					 * Check game over
					 */
					if(player === 1)
					{
						totalHitPlayer1 = totalHitPlayer1 + 1;
					}
					else {
						totalHitPlayer2 = totalHitPlayer2 + 1;
					}

					if( totalHitPlayer1 == maxHit || totalHitPlayer2 == maxHit )
					{
						game = 0;
						
						jQuery('.game-over').addClass((player === 1) ? 'player1' : 'player2');
						
						jQuery('.game-over').find((player === 1) ? '.win' : '.over').show();
						
						jQuery('.game-over').show();
					}
				}
				
				/**
				 * Player 2 hits now 
				 */
				if(player === 1 && game === 1)
				{
					/*
					 * Coordinates recalculation (random)
					 * 
					 * @bug Double click on already clicked cell.
					 * @note Add more intelligence (more levels of difficult) here: check last hat and hit around it
					 */
					row = Math.floor(Math.random() * (9 - 0 + 1) + 0);
					col =  Math.floor(Math.random() * (9	 - 0 + 1) + 0);
					
					target = jQuery('#player1-board .cell.row-' + row + '.col-' + col);
					
					player = 2;
					
					/*
					 * Recursion
					 */
					hit(target, row, col, token);
				}
			}
		});
	}
	
	function setupBoard()
	{
		jQuery('.game').show();
	}
	
	function setupFleet()
	{
		
	}
	   
    /**
     * Events
     * 
     * Click on Board cell
     * */
    jQuery( ".board.player2 .cell" ).click(function(event) {

    	/*
    	 * Only if Game is On
    	 */
    	if(game)
    	{
	    	player = 1;
	    	
	    	/*
	    	 * Check for the cookie token
	    	 */
	    	let battleship_token = document.cookie.split(';').filter((item) => item.trim().startsWith('battleship-token='));
	    	
	    	if(!battleship_token.length) 
	    	{
	    		console.log("Missing token, please try later.");
	    	}
	    	else {
	    		/*
	    		 * Clicked cell
	    		 */
	    		let target = jQuery(event.target);
	    		if(target.is("i")) 
	    		{
	    			target = target.closest('td');
	    		}
	    		
	    		if(!target.find('i').hasClass('clicked'))
				{
	    			/*
	    			 * Get coordinates, token and hit!
	    			 */
	    			let cellClass = jQuery(target).attr('class');
	        		
	            	let row = cellClass.split(' ').filter((item) => item.trim().startsWith('row'))[0].split('-')[1];
	            	let col = cellClass.split(' ').filter((item) => item.trim().startsWith('col'))[0].split('-')[1];
	            	
	        		let token = battleship_token[0].split('=')[1];
	        		
	        		hit(target, row, col, token);
				}
	    	}
    	}
	});
    
    /**
     * Get the token
     */
    jQuery( ".start-new-game" ).click(function(event) {

    	/*
    	 * Get the token
    	 */
    	jQuery.ajax({
			url: "/setup-new-game",
			type: "get",
			data: {},
			error: function(xhr) {
				console.log("Some errors occurred, please try later.");
			},
			success: function(response) {
				
				if(response.token)
				{
					let date = new Date();
		        	date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000));
		        	
		        	let expires = "; expires=" + date.toGMTString();
					document.cookie = `battleship-token=${response.token}${expires}; path=/`;
					
					setupBoard();
					setupFleet();
				}
			}
    	});
    	
    	/**
    	 * @todo Check if there is a token in order to re-start from last session if the game stills on
    	 */
    	
	});
});