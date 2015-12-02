@include("layout.header")
<!-- iCheck -->
{!! Html::style('plugins/iCheck/square/blue.css'); !!}
@include("layout.navbar")
<div class="containter" style="padding-top:100px; min-height:100px;background-image: url(dist/img/geometic-bg-white.jpg);">
    <div class="container">
        <div class="col-md-4">
            <div class="jumbotron" style="padding: 0px;">
                <div class="container" style=" color: rgba(0, 0, 0, 0.68); ">
                    <h2>Благодарим Вас!</h2>
                    <p>Ваш заказ оформлен</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="    background-color: white;">
    <div class="containter" style="padding-top:50px; ">
        <div class="container">
            <div class="row" style="padding-bottom:20px;">
                <div class="row" style="padding-bottom:20px;">

                    <div class="col-md-offset-2 col-8 col-sm-8 col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">Информация о заказе</div>
                            <div class="panel-body">
                                <p class="lead" style="text-align:right; margin-bottom:-10px;">Код заказа: <strong>{{$orderCode}}</strong>
                                </p>
                                <p class="help-block" style="text-align:right;">
                                <small>По данному коду, Вы сможете отслеживать заказ.
                                </small>
                                </p>

                                <div class="col-sm-6">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="active" colspan="2"><small><center>Получатель</center></small></td>
                                                </tr>
                                                <tr>
                                                    <td><small>Имя:</small></td>
                                                    <td><small>{{$client->name}}</small></td>
                                                </tr>
                                                <tr>
                                                    <td><small>Моб:</small></td>
                                                    <td><small>{{$client->tel}}</small></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-sm-6">


                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="active" colspan="2"><small><center>Доставка</center></small></td>
                                                </tr>
                                                <tr>
                                                    <td><small>Тип:</small></td>
                                                    <td><small>{{$delivery_type}}</small></td>
                                                </tr>


                                                <tr>
                                                    <td><small>Адрес:</small></td>
                                                    <td><small>{!! $order->delivery_city !!}, {!! $order->delivery_np !!} {!! $order->delivery_adr !!}</small></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>


                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><small>Оплата:</small></td>
                                                    <td><small>{{$pay_type}}</small></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>







                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="active">

                                                    <th style=" width: 30px; "><center><small>#</small></center></th>
                                                    <th><center><small>Название</small></center></th>
                                                    <th style=" width: 50px; "><center><small>К-во</small></center></th>
                                                    <th style=" width: 60px; "><center><small>Цена</small></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; ?>
                                                @foreach ($orderItems as $row)
                                                @if ($row->product_id == 'np')
                                                <?php $totalCount=$totalCount-1; ?>
                                                <tr id="tr_" class="warning">

                                                    <td style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                    <td style=" vertical-align: inherit; " colspan="2"><small>Доставка "до дверей" (курьер Новой Почты)</small></td>

                                                    <td id="price_" name="cost" val="" colspan="2" style=" vertical-align: inherit; "><center><small>{!! Setting::get('product.np') !!}</small></center></td>

                                                </tr>
                                                @elseif ($row->product_id == 'gift')
                                                <tr id="tr_" class="warning">

                                                    <td style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                    <td style=" vertical-align: inherit; "><small>Подарочная упаковка</small></td>
                                                    <td style=" vertical-align: inherit; "><small><center>{{$row->qty}}</center></small></td>
                                                    <td style=" vertical-align: inherit; "><center><small>{!! (Setting::get('product.gift')*$row->qty) !!}</small></center></td>

                                                </tr>
                                                @elseif ($row->product_id == 'fast')
                                                <?php $totalCount=$totalCount-1; ?>
                                                <tr id="tr_" class="warning">

                                                    <td style=" vertical-align: inherit; "><center><small>{{$i}}</small></center></td>
                                                    <td style=" vertical-align: inherit; " colspan="2"><small>Быстрая доставка</small></td>

                                                    <td style=" vertical-align: inherit; "><center><small>{!! Setting::get('product.fast') !!}</small></center></td>
                                                </tr>
                                                @else
                                                <tr>

                                                    <td style=" vertical-align: inherit; "><small><center>{{$i}}</center></small></td>
                                                    <td style=" vertical-align: inherit; "><small>{{$row->product->name}}</small></td>
                                                    <td style=" vertical-align: inherit; "><small><center>{{$row->qty}}</center></small></td>
                                                    <td style=" vertical-align: inherit; "><small><center>{!! ($row->product->price*$row->qty) !!}</center></small></td>

                                                </tr>
                                                @endif
                                                <?php $i++ ?>
                                                @endforeach

                                                <tr class="active">
                                                    <td class="text-right" colspan="2"><b><small>Всего товара:</small></b></td>
                                                    <td class="text-left"><b><small><center>{{$totalCount}}</center></small></b></td>
                                                    <td><b><div id="total_summ"><small><center>{{$totalSumm}}</center></small></div></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <small>
                                    <p class="text-center text-danger">Краткая инструкция</p>
                                    <ul>
                                        <li>Вам необходимо будет оплатить заказ в любом отделении или терминале ПриватБанка. Со списком отделений Вы можете ознакомиться <a href="http://privatbank.ua/map/" target="_blank">тут</a>.</li>
                                        <li>Только после поступления денег, Ваш заказ будет обработан.</li>
                                        <li>На email: {{$client->email}} прийдёт письмо с такой же информацией по Вашему заказу.</li>
                                        <li>Данный товар является индивидуальной ручной работой, а значит <b>обмену и возврату не подлежит</b>.</li>
                                    </ul></small>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                    <button id="reg_purchase" type="submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#privat24_modal">Оплатить в Приват24!</button>
                                    <button id="reg_purchase" type="submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#liqpay_modal">Оплатить в LiqPay!</button>
                                    <button id="reg_purchase" type="submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#cardmodal">Оплатить на карту!</button>
                                    </center>
                                    <div class="modal fade" id="privat24_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Оплата через Приват24</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <center><p>
                                                        После нажатия кнопки, Вы будете перенаправлены на сайт системы Приват24.</p>
                                                        <p class="text-muted">Нажмите на кнопку для оплаты через систему Приват24.<br><br>
                                                        <div class="row">
                                                            <div class="col-md-offset-2 col-md-8">
                                                                <form action="https://api.privatbank.ua/p24api/ishop" method="POST">
                                                                    <input type="hidden" name="amt" value="{{$totalSumm}}"/>
                                                                    <input type="hidden" name="ccy" value="UAH" />
                                                                    <input type="hidden" name="merchant" value="{!! Setting::get('money.privatId') !!}" />
                                                                    <input type="hidden" name="order" value="{{$orderCode}}" />
                                                                    <input type="hidden" name="details" value="Credit closing by {{$orderCode}}" />
                                                                    <input type="hidden" name="ext_details" value="{{$orderCode}}" />
                                                                    <input type="hidden" name="pay_way" value="privat24" />
                                                                    <input type="hidden" name="return_url" value="{{URL::to('/payment/privat24')}}" />
                                                                    <input type="hidden" name="server_url" value="{{URL::to('/payment/privat24')}}" />
                                                                    <button type="submit" class="btn btn-success btn-lg btn-block">Оплатить через Privat24.</button>
                                                                </form>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </p>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            </div>
                                            </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <div class="modal fade" id="liqpay_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Оплата через LiqPay</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <center><p>
                                                                После нажатия кнопки, Вы будете перенаправлены на сайт системы LiqPay.</p>
                                                                <p class="text-muted">Нажмите на кнопку для оплаты через систему LiqPay.<br><br>
                                                                <div class="row">
                                                                    <div class="col-md-offset-2 col-md-8">
                                                                        <form  accept-charset="utf-8" action="https://www.liqpay.com/api/pay" method="POST" />
                                                                            <input type="hidden" name="public_key" value="{!! Setting::get('money.liqpayId') !!}" />
                                                                            <input type="hidden" name="amount" value="{!! ($totalSumm+($totalSumm*0.05)) !!}" />
                                                                            <input type="hidden" name="currency" value="UAH" />
                                                                            <input type="hidden" name="description" value="Credit closing by {{$orderCode}}" />
                                                                            <input type="hidden" name="type" value="buy" />
                                                                            <input type="hidden" name="pay_way" value="card,delayed" />
                                                                            <input type="hidden" name="language" value="ru" />
                                                                            <input type="hidden" name="result_url" value="{{URL::to('/payment/liqpay')}}" />
                                                                            <input type="hidden" name="server_url" value="{{URL::to('/payment/liqpay')}}" />
                                                                            <button type="submit" class="btn btn-success btn-lg btn-block">Оплатить через LiqPay.</button>
                                                                            <small>(+5% комиссия)</small>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </p>
                                                                </center>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                        </div>
                                                        </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        <div class="modal fade" id="cardmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title" id="myModalLabel">Оплата на кредитную карту</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <center><p>
                                                                            Прежде чем отправить Вам заказ, мы ждём от Вас оплаты.</p>
                                                                            <p class="lead">В любом отделении или терминале ПриватБанка <br> Вам нужно оплатить <strong class="text-danger">{{$totalSumm}}</strong> грн на кредитную карту,<br> номер: <strong class="text-danger">{{Setting::get('money.card')}}</strong> ({{Setting::get('money.cardOwner')}})
                                                                            </p>
                                                                        </center></div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                                    </div>
                                                                    </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include("layout.footer")
                                <!-- iCheck -->
                                {!! Html::script('plugins/iCheck/icheck.min.js'); !!}
                                <script type="text/javascript">
                                $(document).ready(function() {
                                var CSRF_TOKEN='{!! csrf_token(); !!}';
                                var SYS_URL='{!! URL::to('/'); !!}';
                                });
                                </script>