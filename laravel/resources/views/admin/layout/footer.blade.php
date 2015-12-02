<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <small class="text-muted"><b>Version</b> 1.0.0</small>
    </div>
    <small class="text-muted"><strong><a href="http://rustem.com.ua">LaraShop</a> &copy; 2015.</strong> All rights
    reserved.
    </small>
</footer>
</div>
<!-- ./wrapper -->
<script type="text/javascript">

var CSRF_TOKEN='{!! csrf_token() !!}';
var SYS_URL='{!! URL::to('/'); !!}';
</script>
<!-- jQuery 2.1.4 -->
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
<!-- jQuery UI 1.11.4 -->
<!-- jQuery 2.1.4 -->
{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js'); !!}
{!! Html::script('dist/js/jquery-ui.min.js'); !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('bootstrap/js/bootstrap.min.js'); !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js'); !!}
<!-- AdminLTE App -->
{!! Html::script('dist/js/app.min.js'); !!}
<!-- trumbowyg -->
{!! Html::script('plugins/trumbowyg/trumbowyg.min.js'); !!}
<!-- DataTables -->
{!! Html::script('plugins/datatables/jquery.dataTables.min.js'); !!}
{!! Html::script('plugins/datatables/dataTables.bootstrap.min.js'); !!}
{!! Html::script('plugins/autosize/autosize.min.js'); !!}
{!! Html::script('plugins/bootbox/bootbox.min.js'); !!}
{!! Html::script('plugins/touchspin/jquery.bootstrap-touchspin.min.js'); !!}
<!-- AdminLTE App -->
{!! Html::script('dist/js/core.js'); !!}
<!-- Page script -->
<script>
$(function () {
    autosize($('textarea'));
    //Initialize Select2 Elements
    $(".select2").select2();
$('[rel=tooltip]').tooltip({container: 'body'});
    $('.trumbowyg').trumbowyg({
    mobile: true,
    tablet: true,
    removeformatPasted: true,
    btns: ['formatting',
    '|', 'btnGrp-design',
    '|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull',
    '|', 'link',
    '|', 'btnGrp-lists',
    '|', 'horizontalRule']
});
});
</script>