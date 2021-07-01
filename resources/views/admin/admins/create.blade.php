@extends('layouts.admin')
@section('title')Create Admin @endsection
@section('content')
@include('includes.page_header',['title'=>'Create Admin','url'=>route('admin.admins.index'),'icon' => 'pe-7s-user'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    {!! Form::open(['route' => 'admin.admins.store']) !!}

                        @include('admin.admins.fields')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

