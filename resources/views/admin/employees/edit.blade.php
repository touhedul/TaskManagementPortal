@extends('layouts.admin')
@section('title')Update  Employee @endsection
@section('content')
@include('includes.page_header',['title'=>'Update Employee','url'=>route('admin.employees.index'),'icon' => $icon])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                   {!! Form::model($employee, ['route' => ['admin.employees.update', $employee->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.employees.fields')

                   {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

