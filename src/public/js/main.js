/* *****************************************************************************************
 *  
 *  Main Game Object
 *  
 */
const Game = Vue.component('game',{
	components: {
		
	},
	props: {
		
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
  	template:`<div>Vuejs Integration Board 1 and 2</div>`
});

/* *****************************************************************************************
 *  
 *  Main Vue Object
 *  
 */
const vm = new Vue({
    el: '#app',
    components: {
        'game': Game
    },
    data(){
		return {
			
		}
	},
    created(){
    	//this.setAuthCookie();
	},
    methods: {
    	setAuthCookie(){
    		/**
             * @note Save a cookie and use it instead of the input value. 
             * @todo Set expires=Mon, 03 Oct 2019 20:47:11 UTC; 
             */    		
       		document.cookie = `token=${this.token}; path=/`;
    	}
	}
});