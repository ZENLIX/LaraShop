@include("layout.header")
@include("layout.navbar")
{!! Html::style('plugins/fancybox/jquery.fancybox.css'); !!}
<div class="containter" style="padding-top:100px; min-height:100px;background-color: {{Setting::get('config.sitecolor', '#FD5F6F')}};">
    <div class="container">
        <div class="jumbotron" style="padding: 0px;">
            <div class="container" style=" color: white; ">
                <h2>Галерея</h2>
                <p>Примеры готовых продуктов</p>
            </div>
        </div>
    </div>
</div>
<div class="containter" style="padding-top:50px; padding-bottom:100px; background-color: #F7F7F7;">
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-12">

                @foreach ($images->chunk(4) as $images)
                <div class="row">
                    @foreach ($images as $image)
                    <div class="col-md-3">
                        <div class="thumbnail" style=" width: 220px; ">
                            <a rel="gallery1" class="fancybox" href="{{asset('files/gallery/'.$image->filename)}}">
                            <div class="caption" style="display: none;">

                            </div>

                            <img src="{{asset('files/gallery/small/'.$image->filename)}}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div><br>
                @endforeach
            </div>


        </div></div>


    </div>
    @include("layout.footer")
    <script type="text/javascript">
    //var my_errors = {fio: false, login: false, pass: false};
    $(document).ready(function() {
    $(".fancybox").fancybox();
    });
    </script>
    {!! Html::script('plugins/fancybox/jquery.fancybox.pack.js'); !!}