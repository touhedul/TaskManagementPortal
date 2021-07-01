@extends('layouts.admin')
@section('title')Admins @endsection
@section('content')
@include('includes.page_header_index',['title'=>'Admins','url'=>route('admin.admins.create'),'icon' =>'pe-7s-user'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="table-responsive">
                    @include('admin.admins.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

