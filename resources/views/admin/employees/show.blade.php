@extends('layouts.admin')
@section('title')View  Employee Details @endsection
@section('content')
@include('includes.page_header',['title'=>'View Employee','url'=>route('admin.employees.index'),'icon' => $icon])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    @include('admin.employees.show_fields')
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
