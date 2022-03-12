<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Nft;
use Hash;

class ProductosController extends Controller
{
    public function miFuncion(){
        $categorias = \DB::table('categories')->get();
        $productos =  \DB::table('nfts')->orderBy('id','DESC')->get();
        //dd($categorias);
        return view('dash.productos')
            ->with('nfts',$productos)
            ->with('categorias',$categorias);
    }

    public function insertar(Request $req){
        //dd($req);
        $validacion = Validator::make($req->all(), [
            'name'=>'required|min:4|max:100',
            'description'=>'required|min:5',
            'price'=>'required',
            'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000',
            'btype'=>'required',
            'cate'=>'required'
        ]);
        if($validacion->fails()){
            return back()
                ->withInput()
                ->with('ErrorInsert','Favor de llenar todos los campos')
                ->withErrors($validacion);
        }else{
            $ti=Hash::make(rand(0,9999999));
            $ts=Hash::make(rand(0,9999999));
            $img = $req->file('img');
            $name = time(). '.' .$img->getClientOriginalExtension();
            $destination_path=public_path('nfts');//se trae la carpeta public
            $req->img->move($destination_path, $name);

            $nuevo = Nft::create([
                'name'=>$req->name,
                'description'=>$req->description,
                'base_price'=>$req->price,
                'img'=>$name,
                'blockchain_type'=>$req->btype,
                'id_category'=>$req->cate,
                'token_id'=>$ti,
                'token_standar'=>$ts,
                'metadata'=>'',
                'id_user'=>1,
                'likes'=>0
            ]);
            return back()->with('Listo','Se ha insertado correctamente');
            
        }//llave else

    }//llave funcion


}
