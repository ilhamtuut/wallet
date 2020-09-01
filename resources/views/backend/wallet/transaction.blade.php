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
                <p>The table below shows you the last 10 transactions.</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Hash</th>
                                {{-- <th>Status</th> --}}
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $value)
                                <tr>
                                    <td><a href="javascript:void();">{{$value->hash}}</a></td>
                                    <td class="text-right">{{number_format($value->amount,7)}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">You haven't got any transactions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> 
                    {{$data->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection