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
            Рассылка почты
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Рассылка почты</li>
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
                                <h3 class="box-title">Мастер рассылки</h3>
                            </div>
                            <div class="box-body">

                                {!! Form::open(array('action' => 'MessageController@store', 'method'=> 'POST', 'class'=>'form-horizontal')) !!}
                                <div class="form-group @if ($errors->has('subj')) has-error @endif">
                                    {!! Form::label('subj', 'Тема письма', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('subj',Null, array('class'=>'form-control', 'placeholder'=>'Тема письма')); !!}
                                        @if ($errors->has('subj')) <p class="help-block">{{ $errors->first('subj') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('text')) has-error @endif">
                                    {!! Form::label('text', 'Тема письма', array('class'=>'col-sm-3 control-label')) !!}
                                    <div class="col-sm-9">
                                        {!! Form::textarea('text',Null, array('class'=>'form-control', 'placeholder'=>'Сообщение')); !!}
                                        @if ($errors->has('text')) <p class="help-block">{{ $errors->first('text') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8">
                                        {!! HTML::decode(Form::button('Создать рассылку', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
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