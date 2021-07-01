<!-- Name Field -->
<div class="form-group">
    <b>{!! Form::label('name', 'Name:') !!}</b>
    <p>{{ $admin->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('email', 'Email:') !!}</b>
    <p>{{ $admin->email }}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', 'Created At:') !!}</b>
    <p>{{ $admin->created_at->toFormattedDateString() }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', 'Updated At:') !!}</b>
    <p>{{ $admin->updated_at->toFormattedDateString() }}</p>
</div>

