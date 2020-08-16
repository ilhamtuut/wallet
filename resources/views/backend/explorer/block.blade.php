@extends('layouts._app',['page'=>'block'])
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Block #3336997</h3>
            </div>
            <div class="panel-body">
                <h2><b>Details</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Hash</td>
                                <td>abb0aa00893cb8c048c4421738d5d2f354cfdc05da586bc623861b31345e451c</td>
                            </tr>
                            <tr>
                                <td>Previous Block</td>
                                <td><a href="{{route('explorer.block','7758ee61991855c2a3f0d715f0095bd792511ce07271eeef4f72a4e965915a74')}}">7758ee61991855c2a3f0d715f0095bd792511ce07271eeef4f72a4e965915a74</a></td>
                            </tr>
                            <tr>
                                <td>Next Block</td>
                                <td>None</td>
                            </tr>
                            <tr>
                                <td>Height</td>
                                <td>3,336,997</td>
                            </tr>
                            <tr>
                                <td>Version</td>
                                <td>6422788</td>
                            </tr>
                            <tr>
                                <td>Transaction Merkle Root</td>
                                <td>f20aa07172a55378639599b2a42d722a26336b32699dad5c45f91131cdeeb9b7</td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>2020-08-01 00:54:53 -0700</td>
                            </tr>
                            <tr>
                                <td>Difficulty</td>
                                <td>5,086,533.23291296 (Bits: 1a034c5e)</td>
                            </tr>
                            <tr>
                                <td>Nonce</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Transactions</td>
                                <td>38</td>
                            </tr>
                            <tr>
                                <td>Value out</td>
                                <td>26,517,964.80074076</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>

                <h2><b>Transactions</b></h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Transaction</th>
                                <th>Fee</th>
                                <th>From (amount)</th>
                                <th>To (amount)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{route('explorer.hash','f20aa07172a55378639599b2a42d722a26336b32699dad5c45f91131cdeeb9b7')}}">2db6262f…e35f1d1d</a></td>
                                <td>3</td>
                                <td>
                                    <a href="{{route('explorer.address','D8zF7zL13S5kmU6ADSUKjoFo6oHWDWhRZu')}}">D8zF7zL13S5kmU6ADSUKjoFo6oHWDWhRZu</a> : 549,980.00000000
                                </td>
                                <td>
                                    <a href="{{route('explorer.address','D9pRmXiNnvUNUjawrUzFziyarLUYMuPt9N')}}">D9pRmXiNnvUNUjawrUzFziyarLUYMuPt9N</a> : 199,980.00000000 <br>
                                    <a href="{{route('explorer.address','D8zF7zL13S5kmU6ADSUKjoFo6oHWDWhRZu')}}">D8zF7zL13S5kmU6ADSUKjoFo6oHWDWhRZu</a> : 349,996.90013514
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection