@extends('layouts._app',['page'=>'wallet'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">List Wallets</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-credit-card"></span> List Wallets</h3>
            </div>
            <div class="panel-body">
                <form action="{{route('administrator.wallet.list')}}" method="GET" id="form_search">
                    <div class="col-md-3 pull-right mb">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon" onclick="event.preventDefault();
                                             document.getElementById('form_search').submit();"><i class="fa fa-search"></i></span>
                            </div>
                        </div>  
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th width="3%" class="text-center">#</th>
                                <th>Name</th>
                                <th>Label</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $value)
                                <tr>
                                    <td width="3%" class="text-center">{{++$i}}</td>
                                    <td>{{ucfirst($value->user->name)}}</td>
                                    <td>{{$value->label}}</td>
                                    <td>{{$value->address}} <span class="label label-info" onclick="copyToClipboard('{{$value->address}}')"><i class="fa fa-copy"></i> Copy Address</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available in table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> 
                    <div class="pull-right">
                        {{$data->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection