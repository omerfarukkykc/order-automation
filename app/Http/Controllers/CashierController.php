<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;

use function PHPUnit\Framework\isNull;

class CashierController extends Controller
{
    public function dashboard(){
        $orders = new Order();
        $data = $orders->orderBy('created_at','DESC')->take(40)->get();
        return view("cashier.dashboard")->with(['orders' => $data,'path'=>URL::to('/').'/orderpreparing/']);
    }
    public function history(){
        $orders = new Order();
        $data = $orders->orderBy('created_at','DESC')->take(100)->get();
        return view("cashier.history")->with(['orders' => $data]);
    }
    public function order(){
        
        $categories = ProductCategory::all();
        foreach($categories as $category ){
            $data[$category->category_name]=$category->getProduct;
        }
        return (isset($data))?view("cashier.order")->with(['categorys'=>$data]):
        "Veritabanında ürün bilgisi bulunmamaktadır. 
        Eğer bu hatayı alıyorsanız sırasıyla terminalde şu komutları uygulayın<br>
        1. php artisan migrate:reset<br>
        2. php artisan migrate
        ";
        
    }
    public function profile(){
        return view("cashier.profile");
    }
    public function complateorder(Request $request){
        $order = Order::find($request->order_id);
        $order->completed = 1;
        $order->save();

    }
    public function createorder(Request $request){
        $order = new Order();
        $order->total_price = $request->total_price;
        $order->user_id = Auth::user()->id;
        $order->save();
        // $productsAndQuantities['product_id'] => Quantities
        $productsAndQuantities =  array_count_values($request->products);
        foreach($productsAndQuantities as $product_id => $quantities){
            $receipt = new OrderProducts();
            $receipt->order_id      = $order->id;
            $receipt->product_id    = $product_id;
            $receipt->quantities    = $quantities;
            $receipt->save();
        }
        function qrCode($s, $w = 250, $h = 250){
            $u = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s';
            $url = sprintf($u, $w, $h, $s);
            return $url;
        }
        $qr['pnglink'] = qrCode(URL::to('/').'/orderpreparing/'.$order->id);
        $qr['link'] = URL::to('/').'/orderpreparing/'.$order->id;
        return $qr;
    }   
    public function refundorder(Request $request){
        $order = Order::findOrFail($request->order_id);
        //$orderProduct = OrderProducts::findOrFail($request->order_id);
        //$order->getProductList->delete();
        return $order->delete();
    }
    public function getWaitingOrders(){
        $orders = new Order();
        $data = $orders->orderBy('created_at','DESC')->where("completed",0)->take(40)->get();
        return json_encode(['orders' => $data ,'path'=>URL::to('/').'/orderpreparing/']);
    }
    public function saveuser(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        return $user->save();
    }
}
