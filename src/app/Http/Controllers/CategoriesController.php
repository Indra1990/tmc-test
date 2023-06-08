<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\CategoriesRequest;

class CategoriesController extends Controller
{
    public function create(CategoriesRequest $request)
    {

        $category = Categories::create([
            "name" => $request->name,
            "created_by" => auth()->user()->id,
        ]);

        $time = strtotime($category->created_at);
        $arrDate = getdate($time);

        $epoch = mktime ( $arrDate['hours'], $arrDate['minutes'] , $arrDate['seconds'], $arrDate['mon'], $arrDate["mday"], $arrDate["year"] );

        $data = [
            "id" => $category->id,
            "name" => $category->name,
            "createAt" =>  $epoch
        ];

        return response()->json([
            "code" => 200,
            "data" => $data
        ],200); 
    }
}
