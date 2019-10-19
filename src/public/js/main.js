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
			
			console.log("CLICK ON GAME OVER", this.gameOver);
			
			if(!this.gameOver)
			{
				// Prevent click on already attacked cells and on player 1 board
				if(!this.attacked && this.currentPlayer == 2)
				{
					axios.get('/api/hit-coordinates/player' + this.currentPlayer + '/' + this.row + '/' + this.col, {
		    			
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
	
						console.log("CURREENT PLAYA:", this.currentPlayer);
						
						//this.currentPlayer == 1;
						
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
				
				if(!hit)
				{
					this.attacked = true;
				}
				else {
					
					this.hit = true;
					this.attacked = true;
					
					this.$root.$emit('hitShip', this.player, shipId, hull);
				}
				
				console.log('HitCoordinatesOnFightBack method 000:', results);
			}
			
			// console.log('HitCoordinatesOnFightBack method 111:', results);
		},
	},
  	template:`<div @click="hitCoordinates((row - 1), (col - 1));">
        		<i v-if="!attacked && !hit && !gameOver" class="fas fa-align-justify animated rubberBand"></i>
        		
        		<i v-if="attacked && hit && !gameOver" class="fas fa-bomb animated bounce"></i>
        		
        		<i v-if="attacked && !hit && !gameOver" class="fas fa-water animated wobble"></i>
        		<i v-if="gameOver" class="fas fa-ban animated zoomIn"></i>
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
  		<div class="countdown-block">
	        <p class="digit"><i class="fas fa-hourglass-half"></i></p>
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
  	template:`<div class="ship-hull" :class="{'hit': hit, 'animated bounce': hit}" :title="ship.type"></div>`
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
  				<div v-for="hullId in ship.len">
  					<hull :ship="ship" :id="hullId - 1"></hull>
  				</div>
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
				
				console.log("DECREASED", 'player' + player, this.shipsHullsTotal[player]);
				
				if(this.shipsHullsTotal[player].toString() == '0')
				{
					console.log("GAME OVER");
					
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
  			<p>Fleet {{ player }}</p>
  			
  			<div v-for="ship in ships">
	  			<ship :ship="ship"></ship>
	  		</div>
  			 
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
	},
	data(){
		return {
			rows: 10,
			cols: 10,
			alphabet: [...'abcdefghij'], /*klmnopqrstuvwxyz*/
		}
	},
	created() {

		EventBus.$on('fightBack', (player) => {

			console.log('SENT PLAYA', player);
			
			// Do the trick: Call the fightBack just once
			if(player.toString() != '1')
			{
				return;
			}
			
			//let reversedPlayer = ((player.toString() === '2') ? '1' : player.toString());
			
			//EventBus.$emit('changePlayer', reversedPlayer);
			
			console.log("REVERSED:", player.toString());
			
			
			axios.get('/api/fight-back/player' + player, {
				
				headers: { Authorization: `${this.token}` }
			
			}).then((response) => {
	
				if(response)
				{
					let row = response.data.results.x;
					let col = response.data.results.y;
					let results = response.data.results;
					
					let ref = 'cell-ref-' + player + '-' + row + '-' + col;

					console.log("REF", ref);
					console.log("REF PLAYA OBJ", this.player);
					console.log("REF PLAYA VAR", player);
					
					if(this.$refs[ref])
					{
						console.log(this.$refs[ref]);
						
						this.$refs[ref][0].HitCoordinatesOnFightBack(results);
					}	
				}
			});
		});
	},
	mounted() {
		
		// console.log('fight back mounted:', this.$refs);
	},
	watch: {

	},
	methods: {

	},
  	template:`<div class="board" :class="'player' + player">
  		<p>Board {{ player }}</p>
  		
  		<table class="board" :class="'player' + player">
		    <tbody>
		        <tr v-for="row in rows" class="board-row" :class="'board-row-' + (row - 1)">
		        
		        	<td class="board-row-header" :class="'board-row-header-' + (row - 1)">{{ alphabet[row - 1].toUpperCase() }}</td>
		        	
		        	<td v-for="col in cols" class="board-cell" :class="'board-cell-row-' + (row - 1) + ' board-cell-col-' + (col - 1)">
	        			<cell :token="token" :player="player" :cols="cols" :col="col - 1" :row="row - 1" :game-over="gameOver" :key="'cell-ref-' + player + '-' + (row - 1) + '-' + (col - 1)" :ref="'cell-ref-' + player + '-' + (row - 1) + '-' + (col - 1)"></cell>
	        		</td>
		        </tr>
		    </tbody>
		    <tfoot>
		    	<tr class="board-row-footer">
		        	<td class="board-empty"><span>&nbsp;</span></td>
  					<td v-for="col in cols" class="board-col" :class="'board-col' + (col - 1)">
  						{{ col }}
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
  	template:`<button v-on:click="chooseLevel()" type="button" class="btn" :class="cls">{{ label }}</button>`
});


// Main Vue Object
const vm = new Vue({
    el: '#app',
    components: {
        'board': Board,
        'fleet': Fleet,
        'difficulty': Difficulty,
        'countdown': Countdown,
    },
    data(){
    	
		return {
			token: '',
			difficulty: '',
			difficultyLevel: '',
			gameStarted: false,
			gameOver: false,
			won: false,
		}
	},
    created() {
		
		/*EventBus.$on('changePlayer', (player) => {

			this.player = player;
			
			console.log('Playa:', this.player);
		});*/
		
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
		});
	},
	mounted() {
		//console.log('Playa:', this.player);
	},
    methods: {
    	
	}
});