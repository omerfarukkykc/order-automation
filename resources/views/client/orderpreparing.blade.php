@extends('layouts.client')
@section('title')
Sipariş Hazırlanıyor
@endsection
@section('content')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
        <div class="col-md-6 offset-md-3 col-xs-12 p-0">
            <div  class="card border-grey border-lighten-3 px-1 py-1 box-shadow-3">
                <div id="gif" class="card-block">
                    <span class="card-title text-xs-center">
                        <img src="https://media.giphy.com/media/l4MJnT4YXg3xt81tKn/giphy.gif" class="img-fluid mx-auto d-block pt-2" width="400" alt="logo">
                        
                    </span>
                </div>
                <div id="text" class="card-block text-xs-center">
                    <h3>{{$order_id}} Takip numaralı</h3>
                    <h3> Siparişiniz hazırlanıyor</h3>
                    <p>Siparişiniz hazır olduğunda bu sayfadan görebilirsiniz 
                        <br>Bildirimlere izin veririrseniz sayfa kapalı dahi olsa size bildirim gönderebiliriz.</p>
                        <div  class="mt-2"><i class="icon-gear-a spinner font-large-2"></i></div>

                </div>
                <hr>
                <p class="socialIcon card-text text-xs-center pt-2 pb-2">
                    <a href="https://www.linkedin.com/in/omerfarukkayikci/" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="icon-linkedin3 font-medium-4"></span></a>
                    <a href="https://github.com/omerfarukkykc" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span class="icon-github font-medium-4"></span></a>
                </p>
            </div>
        </div>
        </section>
      </div>
    </div>
  </div>
  
  @endsection

@section('javascript')
<script>
    $(document).ready(function() {
    //açılışta çalışması için
    gonder();
    //her 2 saniyede bir yenile
    var int=self.setInterval("gonder()",1000);
    });
    
    function gonder(){
        $.ajax({
            type:'POST',
            url:'/checkorder',
            data:{
                order_id :{{$order_id}},
                _token:"{{csrf_token()}}"
            },
            success: function (msg) {
               if(msg==1){
                   $('#gif').html(`
                        <span class="card-title text-xs-center">
                            <img src="https://media.giphy.com/media/3OpMUqqlqMTFYmOmAZ/giphy.gif" class="img-fluid mx-auto d-block pt-2" width="400" alt="logo">
                        </span>
                   `)
                   $('#text').html(`
                        <h3>Siparişiniz hazırlandı</h3>
                        <p>Siparişinizi almak için gelebilirsiniz
                            <br>Bizi tercih ettiğiniz için teşekkür ederiz </p>
                       
                    `)
                   
               }
            }
        });
    }
</script>
@endsection