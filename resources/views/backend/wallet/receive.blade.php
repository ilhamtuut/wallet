@extends('layouts._app',['page'=>'receive'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Receive</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-arrow-circle-down"></span> Receive</h3>
            </div>
            <div class="panel-body">
                <p>These are your GLP addresses which you can use to receive money.</p>
                <button class="btn btn-success mb"><i class="fa fa-plus"></i> New Address</button>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Address</th>
                                <th>Label</th>
                                <th>Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DB8ohTBE4nTccvbo4EUhxEEgEaRkKxP1qW</td>
                                <td>My Wallet</td>
                                <td>0.00 GLP</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle">Action <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Change Label</a></li>
                                            <li><a href="#">QR-Code</a></li>                     
                                            <li><a href="#">Show Public Key</a></li>                    
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td colspan="4" class="text-center">You don't have any addresses.</td>
                            </tr> --}}
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection