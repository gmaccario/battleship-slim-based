// Event EventBus
const EventBus = new Vue();

// Cell Component
const Cell = Vue.component('cell',{
	components: {
		
	},
	props: {
		cols: Number,
		col: Number,
		row: Number,
		player: String,
		token: String,
		gameOver: Boolean,
	},
	data(){
		return {
			hit: false,
			attacked: false,
			currentPlayer: null,
		}
	},
	created() {
		
		this.currentPlayer = this.player;
	},
	mounted() {

	},
	watch: {

	},
	methods: {

		hitCoordinates(row, col) {
			
			if(!this.gameOver)
			{
				// Prevent click on already attacked cells and on player 1 board
				if(!this.attacked)
				{
					// Animate intersection
					EventBus.$emit('animateintersection', this.currentPlayer, row, col);
				}
				
				// Prevent click on already attacked cells and on player 1 board
				if(!this.attacked && this.currentPlayer == 2)
				{
					// Call API Hit Coordinates
					axios.get('/api/hit-coordinates/player' + this.currentPlayer + '/' + row + '/' + col, {
		    			
		    			headers: { Authorization: `${this.token}` }
		    		
					}).then((response) => {
	
						// console.log('hitCoordinates', response.data.results);
						
						if(!response.data.results.hit)
						{
							this.attacked = true;
						}
						else {
							
							this.hit = true;
							this.attacked = true;
							
							this.$root.$emit('hitShip', this.player, response.data.results.shipId, response.data.results.hull);
						}
						
						// Fight Back
						EventBus.$emit('fightBack', 1);
					});	
				}
			}
		},
		
		HitCoordinatesOnFightBack(results) {
			
			if(!this.attacked)
			{
				let row = results.x;
				let col = results.y;
				let hit = results.hit;
				let shipId = results.shipId;
				let hull = results.hull;
			
				// Animate intersection
				EventBus.$emit('animateintersection', this.currentPlayer, row, col);
				
				if(!hit)
				{
					this.attacked = true;
				}
				else {
					
					this.hit = true;
					this.attacked = true;
					
					this.$root.$emit('hitShip', this.player, shipId, hull);
				}
			}
		},
	},
  	template:`<div class="cell-wrapper-icon" @click="hitCoordinates((row - 1), (col - 1));">
  				
  				<div class="cell-icon not-clicked-yet" v-if="!attacked && !hit && !gameOver">
        			<i class="fas fa-align-justify animated rubberBand"></i>
        		</div>
        		
        		<div class="cell-icon bomb" v-if="attacked && hit && !gameOver">
        			<i class="fas fa-bomb animated bounce"></i>
        		</div>
        		
  				<div class="cell-icon water" v-if="attacked && !hit && !gameOver">
        			<i class="fas fa-water animated jello"></i>
        		</div>
        		
        		<div class="cell-icon gameover" v-if="gameOver">
        			<i  class="fas fa-ban animated zoomIn"></i>
        		</div>
        	</div>`
});

// Countdown Component
const Countdown = Vue.component('countdown',{
	components: {
		
	},
	props: {
		timer: Number,
		speed: Number,
	},
	data(){
		return {
			minutes: 0,
			seconds: 0,
			innerSetInterval: null,
		}
	},
	created() {
		
		this.setTimer();
		this.decreaseTimer();
	},
	mounted() {
		
	},
	watch: {
		
	},
	methods: {
		
		setTimer() {
			this.minutes = this.timer;
			this.seconds = 0;
		},
		
		decreaseTimer() {
			
			this.innerSetInterval = window.setInterval(() => {
		        
		        if(this.minutes == 0 && this.seconds == 0)
		        {
		        	clearInterval(this.innerSetInterval);
		        	
					console.log("GAME OVER by Timer");
					
					EventBus.$emit('gameOver');
					
					return;
		        }
		        
		        if(this.seconds > 0)
		        {
		        	this.seconds = this.seconds - 1;
		        } 
		        else {
		        	
		        	this.seconds = 59;
		        	
		        	if(this.minutes > 0)
		        	{
		        		this.minutes = this.minutes - 1;
		        	}
		        }
		    }, (1000 / this.speed));
		},
	},
  	template:`<div class="countdown">
  		<div class="countdown-block animated shake slow bck-white">
	        <p class="digit"><i class="fas fa-hourglass-half fa-2x"></i></p>
	        <p class="text">&nbsp;</p>
	    </div>
	    <div class="countdown-block" v-if="minutes > 0">
	        <p class="digit">{{ minutes }}</p>
	        <p class="text">Minutes</p>
	    </div>
	    <div class="countdown-block">
	        <p class="digit">{{ seconds }}</p>
	        <p class="text">Seconds</p>
	    </div>
	</div>`
});


