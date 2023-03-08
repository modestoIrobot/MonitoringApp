<template>
		<transition name="modal">
	        <div class="modal-mask">
	          <div class="modal-wrapper">
	            <div class="modal-container">
					<div class="modal-header">
	                	<slot name="header">
	                  		default header
	                	</slot>
	              	</div>

	              	<div class="modal-body">
	                	<slot name="body">
	                  		<div class="field">
						        <label class="label">Nom</label>
						        <div class="control">
						          <input class="input" type="text" v-model="name" />
						        </div>
						    </div>
						    <div class="field">
						        <label class="label">Description</label>
						        <div class="control">
						 			<input class="input" v-model="description" type="text" />
						        </div>
						    </div>
	                	</slot>
	              	</div>

	                <div class="modal-footer">
	                	<slot name="footer">
		                  	default footer
		                  	<button class="modal-default-button" @click="close">
		                    	OK
		                  	</button>
	                	</slot>
	              	</div>
	            </div>
	          </div>
	        </div>
	    </transition>
</template>
<script>
	import axios from 'axios';
	export default {
	    name: 'Modal9',
	    props: ['item'],
	    data() {
      		return {
	         name: '',
	         description: ''          
      		}
   		},
	    methods: {
	      async close() {
	      	const response = await axios.put('http://localhost:8000/api/pages/'+this.$route.params.id2+'/fonctions/'+this.item.id, {
	            name: this.name,
	            description: this.description
          	});
          	console.log(response.data.message);    
	       	this.$emit('close',{value1:this.item, value2: response.data.data});
	      }
	    }
  	};
</script>
<style>
	.modal-mask {
	  position: fixed;
	  z-index: 9998;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  background-color: rgba(0, 0, 0, 0.5);
	  display: table;
	  transition: opacity 0.3s ease;
	}

	.modal-wrapper {
	  display: table-cell;
	  vertical-align: middle;
	}

	.modal-container {
	  width: 300px;
	  margin: 0px auto;
	  padding: 20px 30px;
	  background-color: #fff;
	  border-radius: 2px;
	  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	  transition: all 0.3s ease;
	  font-family: Helvetica, Arial, sans-serif;
	}

	.modal-header h3 {
	  margin-top: 0;
	  color: #42b983;
	}

	.modal-body {
	  margin: 20px 0;
	}

	.modal-default-button {
	  float: right;
	}

	/*
	 * The following styles are auto-applied to elements with
	 * transition="modal" when their visibility is toggled
	 * by Vue.js.
	 *
	 * You can easily play with the modal transition by editing
	 * these styles.
	 */

	.modal-enter {
	  opacity: 0;
	}

	.modal-leave-active {
	  opacity: 0;
	}

	.modal-enter .modal-container,
	.modal-leave-active .modal-container {
	  -webkit-transform: scale(1.1);
	  transform: scale(1.1);
	}
</style>