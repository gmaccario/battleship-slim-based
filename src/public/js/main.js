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
		alphabet: Array,
		player: String,
		token: String,
	},
	data(){
		return {
			hit: false,
			attacked: false,
		}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {

	},
	methods: {
		
		hitCoordinates(row, col) {
			
			//console.log("row", this.row, "col", this.col, 'player', this.player);
			
			if(!this.attacked)
			{
				axios.get('/api/hit-coordinates/player' + this.player + '/' + this.row + '/' + this.col, {
	    			
	    			headers: { Authorization: `${this.token}` }
	    		
				}).then((response) => {

					console.log('hitCoordinates', response.data.results);
					
					if(!response.data.results.hit)
					{
						this.attacked = true;
					}
					else {
						this.attacked = true;
						this.hit = true;
						
						//console.log('hitShip', response.data.results.shipId);
						this.$root.$emit('hitShip', response.data.results.shipId);
						//EventBus.$emit('hitShip', response.data.results.shipId);
					}
				});	
			}
		}
	},
  	template:`<div @click="hitCoordinates((row - 1), (col - 1));">
        		<i v-if="!attacked && !hit" class="fas fa-align-justify"></i>
        		<i v-if="attacked && hit" class="fas fa-bomb"></i>
        		<i v-if="attacked && !hit" class="fas fa-water"></i>
        		
        		<!-- Cell {{ alphabet[row - 1].toUpperCase() }}{{ (col - 1) }} -->
        	</div>`
});

// Hull Component
const Hull = Vue.component('hull',{
	components: {
		
	},
	props: {
		shipId: Number,
		hullId: Number,
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
		
	},
  	template:`<div class="ship-hull" :class="'hullId-' + hullId"></div>`
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
			id: 0,
			//hulls: []
		}
	},
	created() {
		
		this.setup();
	},
	mounted() {
		
		this.$root.$on('hitShip', (shipId) => {
			
			if(shipId == this.id) 
			{
				//console.log(shipId);
				// @todo Make it red
			}
		})
	},
	watch: {
		
	},
	methods: {
		
		setup(){
			
			this.id = this.ship.id;
		}
	},
  	template:`<div class="ship" :class="'ship-' + ship.id + ' type-' + ship.type.split(' ').join('-').toLowerCase()">
  				<div v-for="hullId in ship.len">
  					<hull :shipId="ship.id" :hullId="hullId"></hull>
  				</div>
  			</diV>`
});

// Board Component
const Board = Vue.component('board',{
	components: {
		'cell': Cell,
	},
	props: {
		player: String,
		token: String,
	},
	data(){
		return {
			rows: 10,
			cols: 10,
			alphabet: [...'abcdefghij'] /*klmnopqrstuvwxyz*/
		}
	},
	created() {
		
	},
	mounted() {
		
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
	        			<cell :token="token" :player="player" :cols="cols" :col="col" :row="row" :alphabet="alphabet"></cell>
	        		</td>
		        </tr>
		    </tbody>
		    <tfoot>
		    	<tr class="board-row-footer">
		        	<td class="board-empty"><span>&nbsp;</span></td>
  					<td v-for="col in cols" class="board-col" :class="'board-col' + (col - 1)">{{ (col - 1) }}</td>
		        </tr>
		    </tfoot>
		  </table>
  		</div>`
});

// Fleet Component
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
		}
	},
	created() {
		
	},
	mounted() {
		
	},
	watch: {
		
		gameStarted: function (val) {

			this.setFleet();
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

// Difficulty Component
const Difficulty = Vue.component('difficulty',{
	components: {
		
	},
	props: {
		cls: String,
		level: String,
	},
	data(){
		return {
			token: '',
			difficulty: ''
		}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {
		difficulty: function (val) {
			
			this.getNewToken();
	    },
		token: function (val) {
			
			this.setAuthCookie();
			
			EventBus.$emit('startNewGame');
	    },
	},
	methods: {
		chooseLevel(level){
			
			this.difficulty = level;
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
  	template:`<button v-on:click="chooseLevel(level)" type="button" class="btn" :class="cls">{{ level }}</button>`
});


// Main Vue Object
const vm = new Vue({
    el: '#app',
    components: {
        'board': Board,
        'fleet': Fleet,
        'difficulty': Difficulty,
    },
    data(){
    	
		return {
			token: '',
			gameStarted: false,
		}
	},
    created(){
		EventBus.$on('setToken', (token) => {

			this.token = token;
		});
		
		EventBus.$on('startNewGame', (token) => {

			axios.get('/api/new-game/difficulty/' + this.difficulty, {
    			
    			headers: { Authorization: `${this.token}` }
    		
			}).then((response) => {
				
				this.gameStarted = true;
				
				console.log("Game started!");
			});
		});
	},
    methods: {
    	
	}
});