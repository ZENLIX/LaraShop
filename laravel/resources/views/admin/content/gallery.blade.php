@include("admin.layout.header")
<title>Панель приборов</title>
</head>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
    @include("admin.layout.topmenu")
    @include("admin.layout.navbar")
    <style type="text/css">
    .placeholder {
        border: 1px dashed #cccccc;
        height:200px;
        border-radius:5px;
        margin: 0px 0px;
    }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Галерея
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Список изображений</li>
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
                                <h3 class="box-title">Список изображений</h3>
                            </div>
                            <div class="box-body">
                                {{--               <ul class="todo-list ui-sortable">
                                    <li id="item-{{$image->id}}">
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->

                                        <!-- todo text -->
                                        <span class="text">{{$image->filename}}</span>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <a data-id="{{$image->id}}" href='#' style="text-decoration:none; color:#000000 !important;" class="fa fa-trash-o remove_cat"></a>
                                        </div>
                                    </li>
                                </ul> --}}
                                <div class="row-list ">
                                    @foreach ($images->chunk(4) as $images)
                                    <div class="row">
                                        @foreach ($images as $image)
                                        <div class="col-md-3 " id="item-{{$image->id}}">
                                            <img src="{{asset('/files/gallery/small/'.$image->filename)}}" alt="ff" class="img-responsive handle">
                                            <a data-id="{{$image->id}}" href='#' style="text-decoration:none; color:#000000 !important;" class="fa fa-trash-o remove_cat"></a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <br><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Добавить изображение</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                {!! Form::open(array('action' => 'ContentController@storeImage', 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                                <div class="form-group @if ($errors->has('imagefile')) has-error @endif">
                                    {!! Form::label('imagefile', 'Файл', array('class'=>'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::file('imagefile', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('imagefile')) <p class="help-block">{{ $errors->first('imagefile') }}</p> @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        {!! HTML::decode(Form::button('Загрузить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                    </div>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        @include("admin.layout.footer")
        <!-- page script -->
        <script>
        $(function () {
            $('body').on('click', '.remove_cat', function(event) {
            event.preventDefault();
            var id=$(this).attr('data-id');
        bootbox.confirm("Действительно хотите удалить файл?", function(result) {
        if (result == true) {
            var data={ _token : CSRF_TOKEN, _method: 'DELETE', id : id };
            //console.log(id);
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/content/gallery/delete/'+id,
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/content/gallery'
                                            }
                                        });
        }
            else {
            }
        });
        });
            //jQuery UI sortable for the todo list
        $(".row-list").sortable({
            placeholder: "col-md-3 placeholder",
            handle: ".handle",
            items: 'div:not(.row)',
            forcePlaceholderSize: true,
            zIndex: 999999,
        update: function (event, ui) {
        var def_data={ _token : CSRF_TOKEN, _method: 'PATCH' };
        var data = $(this).sortable('serialize');
        var data_res = data + '&' + $.param(def_data);
        console.log(data);
                // POST to server using $.post or $.ajax
                                        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/content/gallery/sort',
                                            data: data_res,
                                            //dataType: 'html',
                                        });
                /*$.ajax({
                    data: data,
                    type: 'POST',
                    url: '/your/url/here'
                });*/
            }
        });
        });
        </script>
    </body>
</html>