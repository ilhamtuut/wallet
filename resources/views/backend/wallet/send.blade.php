@extends('layouts._app',['page'=>'send'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Send</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-arrow-circle-up"></span> Send</h3>
            </div>
            <div class="panel-body">
                <p>Use the form below to send coins to another address.</p>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Destination</label>
                        <input type="text" class="form-control" placeholder="Destination">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Amount</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="0.00">
                            <span class="input-group-addon">GLP</span>
                        </div>                                            
                    </div>
                    <div class="form-group">
                        <label class="control-label">Network fee</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="0.00" readonly>
                            <span class="input-group-addon">GLP</span>
                        </div>                                            
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Send Money</button>                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection