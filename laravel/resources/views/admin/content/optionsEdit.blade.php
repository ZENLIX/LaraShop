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
            Редактирование опции
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Опции товаров</li>
                <li class="active">Редактирование опции</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация об опции</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::model($option, array('action' => array('ContentController@updateOptions', $option->id), 'method'=> 'POST', 'class'=>'form-horizontal')) !!}
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('price')) has-error @endif">
                                {!! Form::label('price', 'Цена', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('price', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
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