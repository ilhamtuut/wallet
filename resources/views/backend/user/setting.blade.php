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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-cog"></span> Account Settings</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><b>Personal</b></h3>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>                                            
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update Email</button>                                   
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3><b>Main password</b></h3>
                        <p>This form allows you to update your main password. This is the password you use to log in.</p>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>                                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" placeholder="Confirm Password">
                            </div>                                            
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update Password</button>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection