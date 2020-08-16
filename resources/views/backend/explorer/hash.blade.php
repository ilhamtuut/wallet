@extends('layouts._app',['page'=>'hash'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Transaction bb39b391…657d6579</h3>
            </div>
            <div class="panel-body">
                <h2><b>Details</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Hash</td>
                                <td>bb39b39108ca34cf0a4860e585afca24c71395ff0b162425e5b75daf657d6579</td>
                            </tr>
                            <tr>
                                <td>Number of inputs</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Total in</td>
                                <td>1,862,994.72501976</td>
                            </tr>
                            <tr>
                                <td>Number of outputs   </td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Total out</td>
                                <td>1,862,992.72501976</td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>335 bytes</td>
                            </tr>
                            <tr>
                                <td>Fee</td>
                                <td>2.00000000</td>
                            </tr>
                            <tr>
                                <td>Confirmations</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="label label-danger">New transaction</span></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>

                <h2><b>Inputs</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Index</th>
                                <th>Previous output</th>
                                <th>Amount</th>
                                <th>From address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0</td>
                                <td><a href="{{route('explorer.hash','bb39b39108ca34cf0a4860e585afca24c71395ff0b162425e5b75daf657d6579')}}">1404c85c…5249d942</a></td>
                                <td>1,862,994.72501976</td>
                                <td>
                                    <a href="{{route('explorer.address','A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3')}}">A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3</a>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>

                <h2><b>Outputs</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Index</th>
                                <th>Redeemed at input</th>
                                <th>Amount</th>
                                <th>To address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0</td>
                                <td>Not yet redeemed</td>
                                <td>117.00000000</td>
                                <td>
                                    <a href="{{route('explorer.address','DAczv6AcvLGXRNLDdTma8gQcpVoxjrYvr2')}}">DAczv6AcvLGXRNLDdTma8gQcpVoxjrYvr2</a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Not yet redeemed</td>
                                <td>1,862,875.72501976</td>
                                <td>
                                    <a href="{{route('explorer.address','A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3')}}">A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3</a>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection