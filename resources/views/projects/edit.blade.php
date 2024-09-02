@include('template')

<br><br>
<div class="container">

    <form action="{{ route('project.update', $project->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Project Name</label>
            <input type="text" class="form-control" placeholder="Enter project name" name="project_name"
                value="{{ $project->project_name }}" required>
            @error('project_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control form-control-sm" name="status">
                <option value="1" @if ($project->status == 1) selected @endif>Active</option>
                <option value="0" @if ($project->status == 0) selected @endif>InActive</option>

            </select>
        </div>
        <br><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
