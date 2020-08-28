@extends('layouts._app',['page'=>'setting'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Account Settings</li>
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
                <h3 class="panel-title"><span class="fa fa-cog"></span> Account Settings</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><b>Personal</b></h3>
                        <form action="{{route('account.updateName')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Name">
                                </div>                                            
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Name</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h3><b>Main password</b></h3>
                        <p>This form allows you to update your main password. This is the password you use to log in.</p>
                        <form action="{{route('account.updatePassword')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>                                            
                            </div>
                            <div class="form-group">
                                <label class="control-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>                                            
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update Password</button>                          
                            </div>
                        </form>
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