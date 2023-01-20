<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Load all products or if clientId provided then only load product that are associated to client
     * @param int $clientId
     * @return \Illuminate\Http\JsonResponse
     */
   public function getProduct($clientId=0)
   {
       if(!empty($clientId)){
         $products = Product::where('client_id',$clientId)->get();
       }else{
         $products = Product::all();
       }
       return response()->json(['status'=>true,'msg'=>'product list','data'=>array('products'=>$products)]);
   }
}
