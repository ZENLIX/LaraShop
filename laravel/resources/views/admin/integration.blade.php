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
            Интеграция
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>                <li class="active">Настройка интеграции</li>
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

                                {!! Form::open(array('action' => 'IntegrationController@update', 'method'=> 'PATCH', 'class'=>'form-horizontal')) !!}
                                <em>Новая Почта</em>
                                <div class="form-group @if ($errors->has('np')) has-error @endif">
                                    {!! Form::label('np', 'Ключ', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('np', Setting::get('integration.np'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('np')) <p class="help-block">{{ $errors->first('np') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>HabraHabr</em>
                                <div class="form-group @if ($errors->has('habr')) has-error @endif">
                                    {!! Form::label('habr', 'Ссылка', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('habr', Setting::get('integration.habr'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('habr')) <p class="help-block">{{ $errors->first('habr') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Instagram</em>
                                <div class="form-group @if ($errors->has('insta')) has-error @endif">
                                    {!! Form::label('insta', 'Ссылка', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('insta', Setting::get('integration.insta'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('insta')) <p class="help-block">{{ $errors->first('insta') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>YouTube</em>
                                <div class="form-group @if ($errors->has('youtube')) has-error @endif">
                                    {!! Form::label('youtube', 'Ссылка', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('youtube', Setting::get('integration.youtube'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('youtube')) <p class="help-block">{{ $errors->first('youtube') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Twitter</em>
                                <div class="form-group @if ($errors->has('twitter')) has-error @endif">
                                    {!! Form::label('twitter', 'Ссылка', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('twitter', Setting::get('integration.twitter'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('twitter')) <p class="help-block">{{ $errors->first('twitter') }}</p> @endif
                                    </div>
                                </div>
                                <hr>
                                <em>Контакты</em>
                                <div class="form-group @if ($errors->has('tel')) has-error @endif">
                                    {!! Form::label('tel', 'Тел', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('tel', Setting::get('integration.tel'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('tel')) <p class="help-block">{{ $errors->first('tel') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('skype')) has-error @endif">
                                    {!! Form::label('skype', 'Skype', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('skype', Setting::get('integration.skype'), array('class'=>'form-control')) !!}
                                        @if ($errors->has('skype')) <p class="help-block">{{ $errors->first('skype') }}</p> @endif
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