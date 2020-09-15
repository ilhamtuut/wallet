@extends('layouts._app',['page'=>'settings'])
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Settings</li>
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
                <h3 class="panel-title"><span class="fa fa-cog"></span> Settings</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th width="3%" class="text-center">#</th>
                                <th>Name</th>
                                <th class="text-right">Value</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $value)
                                <tr>
                                    <td width="3%" class="text-center">{{++$i}}</td>
                                    <td>{{$value->name}}</td>
                                    <td class="text-right">
                                        @if($value->type == 'IDR' || $value->type == 'USD' || $value->type == 'USDT')
                                            {{number_format($value->value)}} {{$value->type}}
                                        @else
                                            {{$value->value * 100}}{{$value->type}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle">Action <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" class="call_modal_s" data-id="{{$value->id}}" data-value="{{($value->type == 'IDR' || $value->type == 'USD' || $value->type == 'USDT')? $value->value : $value->value*100}}" data-desc="{{$value->name}}" data-url="{{ route('administrator.settings.update', $value->id) }}" data-toggle="modal" data-target="#responsive-modal">Update</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available in table</td>
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
<div class="modal fade" id="responsive-modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title text-white" id="title-modal"></h5>
          </div>
          <form method="POST" id="form_update">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label class="text-muted">Value</label>
                      <input id="value" type="text" name="amount" class="form-control" placeholder="Value">
                  </div>
              </div>
              <div class="modal-footer">
                <div id="action">
                  <button type="submit" class="btn btn-success" id="btn_submit">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <i class="hidden" id="spinner"><span class="fa fa-spin fa-spinner"></span></i>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $('.call_modal_s').on('click',function(){
        $('#form_update').attr('action', $(this).data('url'));
        var title = $(this).data('desc');
        $('#value').val($(this).data('value'));
        $('#title-modal').html('Update ' + title.replace(/_/g,' '));
    });

    $('#btn_submit').on('click',function(){
        $('#action').addClass('hidden');
        $('#spinner').removeClass('hidden');
    });
</script>
@endsection