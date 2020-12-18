@extends('layouts._app',['page'=>'my_wallet'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">My Wallet</li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-credit-card"></span> My Wallet</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><b class="text-white">Information Wallet</b></h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    {{-- <tr>
                                        <td width="50%">Total Transactions</td>
                                        <td width="50%">0</td>
                                    </tr>
                                    <tr>
                                        <td>Total Received</td>
                                        <td>0.00 GLP</td>
                                    </tr>
                                    <tr>
                                        <td>Total Sent</td>
                                        <td>0.00 GLP</td>
                                    </tr> --}}
                                    <tr>
                                        <td>Total Balance</td>
                                        <td>{{$balance}} GLP</td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3><b class="text-white">Account Settings</b></h3>
                        <p>You can change your account settings like your email, password.</p>
                        <a href="{{route('account.setting')}}" class="btn btn-primary mb">Change account settings</a>
                        {{-- <h3><b>Backup</b></h3>
                        <p>You can change your account settings like your email, password.</p>
                        <a href="#" class="btn btn-primary">Paper Wallet</a> --}}
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-center"><b class="text-white">Your Wallet</b></h3>
                        <div class="text-center">
                            <img class="mb" src="{{$qrCode}}" alt="qrcode">
                            <p>Your GLP address</p>
                            <h5><b style="line-break: anywhere;">{{$address}}</b></h5>
                            <button type="button" class="btn btn-primary mb" onclick="copyToClipboard('{{$address}}')"><i class="fa fa-copy"></i> Copy Address</button>
                            <p>You can deposit GLP to the address above to start using your online wallet.</p>
                        </div>
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