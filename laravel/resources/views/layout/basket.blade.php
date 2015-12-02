<div class="modal fade" id="backet_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ваша корзина

                </h4>
            </div>
            <div class="modal-body" style=" padding-bottom: 0px; ">
                <div id="basket"></div>


            </div>
            <div class="modal-footer">
                <div style="float: left;">
                    <button id="empty_cart" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> очистить корзину</button>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                <a href="{{ URL::to('/purchase')}}" class="btn btn-pay2" >Оформить заказ</a>
            </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->