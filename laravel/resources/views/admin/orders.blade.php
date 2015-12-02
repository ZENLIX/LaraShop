@include("admin.layout.header")
<title>Панель приборов</title>
</head>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
    @include("admin.layout.topmenu")
    @include("admin.layout.navbar")
    <style type="text/css">
    form.btn-group + form.btn-group {
        margin-left: -5px;
    }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Список заказов
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Ваши заказы</li>
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
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th ><center>Код</center></th>
                                            <th><center>Дата</center></th>
                                            <th class="no-sort"><center>Adv</center></th>
                                            <th><center>Клиент</center></th>
                                            <th><center>К-во</center></th>
                                            <th><center>Сумма</center></th>
                                            <th class="no-sort"><center>Статус</center></th>
                                            <th class="no-sort"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr class="{{$order->rowStyle}}">
                                            <td><center><em>
                                                <a href="{{URL::to('/orders/'.$order->id)}}">
                                                {{$order->code}}
                                                </a>
                                            </em></center></td>
                                            <td><center><span data-toggle="tooltip"  data-placement="right" title="
                                            {!! LocalizedCarbon::instance($order->created_at)->formatLocalized('%d %%f %Y, %H:%M') !!}
                                                ">
                                            <small>{{ LocalizedCarbon::instance($order->created_at)->diffForHumans() }}</small></span></center></td>
                                            <td><center>
                                                <center><small>
                                                @if ($order->itemGift == true)
                                                <span class="label label-info"><em class="info_client"><i class="fa fa-gift"></i></em></span>
                                                @endif
                                                @if ($order->itemFast == true)
                                                <span class="label label-danger"><em class="info_client"><i class="fa fa-clock-o"></i></em></span>
                                                @endif
                                                </small></center>
                                            </center></td>
                                            <td><center><span data-toggle="tooltip" data-html="true"  data-placement="right" title="Tel: {{$order->client->tel}} <br> Email: {{$order->client->email}}">
                                            <small>{{$order->client->name}}</small></span></center></td>
                                            <td><center><small>{!! $order->totalCount !!}</small></center></td>
                                            <td><center><small>{!! $order->totalSumm !!}</small></center></td>
                                            <td>
                                                <center><small>
                                                <div class="btn-group" style="">
                                                    {!! Form::open(array('action' => ['OrdersController@updateStatusNew', $order->id], 'method'=> 'PATCH', 'class'=>'btn-group')) !!}
                                                    <button  type="submit" class="btn btn-primary btn-xs"><i class="fa fa-clock-o"></i> </button>
                                                    <input type="hidden" class="btn"><!-- fake sibling to right -->
                                                    {!! Form::close(); !!}
                                                    {!! Form::open(array('action' => ['OrdersController@updateStatusPaid', $order->id], 'method'=> 'PATCH', 'class'=>'btn-group')) !!}
                                                    <button  type="submit" class="btn btn-warning btn-xs"><i class="fa fa-money"></i> </button>
                                                    <input type="hidden" class="btn"><!-- fake sibling to right -->
                                                    {!! Form::close(); !!}
                                                    {!! Form::open(array('action' => ['OrdersController@updateStatusSent', $order->id], 'method'=> 'PATCH', 'class'=>'btn-group')) !!}
                                                    <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> </button>
                                                    <input type="hidden" class="btn"><!-- fake sibling to right -->
                                                    {!! Form::close(); !!}

                                                </div></small></center>
                                            </td>
                                            <td>
                                                <center><small>
                                                <div class="btn-group" style="">

                                                    <button type="button" data-id="{{$order->id}}" class="btn btn-default btn-xs enter_ttn"><i class="fa fa-tag"></i> </button>
                                                    <button type="button" data-id="{{$order->id}}" class="btn btn-default btn-xs remove"><i class="fa fa-trash-o"></i> </button>

                                                </div>
                                                </small></center>
                                            </td>
                                        </tr>
                                        {{--  <tr>
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
                                        </tr> --}}
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
        bootbox.confirm("Действительно хотите удалить заказ?", function(result) {
        if (result == true) {
            var data={ _token : CSRF_TOKEN, _method: 'DELETE', id : id };
            //console.log(id);
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/orders/'+id,
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/orders'
                                            }
                                        });
        }
            else {
            }
        });
        });
            $("#example1").DataTable(
        {
        "processing": true,
        "order": [[ 1, "desc" ]],
                "columnDefs": [ {
                "targets": 'no-sort',
                "orderable": false,
            } ],
            "language": {
                        "url": "{!! asset('plugins/datatables/lang/Russian.json'); !!}",
                    }
            });
            
            $('body').on('click', '.enter_ttn', function(event) {
            event.preventDefault();
            var id=$(this).attr('data-id');
        bootbox.prompt({
        title: "Введите номер ТТН",
        value: "",
        callback: function(result) {
            if (result === null) {
            
            } else {
                var data={ _token : CSRF_TOKEN, _method: 'PATCH', ttn : result };
        $.ajax({
                                            type: 'POST',
                                            url: SYS_URL+'/orders/'+id+'/ttn',
                                            data: data,
                                            //dataType: 'html',
                                            success: function(html) {
                                                window.location = SYS_URL+'/orders/'+id;
                                            }
                                        });
            // Example.show("Hi <b>"+result+"</b>");
            }
        }
        });
        });
        });
        </script>
    </body>
</html>