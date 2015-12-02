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
            Основные настройки
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Основные настройки</li>
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

                                {!! Form::open(array('action' => 'ConfigController@update', 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                                <div class="form-group @if ($errors->has('logo')) has-error @endif">
                                    {!! Form::label('logo', 'Логотип', array('class'=>'col-sm-3 control-label')) !!}
                                    @if (Setting::get('config.logo'))
                                    <div class="col-sm-5">
                                        <img style=" max-height: 50px; " src="{!! asset('files/img/'.Setting::get('config.logo')); !!}" alt="4" class="img-responsive">
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Form::file('logo', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('logo')) <p class="help-block">{{ $errors->first('logo') }}</p> @endif
                                    </div>
                                    @else
                                    <div class="col-sm-9">
                                        {!! Form::file('logo', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('logo')) <p class="help-block">{{ $errors->first('logo') }}</p> @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group @if ($errors->has('sitecolor')) has-error @endif">
                                    {!! Form::label('sitecolor', 'Цвет сайта', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('sitecolor', Setting::get('config.sitecolor'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('sitecolor')) <p class="help-block">{{ $errors->first('sitecolor') }}</p> @endif
                                    </div>
                                </div>



                                <div class="form-group @if ($errors->has('sitename')) has-error @endif">
                                    {!! Form::label('sitename', 'Название сайта', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('sitename', Setting::get('config.sitename'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('sitename')) <p class="help-block">{{ $errors->first('sitename') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                    {!! Form::label('email', 'E-mail', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('email', Setting::get('config.email'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>SEO главной страницы</em>
                                <div class="form-group @if ($errors->has('maintitle')) has-error @endif">
                                    {!! Form::label('maintitle', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('maintitle', Setting::get('config.maintitle'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('maintitle')) <p class="help-block">{{ $errors->first('maintitle') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('mainwords')) has-error @endif">
                                    {!! Form::label('mainwords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('mainwords', Setting::get('config.mainwords'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('mainwords')) <p class="help-block">{{ $errors->first('mainwords') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('maindesc')) has-error @endif">
                                    {!! Form::label('maindesc', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('maindesc', Setting::get('config.maindesc'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                        @if ($errors->has('maindesc')) <p class="help-block">{{ $errors->first('maindesc') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>SEO галереи</em>
                                <div class="form-group @if ($errors->has('galtitle')) has-error @endif">
                                    {!! Form::label('galtitle', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('galtitle', Setting::get('config.galtitle'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('galtitle')) <p class="help-block">{{ $errors->first('galtitle') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('galwords')) has-error @endif">
                                    {!! Form::label('galwords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('galwords', Setting::get('config.galwords'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('galwords')) <p class="help-block">{{ $errors->first('galwords') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('galdesc')) has-error @endif">
                                    {!! Form::label('galdesc', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('galdesc', Setting::get('config.galdesc'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                        @if ($errors->has('galdesc')) <p class="help-block">{{ $errors->first('galdesc') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>SEO страницы информации</em>
                                <div class="form-group @if ($errors->has('infotitle')) has-error @endif">
                                    {!! Form::label('infotitle', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('infotitle', Setting::get('config.infotitle'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('infotitle')) <p class="help-block">{{ $errors->first('infotitle') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('infowords')) has-error @endif">
                                    {!! Form::label('infowords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('infowords', Setting::get('config.infowords'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('infowords')) <p class="help-block">{{ $errors->first('infowords') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('infodesc')) has-error @endif">
                                    {!! Form::label('infodesc', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('infodesc', Setting::get('config.infodesc'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                        @if ($errors->has('infodesc')) <p class="help-block">{{ $errors->first('infodesc') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Товар на главной</em>
                                <div class="form-group @if ($errors->has('mainprod')) has-error @endif">
                                    {!! Form::label('mainprod', 'Изображение', array('class'=>'col-sm-3 control-label')) !!}
                                    @if (Setting::get('config.mainprod'))
                                    <div class="col-sm-5">
                                        <img style=" max-height: 50px; " src="{!! asset('files/img/'.Setting::get('config.mainprod')); !!}" alt="4" class="img-responsive">
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Form::file('mainprod', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('mainprod')) <p class="help-block">{{ $errors->first('mainprod') }}</p> @endif
                                    </div>
                                    @else
                                    <div class="col-sm-9">
                                        {!! Form::file('mainprod', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('mainprod')) <p class="help-block">{{ $errors->first('mainprod') }}</p> @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('mainprodtitle')) has-error @endif">
                                    {!! Form::label('mainprodtitle', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('mainprodtitle', Setting::get('config.mainprodtitle'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('mainprodtitle')) <p class="help-block">{{ $errors->first('mainprodtitle') }}</p> @endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('mainproddesc')) has-error @endif">
                                    {!! Form::label('mainproddesc', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('mainproddesc', Setting::get('config.mainproddesc'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                        @if ($errors->has('mainproddesc')) <p class="help-block">{{ $errors->first('mainproddesc') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('mainprodlink')) has-error @endif">
                                    {!! Form::label('mainprodlink', 'Ссылка', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('mainprodlink', Setting::get('config.mainprodlink'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('mainprodlink')) <p class="help-block">{{ $errors->first('mainprodlink') }}</p> @endif
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