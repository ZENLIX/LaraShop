<div class="containter" style="padding-top:50px; padding-bottom:70px; background-color: #F7F7F7;">
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-9">

                <div class="row">
                    <div class="col-md-12"><h2><center>Последние новинки</center></h2><br></div>
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
            <div class="col-md-3" style="border-left: 1px solid #E2E2E2;">
                <h3>Категории</h3>
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
            </div>


        </div></div>


    </div>
    <div class="containter" style="height:150px;background-image: url(dist/img/geometic-bg-salmon.jpg);">
        <div class="container">
            <div class="jumbotron">
                <div class="container">
                    <p class="text-center">Ознакомьтесь со всеми товарами нашего сервиса </p>
                    <p class="text-center"><a class="btn btn-more btn-lg" href="{{URL::to('/catalog')}}" role="button">Перейти в каталог</a></p>
                </div>
            </div>
        </div>
    </div>