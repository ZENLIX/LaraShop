<nav class="navbar navbar-default navbar-fixed-top" style="    border-bottom: 1px #EEEEEE solid;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! URL::to('/') !!}"><img src="{{$logoMain or Null}}" class="img-def" id="logo">
            </a>
        </div>
        <div id="navbar2" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="{!! URL::to('/catalog') !!}"><i class="fa fa-gift"></i> Каталог</a></li>
                <li ><a href="{!! URL::to('/gallery') !!}"><i class="fa fa-camera"></i> Галерея</a></li>
                <li ><a href="{!! URL::to('/info') !!}"> <i class="fa fa-info-circle"></i> Информация</a></li>
                <li ><a href="{!! URL::to('/check') !!}"><i class="fa fa-paper-plane"></i> Отследить </a></li>
                <li ><a href="{!! URL::to('/purchase') !!}"><i class="fa fa-shopping-cart"></i> Оформить заказ
                    @if ($totalNavLabel != 0)
                    <span class='badge' style="background-color:#FD5F6F;">{{$totalNavLabel}} </span>
                    @endif
                </a></li>


            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</nav>
<!--nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="dist/img/logo.png">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li  ><a href="shop.php"><i class="fa fa-gift"></i> Каталог</a></li>
                    <li ><a href="gallery.php"><i class="fa fa-camera"></i> Галерея</a></li>
                    <li ><a href="info.php"> <i class="fa fa-info-circle"></i> Информация</a></li>
                    <li ><a href="zakaz.php"><i class="fa fa-paper-plane"></i> Отследить </a></li>
                    <li ><a href="purchase.php"><i class="fa fa-shopping-cart"></i> Оформить заказ </a> </li>
                    
                    
            </ul>
            </div>
    </div>
</nav-->
<!--nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #E2E2E2; ">
<div class="container-fluid">
    
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand pull-left" href="index.php" style="padding: 0px 15px;">
            <img src="dist/img/logo.png" class="img-def" id="logo">
        </a>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
        <ul class="nav navbar-nav navbar-right">
                <li  ><a href="shop.php"><i class="fa fa-gift"></i> Каталог</a></li>
                <li ><a href="gallery.php"><i class="fa fa-camera"></i> Галерея</a></li>
                <li ><a href="info.php"> <i class="fa fa-info-circle"></i> Информация</a></li>
                <li ><a href="zakaz.php"><i class="fa fa-paper-plane"></i> Отследить </a></li>
                <li ><a href="purchase.php"><i class="fa fa-shopping-cart"></i> Оформить заказ </a> </li>
                
                
        </ul>
    </div>
</div>
</nav-->