@extends('layouts.admin')
@section('title')Create Employee @endsection
@section('content')
@include('includes.page_header',['title'=>'Create Employee','url'=>route('admin.employees.index'),'icon' => $icon])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    {!! Form::open(['route' => 'admin.employees.store', 'files' => true]) !!}

                        @include('admin.employees.fields')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

