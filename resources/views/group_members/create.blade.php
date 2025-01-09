@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Members to Project</h1>
    <form action="{{ route('group-members.store') }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ $projectId }}">
        <div id="member-forms">
            <div class="mb-3">
                <label for="user_ids[]" class="form-label">Select Member</label>
                <select name="user_ids[]" class="form-select">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-member-form">Add More Members</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
document.getElementById('add-member-form').addEventListener('click', function () {
    const form = document.querySelector('#member-forms > div').cloneNode(true);
    document.getElementById('member-forms').appendChild(form);
});
</script>
@endsection