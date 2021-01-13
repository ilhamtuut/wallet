@extends('layouts._app',['page'=>'transactions'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Transactions</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-tasks"></span> Transactions</h3>
            </div>
            <div class="panel-body">
                <p>The table below shows you the last 100 transactions. <br> <span class="text-grn">{{$address}}</span></p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Hash</th>
                                {{-- <th>Status</th> --}}
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="body-transactions">
                            {{-- @forelse($data as $value)
                                <tr>
                                    <td><a href="{{route('explorer.hash',$value->hash)}}">{{$value->hash}}</a></td>
                                    <td class="text-right">{{number_format($value->amount,7)}}</td>
                                </tr>
                            @empty --}}
                                <tr>
                                    <td colspan="2" class="text-center"><i class="fa fa-spinner fa-spin"></i></td>
                                </tr>
                            {{-- @endforelse --}}
                        </tbody>
                    </table> 
                    {{-- {{$data->render()}} --}}
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
        var address = '{{$address}}'
        var data = @json(\App\Facades\Glp::detailAddress($address));
        $('#body-transactions').children().remove();
        if(data.data.length > 0 ){
            $.each(data.data, function (i,item) {
                if(item.fromAddress == address){
                    var label = '<span class="text-danger">- </span>'
                }else{
                    var label = '<span class="text-grn">+ </span>'
                }
                $('#body-transactions').append(
                    '<tr>'+
                        '<td><a class="text-grn" href="{{url('tx')}}/'+item.txid+'">'+ item.txid +'</a></td>'+
                        '<td class="text-right">'+ label + addCommas(parseFloat(item.amount * 0.0000001).toFixed(7)) +'</td>'+
                    '</tr>');
            });
        }else{
            $('#body-transactions').append('<tr><td colspan="2" class="text-center">No transactions.</td></tr>');
        }
    }
</script>
@endsection