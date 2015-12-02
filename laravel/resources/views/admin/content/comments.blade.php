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
            Модерирование комментариев
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Комментарии продуктов</li>
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
                                <h3 class="box-title">Комментарии</h3>
                            </div>
                            <div class="box-body">

                                <table class="table">
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        @if( ! empty($comment->product->id))

                                        <tr class="
                                            @if($comment->approve == 'true') success @else default @endif
                                            "><td style="width: 100px; "><img style=" max-height: 100px; " src="{{asset('files/products/img/small/'.$comment->product->cover)}}" alt="..." class="img-responsive"></td>
                                            <td>
                                                <a href="{!! URL::to('/'.$comment->product->urlhash.'.html'); !!}">
                                                {{$comment->product->name}}
                                                </a>
                                            </td>
                                            <td>

                                                <strong>{{$comment->name}} / {{$comment->email}}</strong> - {{ LocalizedCarbon::instance($comment->created_at)->diffForHumans() }}
                                                <p>{{$comment->msg}}</p>
                                            </td>

                                            <td>
                                                <div class="btn-group ">
                                                    {!! Form::open(array('action' => ['ContentController@updateCommentsApprove', $comment->id], 'method'=> 'PATCH', 'class'=>'')) !!}
                                                    {!! HTML::decode(Form::button('Добавить', array('type' => 'submit', 'class'=>'btn btn-xs btn-flat btn-block btn-success'))) !!}
                                                    {!! Form::close(); !!}
                                                    {!! Form::open(array('action' => ['ContentController@destroyComments', $comment->id], 'method'=> 'DELETE', 'class'=>'')) !!}
                                                    {!! HTML::decode(Form::button('Удалить', array('type' => 'submit', 'class'=>'btn btn-xs btn-flat btn-block btn-danger'))) !!}
                                                    {!! Form::close(); !!}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
    </body>
</html>