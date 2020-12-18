@extends('layouts._app',['page'=>'hash'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Transaction {{$data->id}}</h3>
            </div>
            <div class="panel-body">
                <h2><b class="text-white">Details</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Hash</td>
                                <td>{{$data->id}}</td>
                            </tr>
                            <tr>
                                <td>Number of inputs</td>
                                <td>{{count($data->data->inputs)}}</td>
                            </tr>
                            <tr>
                                <td>Total in</td>
                                <td>{{number_format($in * 0.0000001,7)}}</td>
                            </tr>
                            <tr>
                                <td>Number of outputs   </td>
                                <td>{{count($data->data->outputs)}}</td>
                            </tr>
                            <tr>
                                <td>Total out</td>
                                <td>{{number_format($out * 0.0000001,7)}}</td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>{{number_format($size)}} bytes</td>
                            </tr>
                            {{-- <tr>
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
                            </tr> --}}
                        </tbody>
                    </table> 
                </div>

                <h2><b class="text-white">Inputs</b></h2>
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
                            @forelse($data->data->inputs as $key =>$value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td><a class="text-grn" href="{{route('explorer.hash',$value->transaction)}}">{{$value->transaction}}</a></td>
                                    <td>{{number_format($value->amount * 0.0000001,7)}}</td>
                                    <td>
                                        <a class="text-grn" href="{{route('explorer.address',$value->address)}}">{{$value->address}}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">-</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> 
                </div>

                <h2><b class="text-white">Outputs</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Index</th>
                                <th>Amount</th>
                                <th>To address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->data->outputs as $key => $value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{number_format($value->amount * 0.0000001,7)}}</td>
                                    <td>
                                        <a class="text-grn" href="{{route('explorer.address',$value->address)}}">{{$value->address}}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">-</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection