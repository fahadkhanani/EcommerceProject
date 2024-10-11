<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function IndexPage()
    {   $products = session()->get('cart');
        return view('client.index', ['products'=> $products]);
        //return view('client.index');
    }
    public function CartPage()
    {   $products = session()->get('cart');
        //Updated view
        return view('client.cart', ['products'=> $products]);

        //return view('client.cart');
    }
    public function CheckoutPage()
    {
        return view('client.checkout');
    }
    public function ShopPage()
    {
        $products = Product::all();
        //return view('client.shop');

        //Updated view to allow access of products in shop.blade.php file
        return view('client.shop',['products'=> $products]);

    }
    public function ContactPage()
    {
        return view('client.contact');
    }
    public function MasterPage()
    {
        return view('client.master');
    }
}
