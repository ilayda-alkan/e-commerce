<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;

class CategoryController extends Controller
{
    
    public function list()
    {
        $categories = Category::all();
        return view('pages.category.list',compact('categories'));
    }

    public function insert()
    {
        return view('pages.category.insert');
    }
    public function create(Request $request)
    {
        $request -> validate([
            'title' => 'unique:categories,title',
            'description' =>'required',
            'status' => 'nullable|boolean'

        ]);
        $status = $request->has('status') ? true : false;

        // $isCategory = Category::where('title',$request->title)->first();
 
        //  if($isCategory) {
        //     return redirect()->back()->withErrors(['category' => 'This category is already registered.']);
        //  }

         Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status

         ]);

         return redirect()->route('category.list');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit',compact('category'));
    }

    public function update(Request $request ,$id)
    {
        $category = Category::findOrFail($id);
        $request -> validate([
            'title' => 'unique:categories,title,' . $id,
            'description' =>'required',
            'status' => 'nullable|boolean'
        ]);

        $category ->title = $request -> input('title');
        $category -> description = $request -> input('description');
        $category->status = $request->has('status') ? true : false;

        $category ->save();
        
        return redirect()->route('category.list')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories ->delete();
        return redirect()->route('category.list')->with('success','Category deleted successfully');  
    }

    public function bulkDelete(Request $request)
    {
        $categoriesIds = $request->input('categories_ids', []);

        if(!empty($categoriesIds)) {
            Category::whereIn('id',$categoriesIds)->delete();
        }

        return redirect()->route('category.list')->with('success', 'Selected category deleted successfull');
    }
}
