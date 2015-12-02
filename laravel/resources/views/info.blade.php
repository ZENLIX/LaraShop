@include("layout.header")
@include("layout.navbar")
<div class="containter" style="padding-top:100px; min-height:100px;background-image: url(dist/img/geometic-bg-salmon.jpg);">
    <div class="container">
        <div class="jumbotron" style="padding: 0px;">
            <div class="container">
                <h2><center> <span class="fa-stack fa-lg">
                <i class="fa fa-money fa-stack-1x"></i>
                <i class="fa fa-ban fa-stack-2x text-danger"></i>
                </span>   Мы не интернет-магазин!</center> </h2>
                <p class="text-center">Да, мы не являемся интернет-магазином и не занимаемся предпринимательской деятельностью! То, что мы делаем не является систематическим и не несёт цели получения прибыли. Все заказы являются индивидуальной ручной работой, а потому обмену и возврату не подлежат.
                Всё, что тут происходит - называется искусством.</p>
            </div>
        </div>
    </div>
</div>
<div class="containter" style="padding-top:100px; padding-bottom:100px; background-color: #F7F7F7;">
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            {!! $info->text; !!}


        </div></div>


    </div>
    @include("layout.footer")