<template>    
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="card-header">{{titulo}}</div>
            <div class="card-body">
                <slot></slot>
        </div>
    </div>    
</template>
    
<script>
export default {
  props: ["titulo", "cor"],
  computed: {
    defineCor: function() {
      return "card " + (this.cor || "bg-secondary");
    }
  }
};
</script>

<style media="screen">
.blue {
    background-color: white; 
    color:black;   
}
.blue > .card-header {
	padding: 0.75rem 1.25rem;
	margin-bottom: 0;	
	border-bottom: 1px solid rgba(88, 5, 5, 0.125);
    background-color: #080161;
    color: white;    
}

.orange {
    background-color: white; 
    color:black;   
}
.orange > .card-header {
	padding: 0.75rem 1.25rem;
	margin-bottom: 0;	
	border-bottom: 1px solid rgba(88, 5, 5, 0.125);
    background-color: rgb(207, 95, 20);
    color: black;    
}

.white {
    background-color: white; 
    color:black;   
}
.white > .card-header {
	padding: 0.75rem 1.25rem;
	margin-bottom: 0;	
	border-bottom: 1px solid rgba(88, 5, 5, 0.125);
    background-color: #FFF;
    color: black;    
}

</style>

