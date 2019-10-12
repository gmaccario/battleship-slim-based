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
    		/**
             * @note Save a cookie and use it instead of the input value. 
             * @todo Set expires=Mon, 03 Oct 2019 20:47:11 UTC; 
             */    		
       		document.cookie = `token=${this.token}; path=/`;
    	}
	}
});