@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Subscribers Email List</h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Email</th>
                        </tr>

                        @foreach ($subscribes as $key=> $subscribe )
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$subscribe->email}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