// Hull Component
const Hull = Vue.component('hull',{
	components: {
		
	},
	props: {
		id: Number,
		ship: Object,
		index: Number,
	},
	data(){
		return {
			hit: false
		}
	},
	created() {
		
	},
	mounted() {
		
		this.$root.$on('hitHull', (player, shipId, hullId) => {

			if(shipId == this.ship.id && hullId == this.id) 
			{
				this.hit = true;
				
				// Decrease Intact Hulls
				this.$root.$emit('decreaseIntactHulls', player);
			}
		})
	},
	watch: {
		
	},
	methods: {
		
	},
  	template:`<div class="ship-hull" :class="{'hit': hit, 'animated bounce': hit}" :data-title="ship.type">
  		
  	</div>`
});

// Ship Component
const Ship = Vue.component('ship',{
	components: {
		'hull': Hull,
	},
	props: {
		ship: Object,
	},
	data(){
		return {
			shipId: 0,
		}
	},
	created() {
		
		this.setup();
	},
	mounted() {
		
		this.$root.$on('hitShip', (player, shipId, hullId) => {
			
			if(shipId == this.shipId) 
			{
				this.$root.$emit('hitHull', player, shipId, hullId);
			}
		});
	},
	watch: {
		
	},
	methods: {
		
		setup(){
			
			this.shipId = this.ship.id;
		}
	},
  	template:`<div class="ship" :class="'ship-' + ship.id + ' type-' + ship.type.split(' ').join('-').toLowerCase()">
  				<hull :ship="ship" :id="hullId - 1" :index="index" v-for="(hullId, index) in ship.len" :key="index" :class="'ship-' + ship.type.split(' ').join('-').toLowerCase() + '-hull-' + index"></hull>
  			</diV>`
});

//Fleet Component
const Fleet = Vue.component('fleet',{
	components: {
		'ship': Ship,
	},
	props: {
		player: String,
		token: String,
		gameStarted: Boolean,
		title: String,
	},
	data(){
		return {
			ships: [],
			shipsHullsTotal: []
		}
	},
	created() {
		
	},
	mounted() {
		
		this.$root.$on('decreaseIntactHulls', (player) => {
			
			if(this.shipsHullsTotal[player])
			{
				// Decrease Intact Hulls
				this.shipsHullsTotal[player] = this.shipsHullsTotal[player] - 1;
				
				if(this.shipsHullsTotal[player].toString() == '0')
				{
					console.log("GAME OVER player win!");
					
					EventBus.$emit('gameOver', player);
				}	
			}
		});
	},
	watch: {
		
		gameStarted: function (val) {

			this.setFleet();
	    },
	    
	    ships: function (val) {
	    	
	    	let totalHulls = 0;
	    	this.ships.forEach(function(ship) {
	    		
	    		totalHulls = totalHulls + ship.len;
			});
	    	
	    	this.shipsHullsTotal[this.player] = totalHulls;
	    },
	},
	methods: {
		
		setFleet() {

			axios.get('/api/get-fleet/player' + this.player, {
    			
    			headers: { Authorization: `${this.token}` }
    		
			}).then((response) => {

				this.ships = response.data.results;
			});
		},
	},
  	template:`<div class="fleet" :class="'player' + player">
  			<div class="title" role="alert" >
	  			<p class="font-weight-bold">{{ title }}</p>
	  		</div>

	  		<ship :ship="ship" v-for="ship in ships" :key="ship.id"></ship>
  		</div>`
});

