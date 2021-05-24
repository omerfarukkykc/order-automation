@extends('layouts.cashier')
@section('title')Profil @endsection
@section('content')
<div  class="app-content content container-fluid">
    <div class="content-wrapper ">
        <div class="row ">
            <div class="col-md-6 offset-md-3 " style="margin-top: 120px">
                <div class="card" style="height: 600px;">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">Kullanıcı Profili</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                    </div>
                    <div class="card-body collapse in ">
                        <div class="card-block">
                            <form id="savedata" class="form">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-eye6"></i> Kullanıcı hakkında</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">Adı</label>
                                                <input type="text" value="{{Auth::user()->name}}" class="form-control border-primary" placeholder="Adı" id="firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput2">Soyadı</label>
                                                <input type="text" value="{{Auth::user()->lastname}}"  class="form-control border-primary" placeholder="Soyadı" id="lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userinput5">Mail Adresi</label>
                                        <input class="form-control border-primary" value="{{Auth::user()->email}}" type="email" placeholder="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="userinput3">Telefon numarası</label>
                                        <input type="tel" id="phone" value="{{Auth::user()->phone}}" class="form-control border-primary" placeholder="Telefon numarası" id="phone">
                                    </div>

                                </div>
                                <div class="form-actions center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="icon-check2"></i> Kaydet
                                    </button>
                                </div>
                            </form>
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
    $('#savedata').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/cashier/profile/saveuser',
            type: 'POST',
            data: { 
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                _token:"{{csrf_token()}}"
                },
                success: function(data) {
                    alert("Güncelleme Başarılı")
                }
        });
        return null;
    })
</script>
@endsection