<div class='btn-group'>
    <a href="{{ route('admin.users.show', $id) }}" class='btn btn-sm btn-primary'>
        View
    </a>
    <a href="{{ route('admin.users.edit', $id) }}" class='btn btn-sm btn-info'>
       Edit
    </a>
     <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Delete" class="btn btn-sm btn-danger delete">Delete</a>
</div>
