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
    <i class="fa fa-tachometer"></i> Панель приборов
    <small>Основная информация</small>
    </h1>
    <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
        <li class="active">Панель приборов</li>
    </ol>
</section>

    <!-- Main content -->
<section class="content">


<div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Клиентов</span>
                  <span class="info-box-number">{{ $totalClients }}</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Любимых клиентов
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Продуктов</span>
                  <span class="info-box-number">{{$totalProducts}}</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    {{$totalCount}}шт продано
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-list-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Заказов</span>
                  <span class="info-box-number">{{$totalPurchase}}</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    {{$totalPurchaseOk}} продаж
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Денег получено</span>
                  <span class="info-box-number">{{$totalMoney}}</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Успешно потрачено :)
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>

    



    <div class="row">


        <div class="col-md-6">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><i class="fa fa-exclamation-circle"></i> ТОП популярных продуктов</h3></div>
<div class="box-body no-padding" style="background: #FFFFFF;">



<table class="table table-condensed">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Название</th>
                  <th>К-во</th>
                </tr>
                <?php $i=1;?>
@foreach ($topProds as $prod)
                <tr>
                  <td>{{$i}}</td>
                  <td><a href="{{URL::to('/'.$prod['urlhash'].'.html')}}">{{$prod['name'] }} </a></td>
                  <td>
                    {{$prod['qty'] }}
                  </td>
                  
                </tr>
                <?php $i++;?>
@endforeach


              </tbody></table>







                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><i class="fa fa-globe"></i> График посещений</h3></div>
                <div class="box-footer box-comments" style="background: #FFFFFF;">


<div id="container" style="min-width: 300px; height: 200px; margin: 0 auto"></div>


                </div>

            </div>
        </div>












    </div>


    <div class="row">


        <div class="col-md-12">
            <div class="box">



                <div class="box-header">
                    <h3 class="box-title"><a href="{{URL::to('/orders')}}"><i class="fa fa-list-alt"></i> Последние заказы</a></h3>
                </div>





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
                    {{ LocalizedCarbon::parse($order->created_at)->format('d M Y H:i:s') }}
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




                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>





            



        </section>
    <!-- /.content -->
  </div>

@include("admin.layout.footer")
<!-- page script -->
<!-- Morris.js charts -->

{!! Html::script('plugins/highcharts/highcharts.js'); !!}


<script>
  $(function () {


Highcharts.theme = {
   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
         ]
      },
      borderWidth: 2,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
      plotShadow: true,
      plotBorderWidth: 1
   },
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   },

   navigation: {
      buttonOptions: {
         theme: {
            stroke: '#CCCCCC'
         }
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);




     var options = {
                 title: {
                text: 'К-во уникальных посещений за последние 5 дней',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
            
                categories: []
            },
            yAxis: {
                title: {
                    text: 'К-во уникальных посетителей'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                enabled: false
            },
        chart: {
            renderTo: 'container',
            type: 'spline'
        },
        series: [{}]
    };

    $.getJSON('stat', function(data) {
        options.series[0].data = data;
        options.series[0].name= 'Хостов';
        var chart = new Highcharts.Chart(options);
        //chart.xAxis[0].setCategories(['one','two','three','four']);
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
                                        window.location = SYS_URL+'/dashboard';
                                       }

                                   });


     // Example.show("Hi <b>"+result+"</b>");
    }
  }
});


});


    $("#example1").DataTable({
      "order": [[ 1, "desc" ]],
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
      "language": {
                "url": "plugins/datatables/lang/Russian.json",
            },
                  "searching": false,
                  "paging": false,
                        "info": false,
          });
    $('#example2').DataTable({
      "paging": true,
      "language": {
                "url": "plugins/datatables/lang/Russian.json"
            },

      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>