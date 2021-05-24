
@extends('layouts.cashier')
@section('title')Order @endsection
@section('content')

<div  class="app-content content container-fluid">
    <div class="content-wrapper ">
        <div class="row">
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-body collapse in">
                        <div class="card-header">
                            <h2 class="card-title">Ürünler</h2>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            
                        </div>
                        
                        <div class="card-block" style="height: 800px; overflow-x: hidden;  overflow-y: scroll; ">
                            @foreach ( $categorys as $category_name => $category )
                            <div class="col-md-12 product-header"><h4>{{$category_name}}</h4></div>
                                @foreach ($category as $product)
                                <div class="col-md-4 mb-1">
                                    <div  class="product text-xs-center">
                                       <button  class="btn btn-primary btn-block" style=" font-size:35px; width: 100%; height:200px;" 
                                                onclick="addProductToList({{$product->id}},'{{$product->name}}',{{$product->price}})" 
                                                value="{{$product->id}}">
                                                {{$product->name}}
                                                <div style="color: black">
                                                    {{$product->price}}&#8378
                                                </div>
                                       </button>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>

            <div  class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Fiş Ayrıntıları</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#inlineForm">
                                            Bekleyen siparişler
                                        </button>
                                        <div class="modal fade text-xs-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div style="max-width: 50%!important;" class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <label onclick="getsiparis()" class="modal-title text-text-bold-600" id="myModalLabel33">Bekleyen siparişler</label>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <div class="card" >
                                                            <div class="card-body collapse in">
                                                                <div id="waitingTable" class="card-block" style="height: 850px; overflow-x: hidden;  overflow-y: scroll; ">
                                        
                                                                    
                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </li>   
                                <li>
                                    <button class="btn btn-success btn-block" onclick="createorder()">
                                        <i style="color: #ececec;" class="icon-clipboard4">Sipariş oluştur</i>
                                    </button>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block" style="height: 800px; overflow-x: hidden;  overflow-y: scroll; ">
                            <div class="text-center" style="font-size:25px; float: right">
                                <h4>Toplam tutar</h4>
                                <strong  id="total"> 0 tl</strong>
                            </div>

                            <h4>Siparşiler</h4>
                            <div id="list">
                               
                            </div>
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
    $(document).ready(function(){
        getWaitingOrders()
    })
    let total = 0
    let products = []
    let listIndex = 1
    function addProductToList(id,name,price){
        total+=price
        products.push(id)
        $( "#list" ).prepend(`
        <div id="list`+ listIndex +`" class="alert alert-success mb-2 col-md-6 offset-md-3" role="alert">
            <strong>1x</strong> 
            Ürün: <strong> `+ name +`</strong> 
            Fiyat: <strong>`+ price +`</strong>
            <a onclick="deleteProductFromList('list`+ listIndex +`',`+ id +`,`+price+`)">
                <div class="left">
                    <div class="item">
                        <i style="font-size:22px;" class="icon-square-cross"></i>
                    </div>
                </div>
            </a>
        </div>
        `);
        $('#total').html(total.toFixed(2))
        listIndex++
        console.log(products)
    }
    function deleteProductFromList(viewid,productid,price){
        $('#'+viewid).remove()
        let index = products.indexOf(productid);
        if (index > -1) {
            products.splice(index, 1);
        }
        total-=price
        $('#total').html(total.toFixed(2))
    }
    function createorder(){
        if(products.length == 0){
            return null
        }
        $.ajax({
                url: '/cashier/order/createorder',
                type: 'POST',
                data: { 
                    
                    total_price: total,
                    products: products,
                    _token:"{{csrf_token()}}"
                    },
                    success: function(data) {
                        $( "#list" ).prepend(`
                            <div style="text-align: center">
                                <img src="`+data.pnglink+`>">
                                <a href="`+data.link+`" target="_blank">Sipariş Takip sayfasına gitmek için tıklayın</a>
                                <p style="color:red; text-align:justify;">
                                    Önemli: Bu sayfa bölüm projeyi açıklamak için yazılmışıtr. Eğer addblock kullanıyorsanız 
                                    QR kod reklam olarak algılandığı için gözükmeyecektir. Addblock kapatıp yenilemeyi deneyin
                                </p>
                                <p style="text-align:justify;">
                                    Bu bölümdeki  QR kod siparişin takip linkine gidecek şekilde oluşturulmaktadır. Bu kod full sürümde sipariş fişine
                                    yazdırılacaktır. Burada amaç müşterinin sipariş fişini alarak istediği masaya oturması ardından sipariş fişindeki
                                    QR kodunu taratıp siparişinin hazır oldup olmadığını telefonundan takip etmesidir.
                                    Bildirim izni veren kullanıcılara tarayıcı açık olmadan bildirim yollanması hedeflenmektedir.
                                </p>
                                <p style="text-align:justify;">
                                    Siparişler hazırlandığı zaman bekleyen siparişler bölümünden hazırlanan siparişi "siparişi 
                                    tamamla" butonuna basılarak bitirilir. Bu sayede alışveriş fişindeki QR kodunu okutan kullanıcının
                                    mobil cihazına bildirim gider ve alışveriş tamamlanmış olur. 
                                </p>
                                <p style="text-align:justify;">
                                    Bekleyen siparişler ana menüden de görüntülenebilir
                                </p>
                            </div>
                        `)
                        getWaitingOrders()
                    }
            });
    $( "#list" ).html("")
    total = 0
    products = []
    listIndex = 1
    $('#total').html(total.toFixed(2))
    }
    function getWaitingOrders(){
        $('#waitingTable').html("")
        $.ajax({
            url: "/cashier/order/getwaitingorders",
            type: "POST",
            dataType: 'json',
            data: {
               _token:"{{csrf_token()}}"
            },
            success: function(res) {
                res.orders.forEach(element => {
                   $('#waitingTable').prepend(`
                   <div id="order`+element.id+`">
                        <h6>Bekleyen sipariş</h6>
                        <div id="alert`+element.id+`" class="alert alert-danger mb-2" style="line-height:30px;" role="alert">
                            <strong class="mx-1">Sipariş id: `+element.id+`</strong> 
                            <strong class="mx-1">Fiyat: `+element.total_price+`</strong>
                            <div class="left">
                                <div class="item">
                                    <a href="`+res.path+``+element.id+`" target="_blank">
                                        <button class="btn btn-warning">
                                            Takip sayfasına git
                                        </button>
                                    </a>
                                </div> 
                                <div class="item">
                                    <button class="btn btn-success " id="button`+element.id+`" onclick="complateOrder(`+element.id+`)">
                                        Siparişi tamamla
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                   `)
                });
               
            }
         });
    }
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


