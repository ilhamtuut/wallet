@extends('layouts._app',['page'=>'address'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" style="line-break: anywhere;">Address {{$address}}</h3>
            </div>
            <div class="panel-body">
                <div class="row mb">
                    <div class="col-md-7">
                        <div class="text-center">
                            <img class="mb" src="{{$qrCode}}" alt="qrcode"> <br>
                            <a href="{{route('login')}}" class="btn btn-primary mb">Send Greenline Project Coin</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Hash</td>
                                        <td>{{$address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td>{{$balance}} GLP</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Transactions received</td>
                                        <td>23,919</td>
                                    </tr>
                                    <tr>
                                        <td>Received</td>
                                        <td>55,878,421,136.28500608 GLP</td>
                                    </tr>
                                    <tr>
                                        <td>Transactions sent</td>
                                        <td>23,917</td>
                                    </tr>
                                    <tr>
                                        <td>Sent</td>
                                        <td>55,874,699,412.96253801 GLP</td>
                                    </tr> --}}
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="col-md-5 text-center">
                        {{-- <img src="{{$qrCode}}" alt="qrcode"> <br>
                        <button class="btn btn-success mb">Send Greenline Project Coin</button> --}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h2><b class="text-white">Transactions</b></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Transaction</th>
                                        {{-- <th>Block</th> --}}
                                        {{-- <th>Time</th> --}}
                                        <th class="text-right">Amount</th>
                                        <th>Currency</th>
                                    </tr>
                                </thead>
                                <tbody id="body-transactions">
                                    <tr>
                                        <td colspan="3" class="text-center"><i class="fa fa-spinner fa-spin"></i></td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
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
        var data = @json(\App\Facades\Glp::historyWallet($address));
        $('#body-transactions').children().remove();
        if(data.length > 0 ){
            $.each(data, function (i,item) {
                $('#body-transactions').append(
                    '<tr>'+
                        '<td><a class="text-grn" href="{{url('tx')}}/'+item.transaction+'">'+ item.transaction +'</a></td>'+
                        '<td class="text-right">'+ addCommas(parseFloat(item.amount * 0.0000001).toFixed(7)) +'</td>'+
                        '<td>GLP</td>'+
                    '</tr>');
            });
        }else{
            $('#body-transactions').append('<tr><td colspan="3" class="text-center">No transactions.</td></tr>');
        }
    }
</script>
@endsection