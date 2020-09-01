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
<script type='text/javascript' src='{{asset('dist/js/plugins/jquery-validation/jquery.validate.js')}}'></script>  
<script src="{{ asset('dist/captcha/longbow.slidercaptcha.js')}}"></script>
<script type='text/javascript' src='{{asset('dist/js/plugins/noty/jquery.noty.js')}}'></script>
<script type='text/javascript' src='{{asset('dist/js/plugins/noty/layouts/topRight.js')}}'></script>            
<script type='text/javascript' src='{{asset('dist/js/plugins/noty/themes/default.js')}}'></script>
<script type="text/javascript">
	$('.x-navigation .xn-search').on('click', function (e) {
		if (e.offsetX > e.target.offsetLeft) {
            // click on element
        }else{
			$('#form-search').submit();
       }
	});

	function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp);
        if(a.isValid()){
            var year = a.getFullYear();
            var month = a.getMonth() + 1;
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            if(date < 10){
                date = '0' + date;
            }
            if(month < 10){
                month = '0' + month;
            }

            if(hour < 10){
                hour = '0' + hour;
            }

            if(min < 10){
                min = '0' + min;
            }

            if(sec < 10){
                sec = '0' + sec;
            }
            var time = year + '-' + month + '-' + date + ' ' + hour + ':' + min + ':' + sec ;
        }else{
            var time = '-';
        }
        return time;
    }

    Date.prototype.isValid = function () {
        return this.getTime() === this.getTime();
    }; 

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function capitalizeFirstLetter(string) {
	  return string.charAt(0).toUpperCase() + string.slice(1);
	}
</script>