@extends('layouts.admin')
@section('title')Employees @endsection
@section('content')
@include('includes.page_header_index',['title'=>'Employees','url'=>route('admin.employees.create'),'icon' => $icon])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="table-responsive">
                    @include('admin.employees.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

