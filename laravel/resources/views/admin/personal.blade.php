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
            Персональные настройки
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Персональные настройки</li>
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
                                <h3 class="box-title">Смена e-mail</h3>
                            </div>
                            <div class="box-body">

{!! Form::model($user, ['method'=>'PATCH', 'action' => 'DashboardController@updatePersonalMail', 'class'=>'form-horizontal']) !!}
                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                    {!! Form::label('email', 'E-mail', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('email', Null, array('class'=>'form-control', 'placeholder'=>'E-mail')); !!}
                                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
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




                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Смена пароля</h3>
                            </div>
                            <div class="box-body">

                                {!! Form::model($user, ['method'=>'PATCH', 'action' => 'DashboardController@updatePersonal', 'class'=>'form-horizontal']) !!}
                                <div class="form-group @if ($errors->has('old_password')) has-error @endif">
                                    {!! Form::label('old_password', 'Старый пароль', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::password('old_password', array('class'=>'form-control', 'placeholder'=>'Password')); !!}
                                        @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('password')) has-error @endif">
                                    {!! Form::label('password', 'Новый пароль', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')); !!}
                                        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                                    {!! Form::label('password_confirmation', 'Повторите новый пароль', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Password confirmation')); !!}
                                        @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
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