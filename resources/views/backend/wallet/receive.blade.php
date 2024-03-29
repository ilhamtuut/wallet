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
                <h3 class="panel-title"><span class="fa fa-arrow-circle-down"></span> Receive</h3>
            </div>
            <div class="panel-body">
                <p>These are your GLP addresses which you can use to receive coin.</p>
                <button class="btn btn-primary mb" data-toggle="modal" data-target="#modal_create"><i class="fa fa-plus"></i> New Address</button>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead class="bg-primary">
                            <tr>
                                <th width="40%">Address</th>
                                <th>Label</th>
                                <th>Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($wallet) > 0)
                                @foreach($wallet as $value)
                                    <tr>
                                        <td width="50%" style="line-break: anywhere;">{{$value->address}}</td>
                                        <td width="15%">{{$value->label}}</td>
                                        <td width="25%">{{App\Facades\Glp::balance($value->address)}} GLP</td>
                                        <td width="10%" class="text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" class="call" data-id="{{$value->id}}" data-label="{{$value->label}}" data-toggle="modal" data-target="#modal_label">Change Label</a></li>
                                                    <li><a href="#" class="call_qrcode" data-toggle="modal" data-qrcode="{{App\Facades\Glp::qrCode($value->address)}}" data-wallet="{{$value->address}}" data-target="#modal_qrcode">QR-Code</a></li>           
                                                    <li><a href="{{url('wallet/transaction?address='.$value->address)}}">Transaction</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">You don't have any addresses.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal in" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="defModalHeadLables" aria-hidden="false"><div class="modal-backdrop in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHeadLables"><span class="text-white">Create Wallet</span></h4>
            </div>
            <form action="{{route('wallet.createWallet')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Label</label>
                        <input type="text" name="label" class="form-control" placeholder="Label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal in" id="modal_label" tabindex="-1" role="dialog" aria-labelledby="defModalHeadLable" aria-hidden="false"><div class="modal-backdrop in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHeadLable"><span class="text-white">Change Label</span></h4>
            </div>
            <form action="{{route('wallet.update_label')}}" method="POST" id="form-update-label">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Label</label>
                        <input type="text" id="labelID" name="id" class="form-control hidden">
                        <input type="text" id="label" name="label" class="form-control" placeholder="Label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Label</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal in" id="modal_qrcode" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="false">
    <div class="modal-backdrop in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead"><span class="text-white">QR-Code</span></h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img class="mb" id="qrcode_img" alt="qrcode">
                    <p>Your GLP address</p>
                    <h5><b style="line-break: anywhere;" id="wallet"></b></h5>
                    <button type="button" class="btn btn-primary mb" onclick="copyToClipboard()"><i class="fa fa-copy"></i> Copy Address</button>
                    <p>You can deposit GLP to the address above to start using your online wallet.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    var address;
    function copyToClipboard() {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(address).select();
        document.execCommand("copy");
        $temp.remove();
        noty({text: 'Address is Copied', layout: 'topRight', type: 'success',timeout: 1000});
    }

    $('.call').on('click', function () {
        $('#labelID').val($(this).data('id'));
        $('#label').val($(this).data('label'));
    });

    $('.call_qrcode').on('click', function () {
        address = $(this).data('wallet');
        $('#qrcode_img').attr('src', $(this).data('qrcode'));
        $('#wallet').html($(this).data('wallet'));
    });

    $('#btn_submit').on('click',function(){
        $('#action').addClass('hidden');
        $('#spinner').removeClass('hidden');
    });
</script>
@endsection