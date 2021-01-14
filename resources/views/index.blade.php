@extends('admin::layout')
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="page-header">
                <h4>Administrace webu</h4>
            </div>

            <p>Vítejte v administraci webu <a href="{{route('admin::index')}}">{{ config('app.name') }}</a>.</p>
        </div>

        <div class="col-md-3">
            @include('admin::components.support')
        </div>
    </div><!--/.row-->

@endsection
