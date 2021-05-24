@extends('layouts.cashier')
@section('title')Dashboard @endsection
@section('content')
<div style=" height: calc(100% - 64px);" class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class=" row">
            <div class="col-md-6" >
                <div class="card" >
                    <div class="card-body collapse in">
                        <div class="card-header">
                            <h4 class="card-title">İşlemler</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                </ul>
                            </div>
                        </div>
                        <div class="card-block" style="height: 850px; overflow-x: hidden;  overflow-y: scroll; ">
                            <div class="col-md-6 mb-1 ">
                                <a href="{{ route('cashier.order') }}">
                                    <button style="width: 100%" class="option btn btn-info btn-block">
                                        Satış
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 mb-1 ">
                                <a href="{{ route('cashier.history') }}">
                                    <button style="width: 100%" class="option btn btn-info btn-block">
                                        Geçmiş
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 ">
                                <a href="{{ route('cashier.profile') }}">
                                    <button style="width: 100%" class="option btn btn-info btn-block">
                                        Profil
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 ">
                                <a href="{{ route('cashier.lock') }}">
                                    <button style="width: 100%" class="option btn btn-info btn-block" disabled>
                                        Hızlı kilitle
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" >
                <div class="card" >
                    <div class="card-header">
                        <h4 class="card-title">Bekleyen Siparişler</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        
                    </div>
                    
                    <div class="card-body collapse in">
                        <div class="card-block" style="height: 850px; overflow-x: hidden;  overflow-y: scroll; ">

                            @foreach ($orders as $order)
                                @if ($order->completed==0)
                                    <div id="order{{$order->id}}">
                                        <h6>Bekleyen sipariş</h6>
                                        <div id="alert{{$order->id}}" class="alert alert-danger mb-2" style="line-height:30px;" role="alert">
                                            <strong class="mx-1">Sipariş id: {{$order->id}}</strong> 
                                            <strong class="mx-1">Fiyat: {{$order->total_price}}</strong>
                                            <div class="left"> 
                                                <div class="item">
                                                   <a href="{{$path . $order->id}}" target="_blank">
                                                        <button class="btn btn-warning ">
                                                           Takip sayfasına git
                                                        </button>
                                                   </a>
                                                </div>
                                                <div class="item">
                                                    <button class="btn btn-success " id="button{{$order->id}}" onclick="complateOrder({{$order->id}})">
                                                        Siparişi tamamla
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
    function complateOrder(id){
        $('#alert'+id).removeClass( "alert-danger" ).addClass( "alert-success" );
        $('#button'+id).attr("disabled", true).removeClass( "btn-success" ).addClass( "btn-danger" );
        $('#order'+id).remove();
        $.ajax({
            url: '/cashier/order/complateorder',
            type: 'POST',
            data: { 
                order_id: id,
                _token:"{{csrf_token()}}"
                },
        });
    }
</script>
@endsection