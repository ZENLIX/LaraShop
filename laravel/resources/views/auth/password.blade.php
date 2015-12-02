<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  {!! Html::style('bootstrap/css/bootstrap.min.css'); !!}
  <!-- Font Awesome -->
  {!! Html::style('plugins/font-awesome/css/font-awesome.min.css'); !!}
  <!-- Ionicons -->
  {!! Html::style('plugins/ionicons/css/ionicons.min.css'); !!}
  <!-- Theme style -->
  {!! Html::style('dist/css/AdminLTE.min.css'); !!}
  <!-- iCheck -->
  {!! Html::style('plugins/iCheck/square/blue.css'); !!}
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo " style="    padding: 20px; margin: 0px;">
    <a href="{!! URL::to('/') !!}"><img src="{{ asset('/files/img/'.Setting::get('config.logo'))}}" class="img-def" id="logo" alt="Dispute Bills"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"> Enter your email address and your password will be reset and emailed to you.</p>
{!! Form::open(array('url' => 'forgot', 'method'=> 'POST', 'autocomplete'=>'off')) !!}
    

                    <div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                    {!! Form::text('email', '', array('class'=>'form-control', 'autocorrect'=>'off', 'autocapitalize'=>'off', 'autocomplete'=>'off', 'placeholder'=>'Email')) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                   @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>



      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">

            {!! Form::button('Send new password', array('type' => 'submit', 'class'=>'btn btn-primary btn-block btn-flat')); !!}

        </div>
        <!-- /.col -->
      </div>
    {!! Form::close(); !!}
    <a href="{!! URL::to('/login') !!}" class="text-center">I already have a membership</a><br>
   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('bootstrap/js/bootstrap.min.js'); !!}
</body>
</html>
