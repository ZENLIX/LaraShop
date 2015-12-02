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
            Категории товаров
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Список категорий</li>
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
                                <h3 class="box-title">Список категорий</h3>
                            </div>
                            <div class="box-body">
                                <ul class="todo-list ui-sortable">
                                    @foreach ($cats as $cat)
                                    <li id="item-{{$cat->id}}">
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->

                                        <!-- todo text -->
                                        <span class="text">{{$cat->name}}</span>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <a href='{!! URL::to('/content/cat/edit/'.$cat->id); !!}' style="text-decoration:none; color:#000000 !important;" class="fa fa-edit"></a>
                                            <a data-id="{{$cat->id}}" href='#' style="text-decoration:none; color:#000000 !important;" class="fa fa-trash-o remove_cat"></a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="box box-solid">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <a href="{!! URL::to('content/cat/add'); !!}" class="btn btn-block btn-primary btn-flat">Создать категорию</a>
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
        bootbox.confirm("Действительно хотите удалить категорию?", function(result) {
        if (result == true) {
            var data={ _token : CSRF_TOKEN, _method: 'DELETE', id : id };
            //console.log(id);
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/content/cat/delete/'+id,
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/content/cat/delete'
                                            }
                                        });
        }
            else {
            }
        });
        });
            //jQuery UI sortable for the todo list
        $(".todo-list").sortable({
            placeholder: "sort-highlight",
            handle: ".handle",
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
                                            url: SYS_URL+'/content/cat/sort',
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