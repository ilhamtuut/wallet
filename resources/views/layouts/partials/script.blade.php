<script type="text/javascript" src="{{asset('dist/js/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/plugins/jquery/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/plugins/bootstrap/bootstrap.min.js')}}"></script>        
<script type='text/javascript' src='{{asset('dist/js/plugins/icheck/icheck.min.js')}}'></script>        
<script type="text/javascript" src="{{asset('dist/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>                
<script type='text/javascript' src='{{asset('dist/js/plugins/bootstrap/bootstrap-datepicker.js')}}'></script>
<script type="text/javascript" src="{{asset('dist/js/plugins/owl/owl.carousel.min.js')}}"></script>                 
<script type="text/javascript" src="{{asset('dist/js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/settings.js')}}"></script>        
<script type="text/javascript" src="{{asset('dist/js/plugins.js')}}"></script>        
<script type="text/javascript" src="{{asset('dist/js/actions.js')}}"></script>
<script type="text/javascript">
	$('.x-navigation .xn-search').on('click', function (e) {
		if (e.offsetX > e.target.offsetLeft) {
            // click on element
        }else{
			$('#form-search').submit();
       }
	});
</script>