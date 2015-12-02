@include("admin.layout.header")
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
            Создание категории
            </h1>
            <ol class="breadcrumb">
                  <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Настройка оплат</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                        </div> <!-- end .flash-message -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Конфигурация</h3>
                            </div>
                            <div class="box-body">

                                {!! Form::open(array('action' => 'MoneyController@update', 'method'=> 'PATCH', 'class'=>'form-horizontal')) !!}
                                <em>API Приват24</em>
                                <div class="form-group @if ($errors->has('privatKey')) has-error @endif">
                                    {!! Form::label('privatKey', 'Ключ', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('privatKey', Setting::get('money.privatKey'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('privatKey')) <p class="help-block">{{ $errors->first('privatKey') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('privatId')) has-error @endif">
                                    {!! Form::label('privatId', 'ID', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('privatId', Setting::get('money.privatId'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('privatId')) <p class="help-block">{{ $errors->first('privatId') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>API LiqPay</em>
                                <div class="form-group @if ($errors->has('liqpayKey')) has-error @endif">
                                    {!! Form::label('liqpayKey', 'Ключ', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('liqpayKey', Setting::get('money.liqpayKey'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('liqpayKey')) <p class="help-block">{{ $errors->first('liqpayKey') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('liqpayId')) has-error @endif">
                                    {!! Form::label('liqpayId', 'ID', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('liqpayId', Setting::get('money.liqpayId'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('liqpayId')) <p class="help-block">{{ $errors->first('liqpayId') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Карта ПриватБанк</em>
                                <div class="form-group @if ($errors->has('card')) has-error @endif">
                                    {!! Form::label('card', 'Номер', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('card', Setting::get('money.card'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('card')) <p class="help-block">{{ $errors->first('card') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('cardOwner')) has-error @endif">
                                    {!! Form::label('cardOwner', 'Владелец', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('cardOwner', Setting::get('money.cardOwner'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('cardOwner')) <p class="help-block">{{ $errors->first('cardOwner') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Быстрая отправка</em>
                                <div class="form-group @if ($errors->has('fast')) has-error @endif">
                                    {!! Form::label('fast', 'Стоимость', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-3">
                                        {!! Form::text('fast', Setting::get('product.fast'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('fast')) <p class="help-block">{{ $errors->first('fast') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Курьерская доставка</em>
                                <div class="form-group @if ($errors->has('np')) has-error @endif">
                                    {!! Form::label('np', 'Стоимость', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-3">
                                        {!! Form::text('np', Setting::get('product.np'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('np')) <p class="help-block">{{ $errors->first('np') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Подарочная упаковка</em>
                                <div class="form-group @if ($errors->has('gift')) has-error @endif">
                                    {!! Form::label('gift', 'Стоимость', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-3">
                                        {!! Form::text('gift', Setting::get('product.gift'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('gift')) <p class="help-block">{{ $errors->first('gift') }}</p> @endif
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
                    <div class="col-md-3">

                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        @include("admin.layout.footer")
        <!-- page script -->
    </body>
</html>