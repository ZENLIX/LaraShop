@include("layout.header")
@include("layout.navbar")
@include("layout.basket")
<div class="containter" style="    padding-top: 60px;
    background-color: {{Setting::get('config.sitecolor', '#FD5F6F')}};
    min-height: 500px;">
    <div class="container">
        <div class="row" style=" padding-top: 50px; ">
            <div class="col-sm-6">
                <div class="jumbotron">
                    <img src="
                    {!! $mainProdImg or asset('dist/img/photo4.jpg'); !!}
                    " alt="" class="img-responsive" style="margin: 0 auto; max-width:460px;">
                </div>
            </div>
            <div class="col-sm-6">

                <div class="jumbotron">

                    <h2>{{Setting::get('config.mainprodtitle', 'Title')}}</h2><br>
                    <p>{!! nl2br (Setting::get('config.mainproddesc', 'desc')) !!} </p><br>
                    <p><a class="btn btn-more btn-lg text-center" href="{{Setting::get('config.mainprodlink', '#')}}" role="button">Узнать больше</a></p>

                </div>
            </div>
        </div>
    </div>
</div>
@include("layout.catalog")
@include("layout.footer")