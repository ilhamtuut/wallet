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
                <p>These are your GLP addresses which you can use to receive money.</p>
                {{-- <button class="btn btn-success mb"><i class="fa fa-plus"></i> New Address</button> --}}
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
                            @if($wallet)
                            <tr>
                                <td width="50%" style="line-break: anywhere;">{{$wallet->address}}</td>
                                <td width="15%">{{$wallet->label}}</td>
                                <td width="25%">{{$balance}} GLP</td>
                                <td width="10%" class="text-center">
                                    <div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle">Action <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" data-toggle="modal" data-target="#modal_label">Change Label</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modal_qrcode">QR-Code</a></li>                     
                                            {{-- <li><a href="#">Show Public Key</a></li>--}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
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
<div class="modal in" id="modal_label" tabindex="-1" role="dialog" aria-labelledby="defModalHeadLable" aria-hidden="false"><div class="modal-backdrop in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHeadLable"><span class="text-white">Change Label</span></h4>
            </div>
            <form action="{{route('wallet.updateLabel')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Label</label>
                        <input value="{{$wallet->label}}" type="text" name="label" class="form-control" placeholder="Label">
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
<div class="modal in" id="modal_qrcode" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="false"><div class="modal-backdrop in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead"><span class="text-white">QR-Code</span></h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{$qrCode}}" alt="qrcode">
                    <p>This is your GLP address</p>
                    <h5><b style="line-break: anywhere;">{{$wallet->address}}</b></h5>
                    <button type="button" class="btn btn-primary mb" onclick="copyToClipboard('{{$wallet->address}}')"><i class="fa fa-copy"></i> Copy Address</button>
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
    function copyToClipboard(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
        noty({text: 'Address is Copied', layout: 'topRight', type: 'success',timeout: 1000});
   }
</script>
@endsection