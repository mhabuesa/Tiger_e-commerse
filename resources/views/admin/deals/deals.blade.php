@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Deals 1</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-3">
                            <label class="label-control"></label>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
