@extends('layouts._app',['page'=>'block'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Block #{{$data->index}}</h3>
            </div>
            <div class="panel-body">
                <h2><b>Details</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Hash</td>
                                <td>{{$data->hash}}</td>
                            </tr>
                            <tr>
                                <td>Previous Block</td>
                                <td><a href="{{route('explorer.block', $data->previousHash)}}">{{$data->previousHash}}</a></td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td id="time">-</td>
                            </tr>
                            <tr>
                                <td>Nonce</td>
                                <td>{{number_format($data->nonce)}}</td>
                            </tr>
                            <tr>
                                <td>Transactions</td>
                                <td>{{count($data->transactions)}}</td>
                            </tr>
                            <tr>
                                @php
                                    $out = 0;
                                    foreach ($data->transactions as $key => $value) {
                                        foreach ($value->data->outputs as $key => $values) {
                                            $out += $values->amount;
                                        }
                                    }
                                @endphp
                                <td>Value out</td>
                                <td>{{number_format($out * 0.0000001,7)}}</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>

                <h2><b>Transactions</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Transaction</th>
                                <th>Type</th>
                                <th>From (amount)</th>
                                <th>To (amount)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->transactions as $key => $value)
                                <tr>
                                    <td><a href="{{route('explorer.hash',$value->id)}}">{{substr_replace($value->id, '...', 8, strlen($value->id) - 8 ).substr_replace($value->id, '', 0, strlen($value->id) - 8 )}}</a></td>
                                    <td>{{ucfirst($value->type)}}</td>
                                    <td>
                                    @forelse ($value->data->inputs as $key => $val)
                                        <a href="{{route('explorer.address', $val->address)}}">{{$val->address}}</a> <br>Amount : {{number_format($val->amount * 0.0000001,7)}}
                                    @empty
                                        -
                                    @endforelse
                                    </td>
                                    <td>
                                        @forelse ($value->data->outputs as $key => $val)
                                            <a href="{{route('explorer.address', $val->address)}}">{{$val->address}}</a> <br>Amount : {{number_format($val->amount * 0.0000001,7)}}
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var time = '{{$data->timestamp}}';
    $('#time').html(timeConverter(time*1000));
</script>
@endsection