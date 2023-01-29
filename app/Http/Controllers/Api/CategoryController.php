<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // get all category
    public function getAllCategory(){
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'category' => $category
        ]);
    }

    // category search
    public function categorySearch(Request $request){
        $category = Category::select('posts.*')
                    ->join('posts','categories.category_id','posts.category_id')
                    ->where('categories.title','LIKE','%'.$request->key.'%')
                    ->orderBy('created_at','desc')->get();
        return response()->json([
            'result' => $category
        ]);
    }

}
