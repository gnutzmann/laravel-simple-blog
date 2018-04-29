<?php

namespace App\Http\Controllers\Admin;

use App\Artigo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => route('admin')],
            ["titulo" => "Lista de artigos", "url" => ""],
         ]);

        /*
        COMENTADO PORQUE SERÀ UTILIZADO QUERY BUILDER ABAIXO
        //$listaArtigos = Artigo::select('id', 'titulo', 'descricao', 'user_id', 'data')->paginate(10);

        //foreach ($listaArtigos as $key => $value){
            //$value->user_id = \App\User::find($value->user_id)->name;

            //Forma opcional de trazer o valor do campo relacionado
            //$value->user_id = $value->user->name;
            //unset($value->user);
        //}
        */

        /* $listaArtigos = json_encode([
        ["id" => "1", "titulo" => "PHP OO", "descricao" => "Curso de PHP OO","data" => "2017-11-20"],
        ["id" => "2", "titulo" => "Vue JS", "descricao" => "Curso de Vue JS","data" => "2017-11-20"]
        ]); */
        

        /*
        $listaArtigos = DB::table('artigos')
                            ->join('users','users.id','=','artigos.user_id')
                            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
                            ->whereNull('deleted_at')
                            ->paginate(10);*/
        //O CÓDIGO ACIMA FOI REMANEJADO PARA O MODEL ARTIGO                            
                
        $listaArtigos = Artigo::listaArtigos(5);

        return view('admin.artigos.index', compact('listaMigalhas', 'listaArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $data = $request->all();

        $validacao = \Validator::make($data, [
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $user = auth()->user();
        $user->artigos()->create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Artigo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validacao = \Validator::make($data, [
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $user = auth()->user();
        $user->artigos()->find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artigo::find($id)->delete();
        return redirect()->back();
    }
}