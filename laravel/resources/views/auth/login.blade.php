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
<div class="login-box header" style="background-color: #FFFFFF">
  <div class="login-logo " style="    padding: 20px; margin: 0px;">
    <a href="{!! URL::to('/') !!}"><img src="{{ asset('/files/img/'.Setting::get('config.logo'))}}" class="img-def" id="logo" alt="Dispute Bills"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="">
    <p class="login-box-msg">Sign in to start your session</p>
{!! Form::open(array('url' => 'login', 'method'=> 'POST', 'autocomplete'=>'off')) !!}
    


                    <div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                    {!! Form::text('email', '', array('class'=>'form-control', 'autocorrect'=>'off', 'autocapitalize'=>'off', 'autocomplete'=>'off', 'placeholder'=>'Email')) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                   @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>



<div class="form-group has-feedback @if ($errors->has('password')) has-error @endif">
                    {!! Form::password('password', array('class'=>'form-control', 'autocorrect'=>'off', 'autocapitalize'=>'off', 'autocomplete'=>'off', 'placeholder'=>'Password')); !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    </div>

      <div class="row">
        <div class="col-xs-8">



          <div class="checkbox icheck">
            <label>
              {!! Form::checkbox('remember'); !!} Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">

            {!! Form::button('Sign In', array('type' => 'submit', 'class'=>'btn btn-primary btn-block btn-flat')); !!}

        </div>
        <!-- /.col -->
      </div>
    {!! Form::close() !!}


    <!-- /.social-auth-links -->

    <a href="{!! URL::to('/forgot') !!}">I forgot my password</a><br>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('bootstrap/js/bootstrap.min.js'); !!}

<!-- iCheck -->
{!! Html::script('plugins/iCheck/icheck.min.js'); !!}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
