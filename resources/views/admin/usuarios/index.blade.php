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

    <painel titulo="Lista de usuários" cor="white">
        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

        <tabela-lista v-bind:titulos="['#','Nome','e-mail']" v-bind:itens="{{json_encode($listaModelo)}}" ordem="asc" ordemcol=1
            criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/" token="{{ csrf_token() }}"
            modal="sim">
        </tabela-lista>
        <div align="center">{{$listaModelo}}</div>
    </painel>
</pagina>


<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('usuarios.store')}}" method="post" enctype="" token="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="email">e-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="e-mail" value="{{old('email')}}">
        </div>

        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control">
                        <option {{( old('autor') && (old('autor') == 'N') ? 'selected' : '') }} value="N">Não</option>
                        <option {{( old('autor') && (old('autor') == 'S') ? 'selected' : '') }} value="S">Sim</option>
                    </select>
        </div>

        <div class="form-group">
            <label for="admin">Administrador</label>
            <select name="admin" id="admin" class="form-control">
                                <option {{( old('admin') && (old('admin') == 'N') ? 'selected' : '') }} value="N">Não</option>
                                <option {{( old('admin') && (old('admin') == 'S') ? 'selected' : '') }} value="S">Sim</option>
                    </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}">
        </div>

    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>
</modal>

<modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" v-bind:action="'/admin/usuarios/' + $store.state.item.id" method="put" enctype="multipart/form-data"
        token="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="email">e-mail</label>
            <input type="email" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="e-mail">
        </div>

        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control" v-model="$store.state.item.autor">
                                <option value="N">Não</option>
                                <option value="S">Sim</option>
                    </select>
        </div>

        <div class="form-group">
            <label for="admin">Administradores</label>
            <select name="admin" id="admin" class="form-control" v-model="$store.state.item.admin">
                                <option value="N">Não</option>
                                <option value="S">Sim</option>
                    </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" v-model="$store.state.item.password">
        </div>

    </formulario>
    <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
</modal>

<modal nome="detalhe" v-bind:titulo="$store.state.item.name">
    <p>@{{$store.state.item.email}}</p>
</modal>
@endsection