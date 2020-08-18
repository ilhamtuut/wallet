@extends('layouts._app',['page'=>'address'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Address A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3</h3>
            </div>
            <div class="panel-body">
                <div class="row mb">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Hash</td>
                                        <td>A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3</td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td>3,721,723.32246807 GLP</td>
                                    </tr>
                                    <tr>
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
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{$qrCode}}" alt="qrcode">
                        <h5><b>{{$address}}</b></h5>
                        <button class="btn btn-success">Copy Address <i class="fa fa-copy"></i></button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h2><b>Transactions</b></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Transaction</th>
                                        <th>Block</th>
                                        <th>Time</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{route('explorer.hash','26111e49…10016e1f')}}">26111e49…10016e1f</a></td>
                                        <td><a href="{{route('explorer.block','3336997')}}">3336997</a></td>
                                        <td>2020-08-01 00:54:51 -0700</td>
                                        <td>- 1,869,530.72501976</td>
                                        <td>GLP</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{route('explorer.hash','26111e49…10016e1f')}}">26111e49…10016e1f</a></td>
                                        <td><a href="{{route('explorer.block','3336997')}}">3336997</a></td>
                                        <td>2020-08-01 00:54:51 -0700</td>
                                        <td>+ 1,869,530.72501976</td>
                                        <td>GLP</td>
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