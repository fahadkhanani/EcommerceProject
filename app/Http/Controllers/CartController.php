<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Http\Request;
use PhpParser\Node\NullableType;

class CartController extends Controller
{
    //
    public function AddToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart');
        if(isset($cart[$id]))
        {
            $cart[$id]['quantity']++;
        }
        else
        {
            $cart[$id] = [
                "name" => $product->name,
                "price"=> $product->price,
                "description" => $product->description,
                "image" => $product->image,
                "quantity" => 1
            ];

        }
        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function CartStatus()
    {
        $cart = session()->get('cart');
        // dump($cart);

    }
    public function RemoveFromCart($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
    // public function CartPlaceOrder(Request $request)
    // {
    //     $order = new Order;
    //     $order->firstname = $request->fname;
    //     $order->lastname = $request->lname;
    //     $order->address = $request->address;
    //     $order->contact = $request->contact;
    //     $order->email = $request->email;
    //     $order->notes = $request->notes;

    //     $cart = session()->get('cart');
    //     $total = 0;
    //     foreach($cart as $id=>$details)
    //     {
    //         $total += $details['quantity']; $details['price'];
    //     }
    //     $order->total = $total;
    //     $order->save();

    //     session()->forget('cart');
    //     return redirect()->back();

    // }
}
