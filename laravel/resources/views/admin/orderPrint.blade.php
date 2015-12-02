@include("admin.layout.header")
<title>Панель приборов</title>
</head>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Заказ {{$order->code }}
            <small> от {{ LocalizedCarbon::parse($order->created_at)->format('d M Y H:i:s') }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/') }}">IT-TOYS</a></li>
                <li class="active">Заказ {{$order->code }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
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

                                                        {{$row->product->name}}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->
    <script type="text/javascript">

    var CSRF_TOKEN='{!! csrf_token() !!}';
    var SYS_URL='{!! URL::to('/'); !!}';
    </script>
    <!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
    <!-- jQuery UI 1.11.4 -->
    <!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
    {!! Html::script('dist/js/jquery-ui.min.js'); !!}
    <!-- Bootstrap 3.3.5 -->
    {!! Html::script('bootstrap/js/bootstrap.min.js'); !!}
    <!-- Select2 -->
    {!! Html::script('plugins/select2/select2.full.min.js'); !!}
    <!-- AdminLTE App -->
    {!! Html::script('dist/js/app.min.js'); !!}

</body>
</html>