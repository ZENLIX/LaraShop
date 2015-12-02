@include("layout.header")
<!-- iCheck -->
{!! Html::style('plugins/iCheck/square/blue.css'); !!}
@include("layout.navbar")
<div class="containter" style="padding-top:100px; min-height:100px;background-image: url(dist/img/geometic-bg-white.jpg);">
    <div class="container">
        <div class="col-md-4">
            <div class="jumbotron" style="padding: 0px;">
                <div class="container" style=" color: rgba(0, 0, 0, 0.68); ">
                    <h2>Оформление заказа</h2>
                    <p>Заполните форму</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="    background-color: white;">
    <div class="containter" style="padding-top:50px; ">
        <div class="container">
            <div class="row" style="padding-bottom:20px;">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                    </div> <!-- end .flash-message -->
                    <div class="panel ">
                        <div class="panel-body">
                            <div class="col-6 col-sm-6 col-lg-6">
                                {!! Form::open(array('action' => 'PurchaseController@store', 'method'=> 'POST', 'class'=>'form-horizontal', 'files'=>true)) !!}
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    {!! Form::label('name', 'Имя и Фамилия', array('class'=>'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Получатель товара')) !!}
                                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('tel')) has-error @endif">
                                    {!! Form::label('tel', 'Номер мобильного', array('class'=>'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('tel', null, array('class'=>'form-control', 'placeholder'=> 'Напр. +38095111....')) !!}
                                        @if ($errors->has('tel')) <p class="help-block">{{ $errors->first('tel') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('mail')) has-error @endif">
                                    {!! Form::label('mail', 'E-mail', array('class'=>'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('mail', null, array('class'=>'form-control', 'placeholder'=> 'Ваш e-mail')) !!}
                                        @if ($errors->has('mail')) <p class="help-block">{{ $errors->first('mail') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-4 control-label">Тип доставки</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12">
                                            {!! Form::radio('delivery_type', 'np', $dNP, array('class'=>'minimal')); !!}
                                            Склад Новая Почта
                                            <p class="help-block"><small>Товар будет отправлен на указанный склад Новой Почты.</small></p>
                                        </label >
                                        <label class="col-md-12">
                                            {!! Form::radio('delivery_type', 'adr', $dADR, array('class'=>'minimal')); !!}
                                            Адрес
                                            <p class="help-block"><small>Товар будет отправлен на указанный адрес, службой доставки Новой Почты. (+{{Setting::get('product.np')}} грн)</small></p>
                                        </label>
                                    </div>
                                </div>
                                <div id="delivery_sklad" class="col-12 col-sm-12 col-lg-12" style="display: block;">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <small style="float:right;" class="text-muted">Склад "Новая Почта"</small>
                                            <br>
                                            <div class="form-group">
                                                <label for="delivery_city" class="col-sm-3 control-label">Нас. пункт</label>
                                                <div class="col-md-9">
                                                    {!! Form::select('delivery_city', $np_city, Null, array('class'=>'form-control select2 np_city', 'style'=>'width: 100%')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="delivery_np" class="col-sm-3 control-label">Отделение</label>
                                                <div class="col-md-9">
                                                    {!! Form::select('delivery_np', [], Null, array('class'=>'form-control select2 np_unit', 'style'=>'width: 100%')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="delivery_adr" class="col-12 col-sm-12 col-lg-12" style="display: block;">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <small style="float:right;" class="text-muted">Адрес доставки</small>
                                            <br>
                                            <div class="form-group">
                                                <label for="delivery_city" class="col-sm-3 control-label">Нас. пункт</label>
                                                <div class="col-md-9">
                                                    {!! Form::select('delivery_city_adr', $np_city, Null, array('class'=>'form-control select2 np_city', 'style'=>'width: 100%')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group @if ($errors->has('delivery_adr')) has-error @endif">
                                                {!! Form::label('delivery_adr', 'Адрес', array('class'=>'col-sm-3 control-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('delivery_adr', null, array('class'=>'form-control', 'placeholder'=> '')) !!}
                                                    @if ($errors->has('delivery_adr')) <p class="help-block">{{ $errors->first('delivery_adr') }}</p> @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-4 control-label">Тип оплаты</label>
                                    <div class="col-md-8">
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'privat24', true, array('class'=>'minimal')); !!}
                                            Privat24
                                            <p class="help-block"><small>Через онлайн-систему для владельцев карт ПриватБанка.</small></p>
                                        </label >
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'privat_terminal', false, array('class'=>'minimal')); !!}
                                            На карту
                                            <p class="help-block"><small>Через пополнение карты, например через терминал самообслуживания.</small></p>
                                        </label>
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'liqpay', false, array('class'=>'minimal')); !!}
                                            LiqPay
                                            <p class="help-block"><small>Через онлайн систему для владельце карт других банков. (+5% комиссия)</small></p>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('files.0')) has-error @endif">
                                    {!! Form::label('files', 'Файлы', array('class'=>'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8">
                                        {!! Form::file('files[]', array('class'=>'form-control', 'multiple'=>true)) !!}
                                        <p class="help-block"><small>Допустимые форматы: JPG, PNG, BMP, PSD, до 10Мб</small></p>

                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('comment')) has-error @endif">
                                    {!! Form::label('comment', 'Дополнительная информация', array('class'=>'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8">
                                        {!! Form::textarea('comment', null, array('class'=>'form-control', 'rows'=>'2', 'placeholder'=> '')) !!}
                                        @if ($errors->has('comment')) <p class="help-block">{{ $errors->first('comment') }}</p> @endif
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="hidden" name="check" value="o">
                                        <input type="hidden" name="action" value="o">
                                        {!! HTML::decode(Form::button('Оформить заказ!', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                    </div>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                            <div class="col-6 col-sm-6 col-lg-6">
                                <div class="panel panel-default">
                                    <div class="text-center">Ваш заказ</div>
                                    <div class="panel-body">
                                        <div id="basket">
                                            @if ($cartEmpty)
                                            @include("emptycart")
                                            @else
                                            @include("cart")
                                            @endif
                                        </div><center>
                                        <div class="col-md-12">


                                            <div class="btn-group btn-group-justified" style="">
                                                <div class="btn-group">
                                                    <button id="make_fast" type="button" class="btn btn-fd btn-xs" data-toggle="popover" data-trigger="hover click" data-placement="bottom" title="" data-content="<small>При условии если оплата была произведена до 16:00 во все дни, кроме воскресенья. В обычном случае - <strong>заказ отправляется раз в неделю</strong>, как правило пятница-суббота.
                                                    </small>" data-original-title="<i class='fa fa-clock-o'></i>  Отправка в день заказа"><i class="fa fa-clock-o"></i>  Отправка в день заказа</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button id="make_gift" type="button" class="btn btn-gp btn-xs" data-toggle="popover" data-trigger="hover click" data-placement="bottom" title="" data-content="<small>Включает в себя ленту-бант или другую подарочную упаковку
                                                    </small>" data-original-title="<i class='fa fa-gift'></i> Подарочная упаковка"><i class="fa fa-gift"></i> Подарочная упаковка</button>
                                                </div>


                                            </div>


                                        </div>
                                        <br>
                                        <img src="http://buben.biz.ua/uploads/files/img/paylogo-WhdytyR0UF.png" class="img-rounded img-responsive">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("layout.footer")
    <!-- iCheck -->
    {!! Html::script('plugins/iCheck/icheck.min.js'); !!}
    <script type="text/javascript">
    $(document).ready(function() {
    var CSRF_TOKEN='{!! csrf_token() !!}';
    var SYS_URL='{!! URL::to('/'); !!}';
    function tspin() {
    $("input#demo").TouchSpin({
    min: 1, // Minimum value.
    max: 10, // Maximum value.
    boostat: 1, // Boost at every nth step.
    postfix: 'шт', // Text after the input.
    step: 1, // Incremental/decremental step on up/down change.
    stepinterval: 1, // Refresh rate of the spinner in milliseconds.
    stepintervaldelay: 500 // Time in milliseconds before the spinner starts to spin.
    });
    }
    function make_fast() {
    var data={ _token : CSRF_TOKEN,
                _method : 'PATCH' };
    $.ajax({
                                        type: 'POST',
                                        url: SYS_URL+'/basket/fast',
                                        data: data,
                                        success : function() {
                                        $.ajax({
                                        type: 'GET',
                                        url: SYS_URL+'/basket',
                                        data: { _token : CSRF_TOKEN},
                                        success : function(html) {
                                            $('#basket').html(html);
                                            tspin();
                                            //$('#backet_form').modal('show');
                                        }
                                        //dataType: 'html',
                                    });
                                            }
                                        });
    }
    function make_gift() {
    var data={ _token : CSRF_TOKEN,
                _method : 'PATCH' };
    $.ajax({
                                        type: 'POST',
                                        url: SYS_URL+'/basket/gift',
                                        data: data,
                                        success : function() {
                                        $.ajax({
                                        type: 'GET',
                                        url: SYS_URL+'/basket',
                                        data: { _token : CSRF_TOKEN},
                                        success : function(html) {
                                            $('#basket').html(html);
                                            tspin();
                                            //$('#backet_form').modal('show');
                                        }
                                        //dataType: 'html',
                                    });
                                            }
                                        });
    }
    $('body').on('click', 'button#make_gift', function(event) {
        event.preventDefault();
    make_gift();
    });
    $('body').on('click', 'button#make_fast', function(event) {
        event.preventDefault();
    make_fast();
    });
    function np_adr(p) {
    var s='';
    if (p == true) {s='true';}
    else {s='false';}
    var data={ _token : CSRF_TOKEN,
                _method : 'PATCH',
            status: s };
    $.ajax({
                                        type: 'POST',
                                        url: SYS_URL+'/basket/delivery',
                                        data: data,
                                        success : function() {
                                        $.ajax({
                                        type: 'GET',
                                        url: SYS_URL+'/basket',
                                        data: { _token : CSRF_TOKEN},
                                        success : function(html) {
                                            $('#basket').html(html);
                                            tspin();
                                            //$('#backet_form').modal('show');
                                        }
                                        //dataType: 'html',
                                    });
                                            }
                                        });
    }
    $('#delivery_adr').hide();
    //$('#delivery_sam').hide();
    //$('#pay_nal').hide();
    $('input[type=radio][name=delivery_type]').on('ifChanged', function(event){
    //$('body').on('change', 'input[type=radio][name=delivery_type]', function(event) {
        event.preventDefault();
        //$('input[type=radio][name=optionsRadios]').change(function() {
        if (this.value == 'np') {
        $('#delivery_adr').hide();
        $('#delivery_sklad').hide().fadeIn(500);
        //np_adr(false);
        } else if (this.value == 'adr') {
        $('#delivery_sklad').hide();
        $('#delivery_adr').hide().fadeIn(500);
        //np_adr(true);
        }
    });
    $('input[type=radio][name=delivery_type]').on('ifChecked', function(event){
    //event.preventDefault();
    if (this.value == 'np') {np_adr(false);}
    else if (this.value == 'adr') {np_adr(true);}
    //alert(this.value);
    });
            $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
        });
    var $eventSelect = $(".np_city");
    $eventSelect.on("select2:select", function (e) {
    //console.log($(this).select2('data')[0].id);
    $.ajax({
        type: 'GET',
        url: SYS_URL+'/getUnit/'+$(this).select2('data')[0].id,
        data: { _token : CSRF_TOKEN},
        success : function(html) {
    $('.np_unit').empty();
    $('.np_unit').select2({data: html});
    //$('.np_unit').change();
        //$('#basket').html(html);
        //tspin();
        //$('#backet_form').modal('show');
        }
        //dataType: 'html',
                                    });
    });
    });
    </script>