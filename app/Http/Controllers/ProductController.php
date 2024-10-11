<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function ServerIndexPage()
    {
        return view('server.index', ['products' => Product::get() ]);
    }
    public function ServerCreatePage()
    {
        return view('server.create');
    }
    public function ServerProductStore(Request $request){
    //upload image
    // dd($imageName);
    $request->validate([
        'name'=> 'required',
        'price'=> 'required',
        'description' => 'required'
    ]);
    $product = new Product;
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();

    if ($request->image  != null){
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('product'), $imageName);
        $product->image = $imageName;
        $product->save();
    }
    // return back;
    return redirect()->route('server-index');
    }

    public function ServerEditProduct($id)
    {
        // dd($id);
        // $product = Product::find($id);
        //Calling this method as id is unique value/primary key
        $product = Product::where('id', $id)->first();
        return view('server.edit', ['product' => $product ]);
    }
    public function ServerUpdateProduct(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        //Same functionaliity as ServerCreateProduct
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'description' => 'required'
        ]);
        $product = Product::where('id', $id)->first();


        // $product = new Product; Not needed in order to update product
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image  != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('product'), $imageName);
            $product->image = $imageName;
            $product->save();
        }
        // return back;
        return redirect()->route('server-index');

    }
    public function ServerDeleteProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('server-index');
    }
    public function ServerOrdersPage()
    {
        return view('server.order');
    }
}
