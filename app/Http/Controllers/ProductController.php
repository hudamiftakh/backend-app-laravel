<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store('products');
        $product->save();
        return $req->input();
    } 

    public function listProduct()
    {
        return Product::all();
    }
    public function delete($id)
    {
        $result = Product::where('id',$id)->delete();
        if ($result) {
            return['result'=>'Product has been deleted'];
        }else{
            return['result'=>'Product Empty'];
        }
    }


    public function getProduct($id)
    {
         return Product::find($id);
    }

    public function updateProduct($id, Request $req)
    {
        $product = Product::find($id);
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        if($req->file('file')){
            $product->file_path = $req->file('file')->store('products');
        }
        $product->save();
        return $req->input();
    }

    public function search($key)
    {
        return Product::where('name','like',"%".$key."%")->get();
    }
}
