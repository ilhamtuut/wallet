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
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">You haven't got any transactions yet.</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection