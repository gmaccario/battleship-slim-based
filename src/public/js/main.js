// Board Component
const Board = Vue.component('board',{
	components: {
		
	},
	props: {
		player: String,
	},
	data(){
		return {}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {
		
	},
	methods: {

	},
  	template:`<div>
  		<p>Board {{ player }}</p>
  		</div>`
});

// Fleet Component
const Fleet = Vue.component('fleet',{
	components: {
		
	},
	props: {
		player: String,
	},
	data(){
		return {}
	},
	created() {
		
	},
	mounted() {

	},
	watch: {
		
	},
	methods: {

	},
  	template:`<div>
  		<p>Fleet {{ player }}</p>
  		</div>`
});


// Main Vue Object
const vm = new Vue({
    el: '#app',
    components: {
        'board': Board,
        'fleet': Fleet,
    },
    data(){
    	
		return {
			token: ''
		}
	},
    created(){
		
    	this.getToken();
	},
    methods: {
    	
    	getToken()
    	{
    		axios.get('/api/token', {
			    
			}).then((response) => {

				this.token = response.data.token;
				
				this.setAuthCookie();
			});
    	},
    	
    	setAuthCookie(){

    		// Max Age 5 days 432000 seconds
  		  	document.cookie = `token=${this.token}; max-age=432000;path=/`;
  		  	console.log(document.cookie);
    	}
	}
});