// Board Component
const Board = Vue.component('board',{
	components: {
		'cell': Cell,
	},
	props: {
		player: String,
		token: String,
		gameOver: Boolean,
		title: String,
	},
	data(){
		return {
			rows: 10,
			cols: 10,
			intersectX: null,
			intersectY: null,
			currentPlayer: null,
			showOverlay: false,
		}
	},
	created() {

		EventBus.$on('fightBack', (player) => {

			// Do the trick: Call the fightBack just once
			if(player.toString() != '1')
			{
				return;
			}
			
			axios.get('/api/fight-back/player' + player, {
				
				headers: { Authorization: `${this.token}` }
			
			}).then((response) => {
	
				if(response)
				{
					let row = response.data.results.x;
					let col = response.data.results.y;
					let results = response.data.results;
					
					let ref = 'cell-ref-' + player + '-' + row + '-' + col;

					if(this.$refs[ref])
					{
						this.$refs[ref][0].HitCoordinatesOnFightBack(results);
					}	
				}
			});
		});
		
		EventBus.$on('animateintersection', (player, row, col) => {

			// @todo Check why this disalignement on row and col
			this.intersectX = row + 2;
			this.intersectY = col + 2;
			this.currentPlayer = player;
			
			if(player == 1)
			{
				this.intersectX = row + 1;
				this.intersectY = col + 1;
			}
			
			setTimeout(function(){
				
				this.resetVariables();
			}, 25);
		});
	},
	mounted() {
		
	},
	watch: {

	},
	methods: {
		
		resetVariables(){
			this.intersectX = null;
			this.intersectY = null;
			this.currentPlayer = null;
		}
	},
  	template:`<div class="board" :class="'player' + player">
  		<div class="title" role="alert" >
  			<p class="font-weight-bold animated flash slower">{{ title }}</p>
  		</div>

  		<table class="board" :class="'player' + player">
		    <tbody>
		        <tr v-for="row in rows" class="board-row" :class="'board-row-' + (row - 1)">
		        
		        	<!-- @todo Create a new component -->
		        	<td class="board-row-header" :class="'board-row-header-' + (row - 1) + ((player == currentPlayer && intersectX == row) ? ' animated shake' : '')">
		        		<i class="far fa-play-circle"></i>
		        	</td>
		        	
		        	<td v-for="col in cols" class="board-cell" :class="'board-cell-row-' + (row - 1) + ' board-cell-col-' + (col - 1)">
	        			<cell :token="token" :player="player" :cols="cols" :col="col - 1" :row="row - 1" :game-over="gameOver" :key="'cell-ref-' + player + '-' + (row - 1) + '-' + (col - 1)" :ref="'cell-ref-' + player + '-' + (row - 1) + '-' + (col - 1)"></cell>
	        		</td>
		        </tr>
		    </tbody>
		    
		    <!-- @todo Create a new component -->
		    <tfoot>
		    	<tr class="board-row-footer">
		        	<td class="board-empty"><span>&nbsp;</span></td>
  					<td v-for="col in cols" class="board-col" :class="'board-col' + (col - 1) + ((player == currentPlayer && intersectY == col) ? ' animated slideInUp' : '')">
  						<i class="fas fa-eject"></i>
  					</td>
		        </tr>
		    </tfoot>
		  </table>
  		</div>`
});

