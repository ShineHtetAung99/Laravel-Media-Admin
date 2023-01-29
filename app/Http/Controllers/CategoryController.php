<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category direct list
    public function index(Request $request){
        $categories = Category::when(request('key'),function($query){
                $query  ->where('title','LIKE','%'.request('key').'%')
                        ->orWhere('category_id','LIKE','%'.request('key').'%');
        })->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    // create category page
    public function createPage(){
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request){
        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return redirect()->route('admin#category')->with(['createSuccess' => 'Category Created Successfully!']);

    }

    // delete category
    public function delete($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted Successfully!']);
    }

    // edit category
    public function edit($id){
        $category = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update category
    public function update($id, Request $request){
        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->updateCategoryData($request);
        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category')->with(['updateSuccess' => 'Category Updated Successfully!']);
    }

    // get category data
    private function getCategoryData($request){
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription
        ];
    }

    // update category data
    private function updateCategoryData($request){
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now()
        ];
    }

    // category validation check
    private function categoryValidationCheck($request){
        return Validator::make($request->all(), [
            'categoryTitle' => 'required|min:4',
            'categoryDescription' => 'required|min:10',
        ]);
    }
}
