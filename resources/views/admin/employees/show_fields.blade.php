<!-- Name Field -->
<div class="form-group">
    <b>{!! Form::label('name', 'Name:') !!}</b>
    <p>{{ $employee->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('email', 'Email:') !!}</b>
    <p>{{ $employee->email }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    <b>{!! Form::label('image', 'Image:') !!}</b>
    <p>{{ $employee->image }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', 'Created At:') !!}</b>
    <p>{{ $employee->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', 'Updated At:') !!}</b>
    <p>{{ $employee->updated_at }}</p>
</div>