// Difficulty Component
const Difficulty = Vue.component('difficulty',{
	components: {
		
	},
	props: {
		cls: String,
		level: String,
		label: String,
	},
	data(){
		return {
			token: '',
		}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {
		
		token: function (val) {
			
			this.setAuthCookie();
			
			EventBus.$emit('startNewGame');
	    },
	},
	methods: {
		chooseLevel(){
			
			this.getNewToken();
			
			EventBus.$emit('setDifficulty', this.label, this.level);
		},
		
		getNewToken()
    	{
    		axios.get('/api/token', {
			    
			}).then((response) => {

				this.token = response.data.token;
				
				EventBus.$emit('setToken', this.token);
			});
    	},
    	
    	setAuthCookie(){

    		// Max Age 5 days 432000 seconds
  		  	document.cookie = `token=${this.token}; max-age=432000;path=/`;
    	},
	},
  	template:`<button v-on:click="chooseLevel()" type="button" class="btn" :class="cls">
  		{{ label.split('-').join(' ').toLowerCase() }}
  	</button>`
});

// FormUsername Component
const FormUsername = Vue.component('formusername',{
	components: {
		
	},
	props: {
		player: String,
		token: String,
	},
	data(){
		return {
			
		}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {

	},
	methods: {
		
		sendUsername() {
			
			let username = this.$refs.your_name.value;
			
			axios.post('/api/username', {
				username: username,
				player: player,
				token: token,
				
			    headers: { Authorization: `${this.token}` }
			  })
			  .then(function (response) {
				  
				  console.log("USERNAME + RESPONSE", username, response);
			  });
		}
	},
  	template:`<form action="/" method="POST" v-on:submit.prevent="sendUsername">
				<div class="form-group">
                    <label for="your-name">Your name</label>
                    <input type="text" class="form-control" id="your-name" aria-describedby="yourName" placeholder="Enter your name" ref="your_name">
                    <small id="yourName" class="form-text text-muted">Thanks for playing with us!</small>
                </div>
                <div class="form-check">
                    <input type="hidden" class="form-check-input" id="honeypot" value="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
			</form>`
});

// ModalEndOfGame Component
const ModalEndOfGame = Vue.component('modalendofgame',{
	components: {
		
	},
	props: {
		won: String,
		player: String,
		token: String,
	},
	data(){
		return {
			
		}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {
		
		
	},
	methods: {
		
		closeModal() {

			EventBus.$emit('closeModalGameOver');
		}
	},
  	template:`<transition name="modal">
              <div class="modal-mask">
                <div class="modal-wrapper">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">
                        	<span v-if="won == '1'">You win!</span>
                    		<span v-else>Game over</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" v-on:click="closeModal">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <formusername v-if="won == '1'" :player="player" :token="token"></formusername>
                        <span v-else>Time is over, try again!</span>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" v-on:click="closeModal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </transition>`
});

// Main Vue Object
const vm = new Vue({
    el: '#app',
    components: {
        'board': Board,
        'fleet': Fleet,
        'difficulty': Difficulty,
        'countdown': Countdown,
        'formusername': FormUsername,
        'modalendofgame': ModalEndOfGame,
    },
    data(){
    	
		return {
			token: '',
			difficulty: '',
			difficultyLevel: '',
			gameStarted: false,
			gameOver: false,
			won: false,
			showModalGameOver: false,
		}
	},
    created() {
		
		EventBus.$on('setToken', (token) => {

			this.token = token;
		});
		
		EventBus.$on('setDifficulty', (label, level) => {

			this.difficulty = label;
			this.difficultyLevel = level;
		});
		
		EventBus.$on('startNewGame', () => {
			
			axios.get('/api/new-game/difficulty/' + this.difficultyLevel, {
    			
    			headers: { Authorization: `${this.token}` }
    		
			}).then((response) => {
				
				this.gameStarted = true;
				
				console.log("Game started!");
			});
		});
		
		EventBus.$on('gameOver', (player = null) => {

			if(player)
			{
				this.won = ((player.toString() === '2') ? '1' : player.toString());	
			}
			
			// @todo Send a message to save the winner on db
			
			this.gameOver = true;
			
			this.showModalGameOver = true;
		});
		
		EventBus.$on('closeModalGameOver', () => {
			
			this.showModalGameOver = false;
		});
		
	},
	mounted() {

	},
    methods: {
    	
	}
});