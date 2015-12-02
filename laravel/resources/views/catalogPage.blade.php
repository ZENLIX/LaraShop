@include("layout.header")
@include("layout.navbar")
@include("layout.basket")
<div class="containter" style="padding-top:100px; min-height:100px;background-color: {{Setting::get('config.sitecolor', '#FD5F6F')}};">
    <div class="container">
        <div class="jumbotron" style="padding: 0px;">
            <div class="container" style=" color: white; ">
                <h2>Каталог</h2>
                <p>Наши лучшие продукты!</p>
            </div>
        </div>
    </div>
</div>
<div class="containter" style="padding-top:50px; padding-bottom:70px; background-color: #F7F7F7;">
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-3" style="border-right: 1px solid #E2E2E2;">
                <h4>Категории товаров</h4>
                <br>
                <table class="table ">
                    <tbody>


                        @foreach ($cats as $cat)
                        <tr>
                            <td style=" border-top: 0px; vertical-align: inherit;"><a href="{!! URL::to('/'.$cat->urlhash); !!}" style=" color: inherit; text-decoration:none; "><img style=" max-height: 50px; " src="{{ asset('files/cats/img/'.$cat->cover) }}" alt="4" class="img-responsive"></a></td>
                            <td style=" border-top: 0px; vertical-align: inherit;">
                                <a href="{!! URL::to('/'.$cat->urlhash); !!}" style=" color: inherit; text-decoration:none; ">
                                <h4 style="margin-bottom: 0px;">{{$cat->name}}</h4>
                                <small class="text-muted">{{$cat->products->count()}} товаров</small>
                                </a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
                <hr>
                <h4>Самые популярные</h4>
                <table class="table ">
                    <tbody>


                        @foreach ($topProds as $prod)
                        <tr>
                            <td style=" border-top: 0px; vertical-align: inherit;"><a href="{!! URL::to('/'.$prod['link']); !!}.html" style=" color: inherit; text-decoration:none; "><img style=" max-height: 50px; " src="{{ asset('files/products/img/small/'.$prod['cover']) }}" alt="4" class="img-responsive"></a></td>
                            <td style=" border-top: 0px; vertical-align: inherit;">
                                <a href="{!! URL::to('/'.$prod['link']); !!}.html" style=" color: inherit; text-decoration:none; ">
                                <h4 style="margin-bottom: 0px;">{{$prod['name']}}</h4>

                                </a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-md-9">

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-right">Каталог товаров</h3>
                        <br><br>
                        <hr>
                    </div>
                </div>
                @foreach ($products->chunk(3) as $products)
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <center>
                        <div class="thumbnail" style=" max-width: 210px;     margin-bottom: 10px;">
                            <a href="{{ URL::to('/'.$product->urlhash)}}.html">
                            <div class="caption">

                            </div>

                            <img src="{!! asset('/files/products/img/'.$product->cover); !!}" alt="ff" class="img-responsive">
                            @if ($product->label)
                            <span class="pi">{{$product->label}}</span>
                            @endif


                            </a>
                        </div></center>

                        <div style="padding-left: 30px;padding-right: 30px;">
                            <a href="{{ URL::to('/'.$product->urlhash)}}.html" style=" color: inherit; text-decoration:none; ">
                            <center>      <h4 style=" margin-bottom: 3px;">{{$product->name}}</h4>

                            @if ($product->isset == "true")
                            <a id="pay" style="  color: #FF5566;  " class="btn btn-default btn-xs" href="#"  data-id="{{$product->id}}"><i class="fa fa-shopping-cart"></i> Купить <small class="text-muted ">({{$product->price}} грн)</small></a>
                            @else
                            <small>Нет в наличии</small>
                            @endif
                            </a></center>
                        </div>
                    </div>
                    @endforeach
                </div><br><br>
                @endforeach
            </div>
        </div>

    </div></div>


</div>
@include("layout.footer")