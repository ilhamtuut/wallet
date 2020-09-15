@extends('layouts._app',['page'=>'users'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">List Users</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Well done!</strong> {{ session('success') }}
            </div>
        @endif
        @if (Session::has('failed'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Oh snap!</strong> {{ session('failed') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>Oh snap!</strong> Failed
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-users"></span> List Users</h3>
            </div>
            <div class="panel-body">
                <form action="{{route('administrator.users.list')}}" method="GET" id="form_search">
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
                                <th>Email</th>
                                <th>Verified At</th>
                                <th class="text-center">Is Block</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $value)
                                <tr>
                                    <td width="3%" class="text-center">{{++$i}}</td>
                                    <td>{{ucfirst($value->name)}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{($value->email_verified_at) ? $value->email_verified_at : '-'}}</td>
                                    <td class="text-center">
                                        @if($value->is_block)
                                            <span class="label label-success">YES</span>
                                        @else
                                            <span class="label label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle">Action <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('administrator.users.block',$value->id)}}">{{($value->is_block) ? 'Unblock' : 'Blocked'}}  </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data available in table</td>
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