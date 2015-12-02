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
            Список клиентов
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Ваши клиенты</li>
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
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>Имя</center></th>
                                            <th><center>Телефон</center></th>
                                            <th><center>E-mail</center></th>
                                            <th><center>Управлять</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                        <tr>
                                            <td>{{$client->name}}</td>
                                            <td>{{$client->tel}}</td>
                                            <td>{{$client->email}}</td>
                                            <td><center>
                                                <div class="btn-group text-center">
                                                    <a href='{{URL::to('/clients/'.$client->id)}}' class="btn btn-warning btn-xs">редактировать</a>
                                                    <button type="button" data-id="{{$client->id}}" class="btn btn-danger btn-xs remove">удалить</button>
                                                </div>
                                                </center>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
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
        <script>
        $(function () {
            $('body').on('click', '.remove', function(event) {
            event.preventDefault();
            var id=$(this).attr('data-id');
        bootbox.confirm("Действительно хотите удалить клиента и его заказы?", function(result) {
        if (result == true) {
            var data={ _token : CSRF_TOKEN, _method: 'DELETE', id : id };
            //console.log(id);
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/clients/'+id,
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/clients'
                                            }
                                        });
        }
            else {
            }
        });
        });
            $("#example1").DataTable({
            "language": {
                        "url": "{!! asset('plugins/datatables/lang/Russian.json'); !!}",
                    }
            });
            
        });
        </script>
    </body>
</html>