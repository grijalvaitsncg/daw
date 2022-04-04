<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use File;

class CategoriesController extends Controller
{
   public function index(){
       $cates = \DB::table('categories')->get();
       return view('dash.categories')->with('cates',$cates);
   }
   public function store(Request $req)
   {
    $validacion = Validator::make($req->all(), [
        'name'=>'required|min:4|max:100',
        'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
    ]);
    if($validacion->fails()){
        return back()
            ->withInput()
            ->with('ErrorInsert','Favor de llenar todos los campos')
            ->withErrors($validacion);
    }else{
            $img = $req->file('img');
            $name = time(). '.' .$img->getClientOriginalExtension();
            $destination_path=public_path('categories');//se trae la carpeta public
            $req->img->move($destination_path, $name);
            Category::create([
                'category'=>$req->name,
                'img'=>$name
            ]);
            return back()->with('Listo','Se ha insertado correctamente');


        }


   }
   public function destroy($id)
   {
      $categoria =  Category::find($id);
      if($categoria->img !='default.jpg'){
          if(File::exists(public_path('categories/'.$categoria->img))){
            unlink(public_path('categories/'.$categoria->img));
          }
      }
      //delete from categorys where id =
      $categoria->delete();
      
      return back()->with('Listo',' El registro se elimino correctamente');
   }
   public function update(Request $req){
    $validacion = Validator::make($req->all(), [
        'name'=>'required|min:4|max:100',
       // 'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
    ]);
    if($validacion->fails()){
        return back()
            ->withInput()
            ->with('ErrorInsert','Favor de llenar todos los campos')
            ->withErrors($validacion);
    }else{
        $validacion2 = Validator::make($req->all(),[
            'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
        ]);
        $registro = Category::find($req->id);
        if($validacion2->fails()){
            $registro->category= $req->name;
            $registro->save();
        }else{
            if($registro->img !='default.jpg'){
                if(File::exists(public_path('categories/'.$registro->img))){
                  unlink(public_path('categories/'.$registro->img));
                }
            }
            //subir la imagen
            $img = $req->file('img');
            $name = time(). '.' .$img->getClientOriginalExtension();
            $destination_path=public_path('categories');//se trae la carpeta public
            $req->img->move($destination_path, $name);
            $registro->category =  $req->name;
            $registro->img = $name;
            $registro->save();
        }//llave else    
        return back()->with('Listo','Se ha actualizado correctamente');


        }
   }//llave update



}
