<template>
    <div v-bind:class="'col-sm-' + (sm || '6') + ' col-md-' + (md || '4') + ' col-xl-' + (xl || '3') + ' p-' + (padd || '2')">
        <div class="card">
            <img class="card-img-top" src="http://via.placeholder.com/286x180" v-bind:alt="imagemcap">
            <div class="card-body">
                <h5 class="card-title">{{titulo}}</h5>
                <p class="card-text">{{descricao}}</p>
                <p class="card-text"><small class="text-muted">{{data | formataData}} - {{autor}}</small></p>
                <a v-bind:href="link" class="btn btn-primary">Leia mais ...</a>
            </div>            
        </div>               
    </div>
</template>

<script>
export default {
    props: ['titulo','descricao','link','imgagem','imagemcap','data','autor','sm','md','xl','padd'],
    filters: {
        formataData : function(valor){
            if (!valor) return '';
            valor = valor.toString();
            
            if (valor.split('-').length == 3) {
                valor = valor.split('-');
                return valor[2] + '/' + valor[1] + '/' + valor[0];
            } 

            return valor;
        }
    }
};
</script>
