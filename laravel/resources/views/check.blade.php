@include("layout.header")
@include("layout.navbar")
<div class="containter" style="padding-top:100px; min-height:100px;background-color: {{Setting::get('config.sitecolor', '#FD5F6F')}};">
    <div class="container">
        <div class="jumbotron" style="padding: 0px;">
            <div class="container" style=" color: white; ">
                <h2>Информация о заказе</h2>
                <p>На данной странице Вы можете отследить и оплатить заказ</p>
            </div>
        </div>
    </div>
</div>
<div class="row" style="background-color: #F7F7F7;">
    <div class="col-md-6 col-md-offset-3">
        <br><br><br><br>
        <h4><center>Введите Ваш код заказа</center></h4>
        <br>
        {!! Form::open(array('url' => 'checkQuery', 'method'=> 'GET', 'class'=>'form-horizontal')) !!}
        <div class="input-group">
            {!! Form::text('code', null, array('class'=>'form-control', 'placeholder'=>'Код заказа')) !!}
            <span class="input-group-btn">
            {!! HTML::decode(Form::button('Проверить', array('type' => 'submit', 'class'=>'btn btn-default'))) !!}
            </span>
        </div>
        {!! Form::close(); !!}
    </div>
    <div class="col-md-offset-1 col-md-10">
        <hr><br><br>
        @if ($findflag)
        @include("orderCheck")
        <br><br>
        @endif
    </div>
</div>
@include("layout.footer")