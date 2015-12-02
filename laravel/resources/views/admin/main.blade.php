@include("layout.header")
<title>Панель приборов</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include("layout.topmenu")
@include("layout.navbar")  


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
                  <span class="info-box-text">Пользователей</span>
                  <span class="info-box-number">41,410</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% клиентов
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-tag"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Заявок</span>
                  <span class="info-box-number">41,410</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 90%"></div>
                  </div>
                  <span class="progress-description">
                    90% выполнено
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-comments"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Сообщений</span>
                  <span class="info-box-number">41,410</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 10%"></div>
                  </div>
                  <span class="progress-description">
                    10% из них Ваши
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-folder"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Груп</span>
                  <span class="info-box-number">41,410</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% из них Ваши
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>

    



    <div class="row">


        <div class="col-md-6">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><i class="fa fa-exclamation-circle"></i> Важные объявления</h3></div>
<div class="box-footer box-comments" style="background: #FFFFFF;">
                  <div class="box-comment" >
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{!! asset('dist/img/user3-128x128.jpg'); !!}" alt="user image">
                    <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.box-comment -->
                  <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{!! asset('dist/img/user4-128x128.jpg'); !!}" alt="user image">
                    <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.box-comment -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><a href="helper"><i class="fa fa-globe"></i> Последнее из Центра Знаний</a></h3></div>
                <div class="box-footer box-comments" style="background: #FFFFFF;">







                  <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{!! asset('dist/img/user4-128x128.jpg'); !!}" alt="user image">
                    <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.box-comment -->

                  <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{!! asset('dist/img/user4-128x128.jpg'); !!}" alt="user image">
                    <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.box-comment -->

                  <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{!! asset('dist/img/user4-128x128.jpg'); !!}" alt="user image">
                    <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.box-comment -->
                </div>

            </div>
        </div>












    </div>


    <div class="row">


        <div class="col-md-12">
            <div class="box">



                <div class="box-header">
                    <h3 class="box-title"><a href="list?in"><i class="fa fa-list-alt"></i> Последние входящие заявки</a></h3>
                </div>





                <div class="box-body">





<table id="example1" class="table table-bordered">
                <thead>
                <tr>
                    <th><center><div id="sort_id">#</div></center></th>
                    <th><center><div id="sort_prio"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Приоритет"></i></div></center></th>
                    <th><center><div id="sort_subj">Тема</div></center></th>
                    <th><center><div id="sort_cli">Пользователь</div></center></th>
                    <th><center>Создан</center></th>
                    <th><center>Прошло</center></th>
                    <th><center><div id="sort_init">Автор</div></center></th>
                    <th><center>Исполнитель</center></th>
                    <th><center>Статус</center></th>

                </tr>
                </thead>
                <tbody>
                <tr id="tr_9" class="">
                        <td style=" vertical-align: middle; "><small class=""><center>9</center></small></td>
                        <td style=" vertical-align: middle; "><small class=""><center><span class="label label-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Средний приоритет"><i class="fa fa-minus"></i></span></center></small></td>
                        
                        <td style=" vertical-align: middle; "><a class=" pops" title="" data-content="<small>еуые</small>" href="ticket?358211b3b84b50f13f3ce129b9c104ce" data-original-title="new_item">new_item</a></td>
                        
                        
                        <td style=" vertical-align: middle; "><small class="">
                        <a href="view_user?7371a131b959f3527cbde59f0e5caf96">
                        System Account                        </a>
                        </small></td>
                        <td style=" vertical-align: middle; "><small class=""><center><time id="c" datetime="2015-10-12 11:56:24"><span>пн, 12-го окт, 11:56:24</span></time></center></small></td>
                        <td style=" vertical-align: middle; "><small class=""><center><time id="a" datetime="2015-10-12 11:56:24"><span>день назад</span></time>
                    </center></small></td>

                        <td style=" vertical-align: middle; "><small class="">
                        <a href="view_user?7371a131b959f3527cbde59f0e5caf96">
                        </a><a href="view_user?7371a131b959f3527cbde59f0e5caf96">System Account</a>                        
                        </small></td>

                        <td style=" vertical-align: middle; "><small class="">
                                <div class=""><a href="view_user?9531f150dcea6461977cf60bb432fd73">user user</a></div>                            </small></td>
                        <td style=" vertical-align: middle; "><small><center>
                                    <span class="label label-primary"><i class="fa fa-clock-o"></i> ожидания действия</span> </center>
                            </small></td>

                    </tr>

  
                </tbody>

              </table>



                



            </div>




                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>





            



        </section>
    <!-- /.content -->
  </div>

@include("layout.footer")
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
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