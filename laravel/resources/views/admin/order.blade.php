@include("admin.layout.header")
{!! Html::style('plugins/fancybox/jquery.fancybox.css'); !!}
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
            Заказ {{$order->code }}
            <small> от {!! LocalizedCarbon::instance($order->created_at)->formatLocalized('%d %%f %Y, %H:%M') !!}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Заказ {{$order->code }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
                        @endif
                        @endforeach
                        </div> <!-- end .flash-message -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Информация о заказе</h3>
                            </div>
                            <div class="box-body">

                                <div class="">


                                    <div class="col-sm-6">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="active" colspan="2"><small><center>Получатель</center></small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Имя:</small></td>
                                                        <td><small>{{$order->client->name}}</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Моб:</small></td>
                                                        <td><small>{{$order->client->tel}}</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>E-mail:</small></td>
                                                        <td><small>{{$order->client->email}}</small></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">


                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="active" colspan="2"><small><center>Доставка</center></small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Тип:</small></td>
                                                        <td><small>{{$delivery_type}}</small></td>
                                                    </tr>


                                                    <tr>
                                                        <td><small>Адрес:</small></td>
                                                        <td><small>{!! $order->delivery_city !!}, {!! $order->delivery_np !!} {!! $order->delivery_adr !!}</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>ТТН:</small></td>
                                                        <td><small>{{$order->ttn}}</small></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>


                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td><small>Оплата:</small></td>
                                                        <td><small>{{$pay_type}}</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Статус:</small></td>
                                                        <td><small>{{$pay_status}}</small></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>







                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="active">

                                                        <th style=" width: 30px; "><center><small>#</small></center></th>
                                                        <th style=" width: 80px; "></th>
                                                        <th><center><small>Название</small></center></th>
                                                        <th style=" width: 50px; "><center><small>К-во</small></center></th>
                                                        <th style=" width: 60px; "><center><small>Цена</small></center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; ?>
                                                    @foreach ($order->items()->orderby('product_id','asc')->get() as $row)
                                                    @if ($row->product_id == 'np')
                                                    <tr id="tr_" class="warning">

                                                        <td style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                        <td style=" vertical-align: inherit; "></td>
                                                        <td style=" vertical-align: inherit; " colspan="2"><small>Доставка "до дверей" (курьер Новой Почты)</small></td>

                                                        <td id="price_" name="cost" val="" colspan="2" style=" vertical-align: inherit; "><center><small>{!! Setting::get('product.np') !!}</small></center></td>

                                                    </tr>
                                                    @elseif ($row->product_id == 'gift')
                                                    <tr id="tr_" class="warning">

                                                        <td style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                        <td style=" vertical-align: inherit; "></td>
                                                        <td style=" vertical-align: inherit; "><small>Подарочная упаковка</small></td>
                                                        <td style=" vertical-align: inherit; "><small><center>{{$row->qty}}</center></small></td>
                                                        <td style=" vertical-align: inherit; "><center><small>{!! (Setting::get('product.gift')*$row->qty) !!}</small></center></td>

                                                    </tr>
                                                    @elseif ($row->product_id == 'fast')
                                                    <tr id="tr_" class="warning">

                                                        <td  style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                        <td style=" vertical-align: inherit; "></td>
                                                        <td style=" vertical-align: inherit; " colspan="2"><small>Быстрая доставка</small></td>

                                                        <td style=" vertical-align: inherit; "><center><small>{!! Setting::get('product.fast') !!}</small></center></td>
                                                    </tr>
                                                    @else
                                                    <tr>

                                                        <td style=" vertical-align: inherit; "><small><center>{{$i}}</center></small></td>
                                                        <td style=" vertical-align: inherit; ">
                                                            <center>
                                                            <img style=" max-height: 50px;" src="{{ asset('files/products/img/small/'.$row->product->cover) }}" alt="4" class="img-responsive"> </center>
                                                        </td>
                                                        <td style=" vertical-align: inherit; ">
                                                            <a href="{{URL::to('/'.$row->product->urlhash.'.html')}}">
                                                        {{$row->product->name}}</a></td>
                                                        <td style=" vertical-align: inherit; "><small><center>{{$row->qty}}</center></small></td>
                                                        <td style=" vertical-align: inherit; "><small><center>{!! ($row->product->price*$row->qty) !!}</center></small></td>

                                                    </tr>
                                                    @endif
                                                    <?php $i++ ?>
                                                    @endforeach

                                                    <tr class="active">
                                                        <td class="text-right" colspan="3"><b><small>Всего товара:</small></b></td>
                                                        <td class="text-left"><b><small><center>{{$totalCount}}</center></small></b></td>
                                                        <td><b><div id="total_summ"><small><center>{{$totalSumm}}</center></small></div></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">



                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="active"><small><center>Дополнительная информация</center></small></td>
                                                    </tr>


                                                    <tr>

                                                        <td><small>{{$order->comment or Null}}</small></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>
                                    @if ($order->files)
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="active" colspan="3"><small><center>Файлы</center></small></td>
                                                    </tr>
                                                    <?php $i=1;?>
                                                    @foreach ($order->files as $file)
                                                    <tr>
                                                        <td><small>{{$i}}</small></td>
                                                        @if ($file->image == 'true')
                                                        <td><small>
                                                            <a class="fancybox" href="{!! URL::to('/order/download/'.$file->hash); !!}">
                                                        {{$file->name}}</small></td>
                                                        </a>
                                                        @else
                                                        <td><small><a href="{!! URL::to('/order/download/'.$file->hash); !!}">{{$file->name}}</a></small></td>
                                                        @endif
                                                        <td><small>{!! round((File::size('files/uploads/'.$file->hash.'.'.$file->extension))/1024/1024, 3) !!} Mb</small></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                    {{--
                                                    <td>  <small> {{$file->name}} </small></td>
                                                    <td>  <small> {{$file->hash}} </small></td>
                                                    @endforeach
                                                    --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Статус</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                {!! Form::open(array('action' => ['OrdersController@updateStatusNew', $order->id], 'method'=> 'PATCH')) !!}
                                <button type="submit" class="btn btn-block btn-primary btn-flat"><i class="fa fa-clock-o"></i> Ожидание оплаты</button>
                                {!! Form::close(); !!}
                                {!! Form::open(array('action' => ['OrdersController@updateStatusPaid', $order->id], 'method'=> 'PATCH')) !!}
                                <button type="submit" class="btn btn-block btn-warning btn-flat"><i class="fa fa-money"></i> Оплата принята</button>
                                {!! Form::close(); !!}
                                <button data-id="{{$order->id}}" type="button" class="btn btn-block btn-default btn-flat enter_ttn"><i class="fa fa-tag"></i> Ввести номер ТТН</button>
                                {!! Form::open(array('action' => ['OrdersController@updateStatusSent', $order->id], 'method'=> 'PATCH')) !!}
                                <button type="submit" class="btn btn-block btn-success btn-flat"><i class="fa fa-check-square-o"></i> Заказ отправлен</button>
                                {!! Form::close(); !!}
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Управлять</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <a href="{!! URL::to('/orders/edit/'.$order->id); !!}" class="btn btn-block btn-primary btn-flat">Редактировать заказ</a>
                                <a href="{!! URL::to('/orders/'.$order->id.'/print'); !!}" class="btn btn-block btn-info btn-flat">Распечатать заказ</a>
                                <a class="btn btn-block btn-danger btn-flat remove" data-id="{{$order->id}}">Удалить заказ</a>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        @include("admin.layout.footer")
        {!! Html::script('plugins/fancybox/jquery.fancybox.pack.js'); !!}
        <!-- page script -->
        <script type="text/javascript">
                $('.fancybox').fancybox({
            "type": "image"
            });
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
            $('body').on('click', '.enter_ttn', function(event) {
            event.preventDefault();
            var id=$(this).attr('data-id');
        bootbox.prompt({
        title: "Введите номер ТТН",
        value: "{{$order->ttn}}",
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
        </script>
    </body>
</html>