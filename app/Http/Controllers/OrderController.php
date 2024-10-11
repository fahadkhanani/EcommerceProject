<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Http\Request;
use PhpParser\Node\NullableType;

class OrderController extends Controller
{
    //
    public function CartPlaceOrder(Request $request)
    {
        $order = new Order;
        $order->firstname = $request->fname;
        $order->lastname = $request->lname;
        $order->address = $request->address;
        $order->contact = $request->contact;
        $order->email = $request->email;
        $order->notes = $request->notes;

        $cart = session()->post('cart');
        session()->put('cart', $cart);
        $total = 0;
        foreach($cart as $id=>$details)
        {
            $total += $details['quantity']; $details['price'];
        }
        $order->total = $total;
        $order->save();

        session()->forget('cart');
        return redirect()->back();

    }
}
