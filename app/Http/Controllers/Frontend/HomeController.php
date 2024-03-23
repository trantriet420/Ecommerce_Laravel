<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brand;

class HomeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getProducts = Products::orderBy('created_at', 'desc')->get()->toArray();
        //dd($getProducts);
        
        foreach($getProducts as &$productList){
              $productList['hinhanh'] = json_decode($productList['hinhanh'],true);
              //dd($productList['hinhanh']);
        }
        return view('Frontend.index',compact('getProducts'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $detailProduct = Products::find($id)->toArray();
       //dd($detailProduct);
        $getArrImage = json_decode($detailProduct['hinhanh'], true);
        //dd($getArrImage);

        $Brand = Brand::all()->toArray();
        //dd($Brand);
        return view ('Frontend.Detail.detailProduct',compact('detailProduct','getArrImage','Brand'));
    }

    
}
