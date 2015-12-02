@include("layout.header")
@include("layout.navbar")
@include("layout.basket")
<div style="    background-color: white;">
  <div class="container" style="padding-top:100px;padding-bottom:50px; background-color: F7F7F7;">
    <!-- Example row of columns -->
    <div class="">
      <div class="col-md-12">
        <div class="col-md-12">
          <small class="text-muted pull-right"><a href="{{ URL::to('/catalog')}}">Каталог</a> /
          <a href="{{ URL::to('/'.$product->category->urlhash)}}">{{$product->category->name}}</a> / {{$product->name}}</small><br><br>
        </div>
        <div class="col-md-6">
          <img width="510" height="510" src="{{asset('/files/products/img/'.$product->cover)}}" class="img-responsive img-rounded" alt="{{$product->name}}" title="{{$product->name}}" style="max-height: 487px;">
        </div>
        <div class="col-md-6">
          <h2 style="margin-top: 0px;">{{$product->name}}</h2>
          <p class="price" style="font-size: 22px!important;">
          @if ($product->price_old)
          <del><span class="amount">{{$product->price_old}} грн</span></del>
          @endif
          <span class="amount label label-warning">{{$product->price}} грн</span></p>
          <p>{!! nl2br ($product->description) !!}</p>
          <div class="">
            <div class="">
              <div class="col-md-12">
                @if ($product->isset == 'true')
                <center>
                <a id="pay" class="btn btn-pay2 btn-lg" href="#" role="button" data-id="{{$product->id}}"><i class="fa fa-shopping-cart"></i> В корзину</a>
                </center>
                @else
                В данный момент товара нет в наличии
                @endif
              </div>

              <div class="col-md-12"><hr>
                <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/sharer.php?u={{Request::url()}}"><span class="fa fa-facebook"></span></a>
                <a class="btn btn-social-icon btn-vk" href="http://vkontakte.ru/share.php?url={{Request::url()}}&amp;title={{$product->name}}&amp;image={{asset('/files/products/img/'.$product->cover)}}"><span class="fa fa-vk"></span></a>
                <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/share?url={{Request::url()}}&amp;text={{$product->name}}"><span class="fa fa-twitter"></span></a>
                <a class="btn btn-social-icon btn-microsoft" href="mailto:?body={{Request::url()}}&amp;subject={{$product->name}}"><i class="fa fa-envelope-o"></i></a>
              </div>

            </div>
          </div>
          <br>
        </div>
        <div class="col-md-12"><br><br></div>
        <div class="col-md-12">
          <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Информация</a></li>
                <li><a href="#tab2default" data-toggle="tab">Характеристики</a></li>
                <li><a href="#comment" data-toggle="tab">Отзывы
                  ({{$product->comments->where('approve', 'true')->count()}})
                </a></li>
              </ul>
            </div>
            <div class="panel-body">
              <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                  <h4>Описание продукта</h4>
                  <p>
                  {!! nl2br ($product->description_full) !!}
                  </p>
                </div>
                <div class="tab-pane fade" id="tab2default">
                  <p>
                  {!! nl2br ($product->values) !!}
                  </p>
                </div>
                <div class="tab-pane fade" id="comment">
                  @if ($product->comments->where('approve', 'true')->count() == 0)
                  <h4>Ещё нет не одного отзыва - Вы можете быть первым!</h4>
                  @else
                  <table class="table">
                    <tbody>
                      @foreach ($product->comments->where('approve', 'true') as $comment)
                      <tr><td style="width: 100px; "><img style=" max-height: 100px; " src="{{asset('dist/img/def_usr.png')}}" alt="..." class="img-responsive"></td>
                      <td>
                        <strong>{{$comment->name}}</strong> - {{ LocalizedCarbon::instance($comment->created_at)->diffForHumans() }}
                        <p>{{$comment->msg}}</p>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endif
                <hr>
                <h4>Добавить отзыв</h4>
                <div id="form_comment">
                  <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                    </div> <!-- end .flash-message -->
                    {!! Form::open(array('action' => ['HomeController@storeComment', $product->id], 'method'=> 'POST', 'class'=>'form-horizontal')) !!}
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                      <div class="col-sm-4">
                        {!! Form::text('name', null, array('class'=>'form-control input-lg','placeholder'=>'Имя')) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                      </div>
                    </div>
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                      <div class="col-sm-4">
                        {!! Form::text('email', null, array('class'=>'form-control input-lg','placeholder'=>'E-mail')) !!}
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                      </div>
                    </div>
                    <div class="form-group @if ($errors->has('msg')) has-error @endif">
                      <div class="col-sm-6">
                        {!! Form::textarea('msg', null, array('class'=>'form-control input-lg','placeholder'=>'Ваш отзыв', 'rows'=>'3')) !!}
                        @if ($errors->has('msg')) <p class="help-block">{{ $errors->first('msg') }}</p> @endif
                      </div>
                    </div>
                    <div class="col-sm-2">
                      {!! Captcha::img(); !!}
                    </div>
                    <div class="col-sm-2 @if ($errors->has('captcha')) has-error @endif">
                      {!! Form::text('captcha', null, array('class'=>'form-control input-lg', 'placeholder'=>'Код с картинки')) !!}
                      @if ($errors->has('captcha')) <p class="help-block">{{ $errors->first('captcha') }}</p> @endif
                    </div>
                    <div class="col-sm-2">
                      {!! HTML::decode(Form::button('Оставить отзыв', array('type' => 'submit', 'class'=>'btn btn-info pull-right btn-lg'))) !!}
                    </div>
                    {!! Form::close(); !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12"><h3>
          <center>Мы так же рекомендуем</center></h3>
          <br>
          <div class="" style="padding-bottom:0px;">
            <!-- Example row of columns -->
            <div class="row">
              @foreach ($products->chunk(3) as $products)
              <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4">
                  <center>
                  <div class="thumbnail" style=" max-width: 210px;     margin-bottom: 10px;">
                    <a href="{{ URL::to('/'.$product->product->urlhash)}}.html">
                    <div class="caption">
                    </div>
                    <img src="{!! asset('/files/products/img/'.$product->product->cover); !!}" alt="ff" class="img-responsive">
                    @if ($product->product->label)
                    <span class="pi">{{$product->product->label}}</span>
                    @endif
                    </a>
                  </div></center>
                  <div style="padding-left: 30px;padding-right: 30px;">
                    <a href="{{ URL::to('/'.$product->product->urlhash)}}.html" style=" color: inherit; text-decoration:none; ">
                    <center>      <h4 style=" margin-bottom: 3px;">{{$product->product->name}}</h4>
                    <a id="pay" style="  color: #FF5566;  " class="btn btn-default btn-xs" href="#"  data-id="{{$product->product->id}}"><i class="fa fa-shopping-cart"></i> Купить <small class="text-muted ">({{$product->product->price}} грн)</small></a>
                    </a></center>
                  </div>
                </div>
                @endforeach
              </div><br><br>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include("layout.footer")
<script type="text/javascript">
    $(function () {
    var hash = window.location.hash;
    // do some validation on the hash here
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');
});
</script>