<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Artigo;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => ""],            
        ]);

        $user = auth()->user();
        
        if ($user->admin == "S"){
            $totArtigo = Artigo::count();    
        }else{        
            $totArtigo = Artigo::where('user_id','=',$user->id)->count();
        }

        $totUsuario = User::count();
        $totAutor = User::where('autor', '=', 'S')->count();
        $totAdmin = User::where('admin', '=', 'S')->count();

        return view('admin',compact('listaMigalhas','totUsuario','totArtigo','totAutor','totAdmin'));
    }
}
