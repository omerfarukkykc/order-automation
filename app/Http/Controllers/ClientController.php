<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller
{   
    #region GetView orderPreparing 
    public function orderPreparing($id){
        
        return view("client.orderpreparing")->with(['order_id'=>$id]);

    }
    #endregion
   
    #region Post return data chechkOrder
    public function checkOrder(Request $request){
        $order = Order::find($request->order_id);
        return $order->completed;
    }
    #endregion
}
