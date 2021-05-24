@extends('layouts.cashier')
@section('title')History @endsection
@section('content')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Satış geçmişi
                        </h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block"  style="height: 800px; overflow-x: hidden;  overflow-y: scroll; ">
                            
                            @foreach ($orders as $order)
                            <div id="order{{$order->id}}">
                                <h6>{{$order->created_at}}</h6>
                                <div class=" alert alert-success mb-2" style="line-height: 30px" role="alert">
                                    <strong style="text-align:center;">
                                        <span class="mx-2">Sipariş id: {{$order->id}} </span>
                                        <span class="mx-2">Kasiyer: {{$order->getUser->name}} </span>
                                        <span class="mx-2">Fiyat : {{$order->total_price}} </span>
                                    </strong> 
                                    <div class="left">
                                        <div class="item">
                                            <button class="btn btn-danger btn-block" onclick="">
                                            <i style="font-size: 20px" class="icon-align-center2">Fiş ver</i>
                                            </button>
                                        </div>
                                        <div class="item">
                                            <button class="btn btn-danger btn-block" onclick="refund({{$order->id}})">
                                            <i style="font-size: 20px"  class="icon-square-cross ">İade</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    function refund(id){
        $('#order'+id).remove()
        $.ajax({
                url: '/cashier/order/refund',
                type: 'POST',
                data: { 
                    order_id: id,
                    _token:"{{csrf_token()}}"
                },
            });

    }

</script>
@endsection
