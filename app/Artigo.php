<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo','descricao','conteudo','data','user_id','image_path'];

    protected $date = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setImagePath($path) {
        $this->image_path = $path;
    }

    public static function listaArtigos($paginacao)
    {

        $user = auth()->user();

        if ($user->admin == "S") {        
            return DB::table('artigos')
                ->join('users', 'users.id', '=', 'artigos.user_id')
                ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
                ->whereNull('deleted_at')
                ->orderBy('artigos.id','DESC')
                ->paginate($paginacao);
        }else{
            return DB::table('artigos')
                ->join('users', 'users.id', '=', 'artigos.user_id')
                ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
                ->whereNull('deleted_at')
                ->where('artigos.user_id','=',$user->id)
                ->orderBy('artigos.id', 'DESC')
                ->paginate($paginacao);
        }
    }

    public static function listaArtigosSite($paginacao,$busca = null)
    {

        if (isset($busca)) {
            return DB::table('artigos')
                ->join('users', 'users.id', '=', 'artigos.user_id')
                ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data', 'artigos.image_path')
                ->whereNull('deleted_at')
                ->whereDate('data', '<=', date('Y-m-d'))
                ->where(function($query) use($busca){
                    $query->orWhere('titulo', 'like', '%' . $busca . '%')
                          ->orWhere('descricao', 'like', '%' . $busca . '%');
                })
                ->orderBy('data', 'DESC')
                ->paginate($paginacao);

        }else{
            return DB::table('artigos')
                    ->join('users', 'users.id', '=', 'artigos.user_id')
                    ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data', 'artigos.image_path')
                    ->whereNull('deleted_at')
                    ->whereDate('data','<=',date('Y-m-d'))
                    ->orderBy('data','DESC')
                    ->paginate($paginacao);
        }
    }
}