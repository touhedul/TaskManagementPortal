@extends('layouts.admin')
@section('title')Update  Admin @endsection
@section('content')
@include('includes.page_header',['title'=>'Update Admin','url'=>route('admin.admins.index'),'icon' => 'pe-7s-user'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                   {!! Form::model($admin, ['route' => ['admin.admins.update', $admin->id], 'method' => 'patch']) !!}

                        @include('admin.admins.fields')

                   {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

