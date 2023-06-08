<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::select(
            "products.id",
            "products.sku",
            "products.name",
            "products.price",
            "products.stock",
            "categories.id as categoriesId",
            "categories.name as categoriesName",
            DB::raw("UNIX_TIMESTAMP(products.created_at) as createAt")
        )
        ->leftJoin("categories","products.category_id","=","categories.id") ;

        if ($request->has("sku")) {
            $arrSku = explode(',', $request->sku);
            $products->whereIn("products.sku",$arrSku);
        }

        if ($request->has("product_name")) {
            $nameProduct = str_replace(",","|",$request->product_name);
            $products->where("products.name","REGEXP",$nameProduct);
        }   

        if ($request->has("price_start")) {
            $products->where("products.price",">=",$request->price_start);
        }

        if ($request->has("price_end")) {
            $products->where("products.price","<=",$request->price_end);
        }

        if ($request->has("stock_start")) {
            $products->where("products.stock",">=",$request->stock_start);
        }

        if ($request->has("stock_end")) {
            $products->where("products.stock","<=",$request->stock_end);
        }

        if ($request->has("category_id")) {
            $cateId = explode(',', $request->category_id);
            $products->whereIn("categories.id",$cateId);
        }

        if ($request->has("category_name")) {
            $cateNma = explode(',', $request->category_name);
            $products->whereIn("categories.name",$cateNma);
        }

       return response()->json([
            "code" => 200,
            "result" => $products->paginate(10)
       ],200);
       
    }

    public function create(ProductRequest $request)
    {
        $product = Products::create([
            'sku' => $request->sku,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'created_by' => auth()->user()->id,
        ]);

        $dataRes = Products::with(["category" => function ($query){
                return $query->select("id","name");
            }
        ])->where("id", $product->id)
        ->select("id","sku","name","price","stock","category_id","created_at")
        ->first();

        $time = strtotime($dataRes->created_at);
        $arrDate = getdate($time);
        $epoch = mktime ( $arrDate['hours'], $arrDate['minutes'] , $arrDate['seconds'], $arrDate['mon'], $arrDate["mday"], $arrDate["year"] );

        
        $response = [
            "id" =>  $dataRes->id, 
            "sku" =>  $dataRes->sku, 
            "name" =>  $dataRes->name, 
            "price" => $dataRes->price, 
            "stock" => $dataRes->stock, 
            "category_id" => $dataRes->category_id, 
            "category" => [
                "id" =>   $dataRes->category->id, 
                "name" => $dataRes->category->name
            ] ,
            "created_at" => $epoch,
        ]; 

        return response()->json([
            "code" => 200,
            "data" => $response],
        200); 
         
    }
}
