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
                                <th>Transactions</th>
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
            url: "{{route('blocks')}}",
            type: "GET",
            contentType: "application/json",
            success: function (data) {
                if(data.length > 0 ){
                    $('#body-block').children().remove();
                    $.each(data, function (i,item) {
                        $('#body-block').append(
                            '<tr>'+
                                '<td><a href="{{url('block')}}/'+item.hash+'">'+ item.hash +'</a></td>'+
                                '<td>'+ item.timestamp +'</td>'+
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
            url: "{{route('transactions')}}",
            type: "GET",
            contentType: "application/json",
            success: function (data) {
                if(data.length > 0 ){
                    $('#body-transactions').children().remove();
                    $.each(data, function (i,item) {
                        $('#body-transactions').append(
                            '<tr>'+
                                '<td><a href="{{url('tx')}}/'+item.id+'">'+ item.id +'</a></td>'+
                                '<td>'+ item.input.amount +' GLP</td>'+
                            '</tr>');
                    });
                }else{
                    $('#body-transactions').append('<tr><td colspan="2" class="text-center">No transactions.</td></tr>');
                }
            },
            cache: false
        });
    }
</script>
@endsection