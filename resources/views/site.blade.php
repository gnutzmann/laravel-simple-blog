@extends('layouts.app') 
@section('content')
<pagina tamanho="12">
    <painel titulo="Artigos" cor="white">

        <p>
            <div class="col-sm-1 offset-sm-11 col-md-4 offset-md-4">
            <form class="form-inline" action="{{route('site')}}" method="get">                                        
            <input type="search" class="form-control" name="busca" placeholder="Buscar" value="{{isset($busca) ? $busca : ""}}">            
                <button class="btn btn-info">Buscar</button>
            </form>
            </div>
            
        </p>

        <div class="row">
            
            @foreach ($lista as $key => $value )
            <artigo-card titulo="{{str_limit($value->titulo,30,'...')}}" descricao="{{str_limit($value->descricao,40,'...')}}" link="{{route('artigo',[$value->id,str_slug($value->titulo)])}}" imagem="{{Storage::url($value->image_path)}}" imagemcap="{{$value->titulo}}" data="{{$value->data}}"
                autor="{{$value->autor}}" sm="6" md="4" xl="4" padd="2">
            </artigo-card>
            @endforeach

        </div>         
        <div align="center">{{$lista}}</div>        
    </painel>
</pagina>
@endsection