@include("admin.layout.header")
<!-- iCheck -->
{!! Html::style('plugins/iCheck/square/blue.css'); !!}
<title>Панель приборов</title>
</head>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
    @include("admin.layout.topmenu")
    @include("admin.layout.navbar")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Редактирование заказа
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Редактирование заказа</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-7">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                        </div> <!-- end .flash-message -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Заказ</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::open(array('action' => ['OrdersController@update', $order->id], 'method'=> 'PATCH', 'class'=>'form-horizontal')) !!}
                                <div class="form-group @if ($errors->has('code')) has-error @endif">
                                    {!! Form::label('code', 'Код', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('code', $order->code, array('class'=>'form-control')) !!}
                                        @if ($errors->has('code')) <p class="help-block">{{ $errors->first('code') }}</p> @endif
                                    </div>
                                </div>
                                <em>Клиент</em>
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    {!! Form::label('name', 'Имя', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('name', $order->client->name, array('class'=>'form-control')) !!}
                                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('tel')) has-error @endif">
                                    {!! Form::label('tel', 'Тел', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('tel', $order->client->tel, array('class'=>'form-control')) !!}
                                        @if ($errors->has('tel')) <p class="help-block">{{ $errors->first('tel') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                    {!! Form::label('email', 'E-mail', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('email', $order->client->email, array('class'=>'form-control')) !!}
                                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Доставка</em>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-3 control-label">Тип доставки</label>
                                    <div class="col-md-9">
                                        <label class="col-md-12">
                                            {!! Form::radio('delivery_type', 'np', $dNP, array('class'=>'minimal')); !!}
                                            Склад Новая Почта
                                            <p class="help-block"><small>Товар будет отправлен на указанный склад Новой Почты.</small></p>
                                        </label >
                                        <label class="col-md-12">
                                            {!! Form::radio('delivery_type', 'adr', $dADR, array('class'=>'minimal')); !!}
                                            Адрес
                                            <p class="help-block"><small>Товар будет отправлен на указанный адрес, службой доставки Новой Почты. (+50 грн)</small></p>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('delivery_city')) has-error @endif">
                                    {!! Form::label('delivery_city', 'Город', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('delivery_city', $order->delivery_city, array('class'=>'form-control')) !!}
                                        @if ($errors->has('delivery_city')) <p class="help-block">{{ $errors->first('delivery_city') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('delivery_np')) has-error @endif">
                                    {!! Form::label('delivery_np', 'Склад Новой Почты', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('delivery_np', $order->delivery_np, array('class'=>'form-control')) !!}
                                        @if ($errors->has('delivery_np')) <p class="help-block">{{ $errors->first('delivery_np') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('delivery_adr')) has-error @endif">
                                    {!! Form::label('delivery_adr', 'Адрес', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('delivery_adr', $order->delivery_adr, array('class'=>'form-control')) !!}
                                        @if ($errors->has('delivery_adr')) <p class="help-block">{{ $errors->first('delivery_adr') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Оплата</em>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-3 control-label">Тип оплаты</label>
                                    <div class="col-md-9">
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'privat24', $privat24, array('class'=>'minimal')); !!}
                                            Privat24
                                            <p class="help-block"><small>Через онлайн-систему для владельцев карт ПриватБанка.</small></p>
                                        </label >
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'privat_terminal', $privat_terminal, array('class'=>'minimal')); !!}
                                            На карту
                                            <p class="help-block"><small>Через пополнение карты, например через терминал самообслуживания.</small></p>
                                        </label>
                                        <label class="col-md-12">
                                            {!! Form::radio('pay_type', 'liqpay', $liqpay, array('class'=>'minimal')); !!}
                                            LiqPay
                                            <p class="help-block"><small>Через онлайн систему для владельце карт других банков. (+10% комиссия)</small></p>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group @if ($errors->has('ttn')) has-error @endif">
                                    {!! Form::label('ttn', 'ТТН', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('ttn', $order->ttn, array('class'=>'form-control')) !!}
                                        @if ($errors->has('ttn')) <p class="help-block">{{ $errors->first('ttn') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('comment')) has-error @endif">
                                    {!! Form::label('comment', 'Дополнительная информация', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('comment', $order->comment, array('class'=>'form-control', 'rows'=>'2', 'placeholder'=> '')) !!}
                                        @if ($errors->has('comment')) <p class="help-block">{{ $errors->first('comment') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8">
                                        {!! HTML::decode(Form::button('Сохранить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                    </div>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Список заказа</h3>
                            </div>
                            <div class="box-body" id="cart">
                                @include("admin.cartOrder")

                            </div>
                            <div class="box-footer">
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
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Добавить товар</h3>
                            </div>
                            <div class="box-body" id="cart">
                                {!! Form::open(array('action' => ['OrdersController@storeItem', $order->id], 'method'=> 'POST', 'class'=>'form-horizontal')) !!}
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-2 control-label">Товар</label>
                                    <div class="col-md-10">
                                        {!! Form::select('item', $Prods, Null, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%')) !!}
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('qty')) has-error @endif">
                                    {!! Form::label('qty', 'К-во', array('class'=>'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('qty', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('qty')) <p class="help-block">{{ $errors->first('qty') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        {!! HTML::decode(Form::button('Добавить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                    </div>
                                </div>
                                {!! Form::close(); !!}

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        @include("admin.layout.footer")
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
        tspin();
        function np_adr(p) {
        var s='';
        if (p == true) {s='true';}
        else {s='false';}
        var data={ _token : CSRF_TOKEN,
                    _method : 'PATCH',
                status: s };
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/order/{{$order->id}}/delivery',
                                            data: data,
                                            success : function() {
                                            $.ajax({
                                            type: 'GET',
                                            url: SYS_URL+'/order/{{$order->id}}/cart',
                                            data: { _token : CSRF_TOKEN},
                                            success : function(html) {
                                                $('#cart').html(html);
                                                tspin();
                                                //$('#backet_form').modal('show');
                                            }
                                            //dataType: 'html',
                                        });
                                                }
                                            });
        }
        $('input[type=radio][name=delivery_type]').on('ifChecked', function(event){
        //event.preventDefault();
        if (this.value == 'np') {np_adr(false);}
        else if (this.value == 'adr') {np_adr(true);}
        //alert(this.value);
        });
        function make_fast() {
        var data={ _token : CSRF_TOKEN,
                    _method : 'PATCH' };
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/order/{{$order->id}}/fast',
                                            data: data,
                                            success : function() {
                                            $.ajax({
                                            type: 'GET',
                                            url: SYS_URL+'/order/{{$order->id}}/cart',
                                            data: { _token : CSRF_TOKEN},
                                            success : function(html) {
                                                $('#cart').html(html);
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
                                            url: SYS_URL+'/order/{{$order->id}}/gift',
                                            data: data,
                                            success : function() {
                                            $.ajax({
                                            type: 'GET',
                                            url: SYS_URL+'/order/{{$order->id}}/cart',
                                            data: { _token : CSRF_TOKEN},
                                            success : function(html) {
                                                $('#cart').html(html);
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
        $('body').on("change", "input#demo", function(event) {
                event.preventDefault();
                var data={ _token : CSRF_TOKEN,
                qty: $(this).val(),
                el: $(this).attr('data-id') };
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/order/{{$order->id}}/update',
                                            data: data,
                                            success : function() {
                                                    $.ajax({
                                            type: 'GET',
                                            url: SYS_URL+'/order/{{$order->id}}/cart',
                                            data: { _token : CSRF_TOKEN},
                                            success : function(html) {
                                                $('#cart').html(html);
                                                tspin();
                                                //$('#backet_form').modal('show');
                                            }
                                            //dataType: 'html',
                                        });
                                                }
                                            });
            });
        $('body').on('click', 'button#remove_item', function(event) {
                event.preventDefault();
                var data={ _token : CSRF_TOKEN,
                _method: 'DELETE',
                el: $(this).attr('data-id')
        };
                                        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/order/{{$order->id}}/remove',
                                            data: data,
                                            success : function() {
                                                $.ajax({
                                            type: 'GET',
                                            url: SYS_URL+'/order/{{$order->id}}/cart',
                                            data: { _token : CSRF_TOKEN},
                                            success : function(html) {
                                                $('#cart').html(html);
                                                tspin();
                                                //$('#backet_form').modal('show');
                                            }
                                            //dataType: 'html',
                                        });
                                                }
                                            });
        });
                        $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                    });
                });
        </script>
    </body>
</html>