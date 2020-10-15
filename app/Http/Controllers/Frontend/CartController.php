<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Cart;
use App\Product;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $contents = Cart::content();
        // dd($contents);
        return view('frontend.cart');
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        $product_image = '';

        if ($product->photo)
            $product_image = $product->photo->getUrl();


        // dd($product_image);


        $flag = TRUE;

        $contents = Cart::content();

        foreach ($contents as $key => $content) {

            if ($content->id == $id) {
                Cart::update($content->rowId, $content->qty + 1);

                $flag = FALSE;
                break;
            }
        }

        if ($flag == TRUE) {

            $cartItem = Cart::add([
                'id' => $id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'weight' => 0,
                'options' => [
                    'image' => $product_image,
                ],
            ]);

            // Cart::associate($cartItem->rowId,'Product');
        }

        $cartTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();

        Session::flash('success', 'Product added to cart!');
        // return Response::json($cartItem);
        return response()->json([
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal
        ], 200);
    }

    public function update($id, $qty)
    {
        $cartItem = Cart::update($id, $qty);

        Session::flash('success', 'Product quantity Updated.');

        $cartTotal = Cart::subtotal(); // without default cart tax
        $cartCount = Cart::content()->count();

        return response()->json([
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'incrementQty' => $cartItem->qty,
            'itemTotal' => $cartItem->subtotal // without default cart tax
        ], 200);
    }

    public function increment($rowId, $qty)
    {
        $cartItem = Cart::update($rowId, $qty + 1);

        Session::flash('success', 'Product quantity Updated.');

        $cartTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();

        return response()->json([
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'incrementQty' => $cartItem->qty,
            'itemTotal' => $cartItem->subtotal // without default cart tax
        ], 200);
    }

    public function decrement($rowId, $qty)
    {
        $cartItem = Cart::update($rowId, $qty - 1);

        Session::flash('success', 'Product quantity Updated.');

        $cartTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();
        $contents = Cart::content();

        $cartTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();

        return response()->json([
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'incrementQty' => $cartItem->qty,
            'itemTotal' => $cartItem->subtotal // without default cart tax
        ], 200);
    }

    public function removeCartItem($rowId)
    {
        Cart::remove($rowId);

        Session::flash('success', 'Product removed from cart!');

        $cartTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();
        $contents = Cart::content();

        return response()->json([
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'contents' => $contents
        ], 200);
    }
}
