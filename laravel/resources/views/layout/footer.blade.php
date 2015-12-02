<div class="footer" style=" padding: 20px; background-color: #2C2C2C; color: #BBB; height:150px;">
    <div class="col-sm-4">
        <h3>Наши контакты</h3>
        <p class="text-muted credit "><small>

        Tel: {{Setting::get('integration.tel', 'xxx')}}<br>
        Skype: {{Setting::get('integration.skype', 'xxx')}}
        </small></p>
    </div>
    <div class="col-sm-4">
        <h3><center>Мы популярны</center></h3>
        <p class="text-muted credit "> <small><center>
        <a href="{{Setting::get('integration.habr', 'xxx')}}" class="btn btn-social-icon btn-sm btn-default"><span aria-hidden="true" class="icon-HabraHabr"></span></a>
        <a href="{{Setting::get('integration.insta', 'xxx')}}" class="btn btn-social-icon btn-sm btn-instagram"><i class="fa fa-instagram"></i></a>
        <a href="{{Setting::get('integration.youtube', 'xxx')}}" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-youtube-play"></i></a>
        <a href="{{Setting::get('integration.twitter', 'xxx')}}" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter"></i></a>
        </center>
        </small></p>
    </div>
    <div class="col-sm-4">

        <p class="text-right">
        <br>Developed by
        <br><a href="http://rustem.com.ua/"><img src="dist/img/rustem_logo.png"></a>
        </p>
    </div>
</div>
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
<!-- jQuery UI 1.11.4 -->
<!-- jQuery 2.1.4 -->
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
{!! Html::script('dist/js/jquery-ui.min.js'); !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('bootstrap/js/bootstrap.min.js'); !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js'); !!}
{!! Html::script('plugins/touchspin/jquery.bootstrap-touchspin.min.js'); !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js'); !!}
<script type="text/javascript">
//var my_errors = {fio: false, login: false, pass: false};
$(document).ready(function() {
var CSRF_TOKEN='{!! csrf_token() !!}';
var SYS_URL='{!! URL::to('/'); !!}';
$.ajaxSetup ({
    // Disable caching of AJAX responses
    cache: false
});
    $.ajaxSetup({
        // Disable caching of AJAX responses
        cache: false,
        headers: { 'X-CSRF-TOKEN' : CSRF_TOKEN }
    });
$(".select2").select2();
function tspin() {
$("input#demo").TouchSpin({
min: 1, // Minimum value.
max: 10, // Maximum value.
boostat: 1, // Boost at every nth step.
postfix: 'шт', // Text after the input.
step: 1, // Incremental/decremental step on up/down change.
stepinterval: 1, // Refresh rate of the spinner in milliseconds.
stepintervaldelay: 500 // Time in milliseconds before the spinner starts to spin.
});
}
tspin();
$(window).scroll(function() {
$('.thumbnail').hover(
        function(){
            $(this).find('.caption').fadeIn(250)
        },
        function(){
            $(this).find('.caption').fadeOut(205)
        }
    );
if ($(this).scrollTop() > 1){
    $('nav').addClass("sticky");
    $('#logo').addClass("sticky_logo");
    
}
else{
    $('nav').removeClass("sticky");
    $('#logo').removeClass("sticky_logo");
        //$('#logo').animate({height:100},200);
}
});
function show_cart() {
    $.ajax({
                                    type: 'GET',
                                    url: SYS_URL+'/basket',
                                    data: { _token : CSRF_TOKEN},
                                    success : function(html) {
                                        $('#basket').html(html);
                                        tspin();
                                        $('#backet_form').modal('show');
                                    }
                                    //dataType: 'html',
                                });
}
//basket_purchase
$('body').on("change", "input#demo", function(event) {
        event.preventDefault();
        var data={ _token : CSRF_TOKEN,
        qty: $(this).val() };
$.ajax({
                                    type: 'POST',
                                    url: SYS_URL+'/basket/update/'+$(this).attr('data-id'),
                                    data: data,
                                    success : function() {
                                            $.ajax({
                                    type: 'GET',
                                    url: SYS_URL+'/basket',
                                    data: { _token : CSRF_TOKEN},
                                    success : function(html) {
                                        $('#basket').html(html);
                                        tspin();
                                        //$('#backet_form').modal('show');
                                    }
                                    //dataType: 'html',
                                });
                                        }
                                    });
    });
//remove_item
$('body').on('click', 'button#remove_item', function(event) {
        event.preventDefault();
        var data={ _token : CSRF_TOKEN,
        _method: 'DELETE'
};
                                $.ajax({
                                    type: 'POST',
                                    url: SYS_URL+'/basket/remove/'+$(this).attr('data-id'),
                                    data: data,
                                    success : function() {
                                        show_cart();
                                        }
                                    });
});
//empty_cart
$('body').on('click', 'button#empty_cart', function(event) {
        event.preventDefault();
        var data={ _token : CSRF_TOKEN,
        _method: 'DELETE'
};
                                $.ajax({
                                    type: 'POST',
                                    url: SYS_URL+'/basket/empty',
                                    data: data,
                                    success : function() {
                                        $('#backet_form').modal('hide');
                                        }
                                    });
});
$('body').on('click', 'a#pay', function(event) {
        event.preventDefault();

//var data = $(this).sortable('serialize');
//var data_res = data + '&' + $.param(def_data);
console.log(data);
        // POST to server using $.post or $.ajax
var data={ _token : CSRF_TOKEN,
        _method: 'PATCH'
};
var product=$(this).attr('data-id');
                                $.ajax({
                                    type: 'POST',
                                    url: SYS_URL+'/basket/add/'+product,
                                    data: data,
                                    success : function() {
                                        
                                            show_cart();
                    
                                    }
                                    //dataType: 'html',
                                });
});
});
</script>
</body>
</html>