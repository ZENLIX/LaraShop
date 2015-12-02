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
            Создание продукта
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Список продуктов</li>
                <li class="active">Создание продукта</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о продукте</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::model($product, array('action' => array('ContentController@updateProduct', $product->id), 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                </div>

                                {!! Form::label('price', 'Цена', array('class'=>'col-sm-3 control-label')) !!}

                                <div class="col-sm-2">{!! Form::text('price', null, array('class'=>'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">Категория</label>
                                <div class="col-md-4">
                                    {!! Form::select('categories_id', $CatList, Null, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%')) !!}
                                </div>
                                {!! Form::label('price_old', 'Старая цена', array('class'=>'col-sm-3 control-label')) !!}

                                <div class="col-sm-2">{!! Form::text('price_old', null, array('class'=>'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('urlhash')) has-error @endif">
                                {!! Form::label('urlhash', 'URL-имя', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">{!! URL::to('/') !!}/</span>
                                        {!! Form::text('urlhash', null, array('class'=>'form-control')) !!}
                                        <span class="input-group-addon">.html</span>
                                    </div>
                                    @if ($errors->has('urlhash')) <p class="help-block">{{ $errors->first('urlhash') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('cover')) has-error @endif">
                                {!! Form::label('cover', 'Изображение', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-2"><img style="max-height: 50px;" class="img responsive"
                                    @if ($product->cover)
                                    src="{{ asset('files/products/img/small/'.$product->cover) }}"
                                    @else
                                    src="{{ asset('dist/img/boxed-bg.png') }}"
                                    @endif
                                    >
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('cover')) <p class="help-block">{{ $errors->first('cover') }}</p> @endif
                                </div>
                                {!! Form::label('label', 'Label', array('class'=>'col-sm-2 control-label')) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('label', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('label')) <p class="help-block">{{ $errors->first('label') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                {!! Form::label('description', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('description_full')) has-error @endif">
                                {!! Form::label('description_full', 'Детальное описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('description_full', null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('description_full')) <p class="help-block">{{ $errors->first('description_full') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('values')) has-error @endif">
                                {!! Form::label('values', 'Свойства', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('values', null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('values')) <p class="help-block">{{ $errors->first('values') }}</p> @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                {!! Form::label('title', 'Title', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('title', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('keywords')) has-error @endif">
                                {!! Form::label('keywords', 'Keywords', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('keywords', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('keywords')) <p class="help-block">{{ $errors->first('keywords') }}</p> @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">Сопутствующие товары</label>
                                <div class="col-md-9">
                                    {!! Form::select('related[]', $Prods, $myProds, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">В наличии</label>
                                <div class="col-md-9">
                                    <label class="col-md-12">
                                        {!! Form::checkbox('isset', 'true', null, array('class' => 'minimal')); !!}
                                        есть
                                    </label>
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
    <!-- iCheck -->
    {!! Html::script('plugins/iCheck/icheck.min.js'); !!}
    <!-- page script -->
    <script type="text/javascript">
                $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
        });
        $(".select2").select2({
            maximumSelectionSize: 4
        });
    </script>
</body>
</html>