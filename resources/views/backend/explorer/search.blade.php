@extends('layouts._app',['page'=>'search'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Search results</h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger">
                    <strong>We're sorry!</strong> We couldn't find any results matching your search query.
                </div>

                <p>Please enter search terms.</p>
                <div class="col-md-6">
                    <form action="{{route('explorer.search')}}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Search by address, block number or hash, transaction:</label>
                            <input name="q" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Search</button>                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection