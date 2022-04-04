<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index(){
      //select  * from categorias limit 2  where id >10 
        $categorias = \DB::table('categories')
         ->orderBy('category','ASC')           
         ->get();
        $productos = \DB::table('nfts')
         ->orderBy('id','DESC')
         ->get();
        return view('front.index')
         ->with('categories',$categorias)
         ->with('nfts',$productos);
   }
}
