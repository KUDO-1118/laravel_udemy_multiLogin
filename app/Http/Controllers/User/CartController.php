<?php

namespace App\Http\Controllers\User;
require_once base_path('vendor/autoload.php');

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Composer;

class CartController extends Controller
{

    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;//多対多のりレーション
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart', compact('products', 'totalPrice'));
    }


    public function add(Request $request)
    {
        $itemInCart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();//カートに商品があるか確認

        if($itemInCart){
            $itemInCart->quantity += $request->quantity;//あれば数量を追加
            $itemInCart->save();
        } else {
            Cart::create([//なければ新規作成
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('user.cart.index');
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)->where('user_id', Auth::id())->delete();

        return redirect()->route('user.cart.index');
    }

    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $lineItems = [];
        foreach($products as $product){
            $quantity = '';
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');

            if($product->pivot->quantity > $quantity){ //在庫確認する
                return redirect()->route('user.cart.index');
            } else {
                $lineItem = [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $product->name,
                            'description' => $product->information,
                        ],
                        'unit_amount' => $product->price,
                    ],
                    'quantity' => $product->pivot->quantity
                ];
                array_push($lineItems, $lineItem);
            }
        }


        foreach($products as $product)
        {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1
            ]);
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel')
        ]);
        // dd($session);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', compact('session', 'publicKey'));
    }

    public function success()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.items.index');
    }

    public function cancel()
    {
        $user = User::findOrFail(Auth::id());
        foreach($user->products as $product)
        {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['add'],
                'quantity' => $product->pivot->quantity
            ]);
        }
    }

}
