@extends('layouts.app') 
@section('content')
<pagina tamanho="12">

    @if($errors->all())       
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $key => $value)
                <li>{{$value}}</li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>        
    @endif

    <painel titulo="Lista de artigos" cor="white">        
        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

        <tabela-lista v-bind:titulos="['#','Título','Descrição','Autor','Data']" 
                      v-bind:itens="{{json_encode($listaArtigos)}}"
                      ordem="desc" ordemcol="0"
                      criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
                      modal="sim">
        </tabela-lista>
        <div align="center">{{$listaArtigos}}</div>        
    </painel>
</pagina>


<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
        </div>        

        <div class="form-group">
            <label for="addConteudo">Conteúdo</label>         
            <ckeditor id="addConteudo" 
                      name="conteudo" 
                      value="{{old('conteudo')}}" 
                      v-bind:config="{ toolbar: [ [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript','-','TextColor', 'BGColor', 'Styles', 'Format', 'Font', 'FontSize', '-', 'Source'] ], height: 200 }"
                      >
            </ckeditor>
        </div>

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" id="data" name="data" class="form-control" value="{{old('data')}}">
        </div>

        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="imagem">
                <label class="custom-file-label" for="imagem">Selecione uma imagem</label>
            </div>        
        </div>
    
    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>
</modal>

<modal nome="editar" titulo="Editar">    
        <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
            </div>

            <div class="form-group">
                <label for="editConteudo">Conteúdo</label>              
                <ckeditor id="editConteudo" name="conteudo" v-model="$store.state.item.conteudo" v-bind:config="{ toolbar: [ [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript','-','TextColor', 'BGColor', 'Styles', 'Format', 'Font', 'FontSize', '-', 'Source'] ], height: 200 }">
                </ckeditor>

            </div>
            
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" class="form-control" v-model="$store.state.item.data">
            </div>

           <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imagem" name="imagem">
                    <label class="custom-file-label" for="imagem">Selecione uma imagem</label>
                </div>
            </div>

        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
</modal>

<modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
    <p>@{{$store.state.item.descricao}}</p>
    <ckeditor id="viewConteudo" name="conteudo" v-model="$store.state.item.conteudo" v-bind:config="{ toolbar: [ [] ], height: 200 }">
    </ckeditor>    
    <!--<p>@{{$store.state.item.conteudo}}</p>    -->
</modal>

@endsection