@extends('layouts.app') 
@section('content')
<pagina tamanho="12">
    <painel titulo="Dashboard" cor="white">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
            <div class="row">
                @can('ehAutor')
                <div class="col-md-3">
                <caixa qtd="{{$totArtigo}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion-pie-graph"></caixa>
                </div>
                @endcan

                @can('ehAdmin')
                <div class="col-md-3">
                    <caixa qtd="{{$totUsuario}}" titulo="Usuários" url="{{route('usuarios.index')}}" cor="blue" icone="ion-person-stalker"></caixa>
                </div>
                @endcan
        
                @can('ehAdmin')
                <div class="col-md-3">
                    <caixa qtd="{{$totAutor}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="ion-person"></caixa>
                </div>
                @endcan

                @can('ehAdmin')
                <div class="col-md-3">
                    <caixa qtd="{{$totAdmin}}" titulo="Administradores" url="{{route('adm.index')}}" cor="green" icone="ion-person"></caixa>
                </div>
                @endcan
            </div>
    </painel>
</pagina>
@endsection