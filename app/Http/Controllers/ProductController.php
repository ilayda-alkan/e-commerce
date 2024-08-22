<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $categories = Category::all();

        $query = Product::query();

        if ($request->has('category_id') && $request->category_id != '') 
            $query->where('products.category_id', $request->category_id);

    
        $products = $query->paginate();
        return view('pages.product.list', compact('products','categories'));
    }

    public function insert()
    {
        $categories = Category::all();
        return view('pages.product.insert', compact('categories'));
    }

    public function create(Request $request)
    {
  
        $request -> validate([
            'title' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'barcode' =>'unique:products,barcode|min:6|max:8',
            'status'=>'nullable|boolean',
            'quantity'=>'required|integer',
            'price' =>'required|numeric'

        ]);
        $status = $request->input('status', false);

        $isProduct = Product::where('title',$request->title)->first();
 
        if($isProduct) 
           return redirect()->back()->withErrors(['product' => 'This product is already registered.']);
        
        $product = new Product();
        $product->title = $request->input('title');
        $product->category_id = $request->input('category_id');
        $product->barcode = $request->input('barcode');
        $product->status = $request->input('status');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
       
        $product->save();
    
        return redirect()->route('product.list');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); 

        return view('pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'barcode' =>'unique:products,barcode|min:6|max:8',
            'status'=>'nullable|boolean',
            'quantity'=>'required|integer',
            'price' =>'required|numeric'
        ]);
    
        $product = Product::findOrFail($id);
        $product->title = $request->input('title');
        $product->category_id = $request->input('category_id');
        $product->barcode = $request->input('barcode');
        $product->status = $request->input('status');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
    
        $product->save();
    
        return redirect()->route('product.list')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $product->delete();

            return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
        }

    }

    public function bulkDelete(Request $request)
    {
        $productIds = $request->input('product_ids', []);

        if(!empty($productIds)) {
            Product::whereIn('id',$productIds)->delete();
        }

        return redirect()->route('product.list')->with('success', 'Selected product deleted successfull');
    }

}




