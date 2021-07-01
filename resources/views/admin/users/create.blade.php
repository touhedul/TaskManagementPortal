@extends('layouts.admin')
@section('title')Create User @endsection
@section('content')
@include('includes.page_header',['title'=>'Create User','url'=>route('admin.users.index'),'icon' => 'pe-7s-user'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    {!! Form::open(['route' => 'admin.users.store', 'files' => true]) !!}

                        @include('admin.users.create_fields')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

