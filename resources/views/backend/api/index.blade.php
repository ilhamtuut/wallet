@extends('layouts._app',['page'=>'api'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h1><b>Let's get your project started!</b></h1>
                <p>Integrate your project with the greenline project</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- PRICING TABLE -->
    <div class="col-md-4">

        <div class="panel panel-primary">
            <div class="panel-body panel-body-pricing text-center">
                <h1><i class="fa fa-book"></i></h1>
                <h2>Secure Wallet API</h2>
                <p>Incorporate Wallets in Apps.</p>
            </div>
            <div class="panel-footer">                                 
                <button class="btn btn-success btn-block">Read Documentation</button>
            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="panel panel-primary">
            <div class="panel-body panel-body-pricing text-center">
                <h1><i class="fa fa-tasks"></i></h1>
                <h2>Simple Query API</h2>
                <p>Simple plain-text based API.</p>
            </div>
            <div class="panel-footer"> 
                <button class="btn btn-success btn-block">Read Documentation</button>
            </div>
        </div>

    </div>                    

    <div class="col-md-4">

        <div class="panel panel-primary">
            <div class="panel-body panel-body-pricing text-center">
                <h1><i class="fa fa-file-text-o"></i></h1>
                <h2>JSON API</h2>
                <p>JSON based API.</p>
            </div>
            <div class="panel-footer"> 
                <button class="btn btn-success btn-block">Read Documentation</button>
            </div>
        </div>

    </div>                          
    <!-- END PRICING TABLE-->
</div>
@endsection