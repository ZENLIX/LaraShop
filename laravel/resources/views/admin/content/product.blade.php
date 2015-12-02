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
            Товары и продукты
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Список продуктов</li>
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
                                <h3 class="box-title">Список продуктов</h3>
                            </div>
                            <div class="box-body">
                                <ul class="todo-list ui-sortable">
                                    @foreach ($products as $product)
                                    <li id="item-{{$product->id}}">
                                        <table class="table table-condensed" style="margin-bottom: 0px;">
                                            <tbody>
                                                <td style="width: 50px;     vertical-align: inherit;">
                                                    <span class="handle ui-sortable-handle">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span></td>
                                                <td style="width: 50px;    vertical-align: inherit;"><img style="max-height: 50px;" class="img responsive"
                                                    @if ($product->cover)
                                                    src="{{ asset('files/products/img/small/'.$product->cover) }}"
                                                    @else
                                                    src="{{ asset('dist/img/boxed-bg.png') }}"
                                                    @endif
                                                ></td>
                                                <td style="width: 300px;    vertical-align: inherit;">{{$product->name}}<br> <small>{{$product->category->name}}</small></td>
                                                <td>

                                                </td>
                                                <td style="vertical-align: inherit;"><span class="badge bg-default">{{$product->price}} грн</span></td>
                                                <td style="vertical-align: inherit;" class="text-right">
                                                    <div class="btn-group ">
                                                        <a href="{!! URL::to('/content/product/edit/'.$product->id); !!}" class="btn btn-sm btn-primary btn-flat"><i class=" fa fa-pencil"></i></a>
                                                        <a href="#" data-id="{{$product->id}}" class="btn btn-sm btn-danger btn-flat remove_prod"><i class=" fa fa-trash-o"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody></table>
                                    </li>
                                    {{-- <li id="item-{{$product->id}}">
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <span class="text"><img style="max-height: 50px;" class="img responsive"
                                        @if ($product->cover)
                                        src="{{ asset('files/products/img/small/'.$product->cover) }}"
                                        @else
                                        src="{{ asset('dist/img/boxed-bg.png') }}"
                                        @endif
                                        ></span>
                                        <!-- todo text -->
                                        <span class="text">{{$product->name}}</span>
                                        <span class="">{{$product->price}}</span>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <a href='{!! URL::to('/content/cat/edit/'.$product->id); !!}' style="text-decoration:none; color:#000000 !important;" class="fa fa-edit"></a>
                                            <a data-id="{{$product->id}}" href='#' style="text-decoration:none; color:#000000 !important;" class="fa fa-trash-o remove_prod"></a>
                                        </div>
                                    </li> --}}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="box box-solid">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <a href="{!! URL::to('content/product/add'); !!}" class="btn btn-block btn-primary btn-flat">Создать продукт</a>
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
            $('body').on('click', '.remove_prod', function(event) {
            event.preventDefault();
            var id=$(this).attr('data-id');
        bootbox.confirm("Действительно хотите удалить продукт?", function(result) {
        if (result == true) {
            var data={ _token : CSRF_TOKEN, _method: 'DELETE', id : id };
            //console.log(id);
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/content/product/delete/'+id,
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/content/product/delete'
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
                                            url: SYS_URL+'/content/product/sort',
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