@extends('layouts._app',['page'=>'home'])
@section('content')
<div class="row mt">
    <div class="col-md-4">
        <div class="widget widget-default widget-no-subtitle">
            <div class="widget-big-int"><span class="num-count">{{$glp_btc}}</span> BTC/GLP</div>                   
            <div class="widget-subtitle">Last estimated price</div>                         
        </div>                        
    </div>
    <div class="col-md-4">
        <div class="widget widget-default widget-no-subtitle">
            <div class="widget-big-int"><span class="num-count">4,381</span></div>                            
            <div class="widget-subtitle">Current difficulty</div>                         
        </div>                        
    </div>
    <div class="col-md-4">
        <div class="widget widget-default widget-no-subtitle">
            <div class="widget-big-int"><span class="num-count">4,381</span></div>                            
            <div class="widget-subtitle">Blocks in chain</div>                         
        </div>                    
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Latest blocks</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Block</th>
                                <th>Time</th>
                                <th>Nonce</th>
                                <th>Difficulty</th>
                            </tr>
                        </thead>
                        <tbody id="body-block">
                            <tr>
                                <td colspan="4" class="text-center"><i class="fa fa-spinner fa-spin"></i></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Latest transactions</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Hash</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="body-transactions">
                            <tr>
                                <td colspan="2" class="text-center"><i class="fa fa-spinner fa-spin"></i></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('document').ready(function () {
        setTimeout(loadData(), 1000);
    });

    function loadData(){
        $.ajax({
            url: "https://dashboard.greenlineproject.tech/blocks",
            type: "GET",
            contentType: "application/json",
            success: function (data) {
                $('#body-block').children().remove();
                if(data.length > 0 ){
                    $.each(data, function (i,item) {
                        $('#body-block').append(
                            '<tr>'+
                                '<td><a href="{{url('block')}}/'+item.hash+'">'+ item.hash +'</a></td>'+
                                '<td>'+ timeConverter(item.timestamp) +'</td>'+
                                '<td>'+ item.nonce +'</td>'+
                                '<td>'+ item.difficulty +'</td>'+
                            '</tr>');
                    });
                }else{
                    $('#body-block').append('<tr><td colspan="4" class="text-center">No blocks.</td></tr>');
                }
            },
            cache: false
        });

        $.ajax({
            url: "https://dashboard.greenlineproject.tech/transactions",
            type: "GET",
            contentType: "application/json",
            success: function (data) {
                $('#body-transactions').children().remove();
                if(data.length > 0 ){
                    $.each(data, function (i,item) {
                        $('#body-transactions').append(
                            '<tr>'+
                                '<td><a href="{{url('tx')}}/'+item.id+'">'+ item.id +'</a></td>'+
                                '<td>'+ addCommas(item.input.amount) +' GLP</td>'+
                            '</tr>');
                    });
                }else{
                    $('#body-transactions').append('<tr><td colspan="2" class="text-center">No transactions.</td></tr>');
                }
            },
            cache: false
        });
    }

    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp);
        if(a.isValid()){
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
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
</script>
@endsection