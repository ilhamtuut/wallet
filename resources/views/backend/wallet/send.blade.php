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
                <h3 class="panel-title"><span class="fa fa-arrow-circle-up"></span> Send GLP</h3>
            </div>
            <div class="panel-body">
                <p>Use the form below to send coins to another address.</p>
                <div class="col-md-6">
                    <div class="alert alert-warning">
                        NOTE : Minimum balance settles 1.0000000 GLP.
                    </div>
                    <form action="{{route('wallet.sendCoin')}}" method="POST" id="form-send">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Choose Address</label>
                            <select name="adddres" class="form-control" required>
                                <option value="">Choose Address</option>
                                @foreach($wallet as $value)
                                    <option value="{{$value->address}}">{{$value->label}} - {{$value->address}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Destination</label>
                            <input name="destination" type="text" class="form-control" placeholder="Destination" required>
                        </div>
                        {{-- <div class="form-group">
                            <label class="control-label">Network fee</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="1" readonly>
                                <span class="input-group-addon">GLP</span>
                            </div>                                            
                        </div> --}}
                        <div class="form-group">
                            <label class="control-label">Amount GLP</label>
                            {{-- <div class="input-group"> --}}
                                <input name="amount" type="text" class="form-control" placeholder="Amount GLP" required>
                                {{-- <span class="input-group-addon">GLP</span> --}}
                            {{-- </div>                                             --}}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="send">Send Coin</button>  
                            <div class="text-center">
                                <i class="fa fa-spinner fa-spin hidden" id="loader"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        var frmRes = $('#form-send');
        var frmResValidator = frmRes.validate();
        $('#send').on('click', function () {
            var valid = frmRes.valid();
            if(valid){
                $(this).addClass('hidden');
                $('#loader').removeClass('hidden');
            }
        });
    </script>
@endsection