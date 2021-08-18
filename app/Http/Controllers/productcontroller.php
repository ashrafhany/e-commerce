<?php

namespace App\Http\Controllers;

use App\cart as AppCart;
use Illuminate\Http\Request;
use APP\Models\Product;
use APP\Models\Cart;
use APP\Models\Order;
use App\Order as AppOrder;
use App\product as AppProduct;
use Illuminate\Support\Facades\DB; 
use Illuminate\Contracts\Session\Session;

class productcontroller extends Controller
{
    function index(){
        $data=AppProduct::all();
       return view('product',['products'=>$data]);
    }
    function detail($id){
        $data=AppProduct::find($id);
        return view('detail',['product'=>$data]);
    }
    function search(Request $req)
    {
        $data=AppProduct::where('name','like','%'.$req->input('query').'%')->get();
       return view('search',['products'=>$data]);

    }
    function AddToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            
            $cart=new AppCart();
            $cart->user_id=$req->session()->get('user')['id'];
            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');

        }
        else{
            return redirect('/login');
        }
    }
        static function CartItem()
    {
        $userId=session()->get('user')['id'];
        return AppCart::where('user_id',$userId)->count();
    }
    function CartList()
    {
        $userId=session()->get('user')['id'];
        $products=DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();
        return view('cartlist',['products'=>$products]);
    }
    function RemoveCart($id)
    {
        AppCart::destroy($id);
        return redirect('/cartlist');
    }
    function OrderNow()
    {
        $userId=session()->get('user')['id'];
       $total= $products=DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');
        return view('ordernow',['total'=>$total]);
    }
    function OrderPlace(Request $req)
    {
        $userId=session()->get('user')['id'];
        $allcart=AppCart::where('user_id',$userId)->get();
        foreach($allcart as $cart)
        {
            $order = new AppOrder;
            $order->product_id=$cart['product_id'];
            $order->user_id=$cart['user_id'];
            $order->status="pending";
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            $order->address=$req->address;
            $order->save();
            AppCart::where('user_id',$userId)->delete();
        }
        $req->input();
        return redirect('/');
    }
    function MyOrders()
    {
        $userId=session()->get('user')['id'];
        $orders= $products=DB::table('orders')
         ->join('products','orders.product_id','=','products.id')
         ->where('orders.user_id',$userId)
         ->get();
         return view('myorders',['orders'=>$orders]);
    }
}
