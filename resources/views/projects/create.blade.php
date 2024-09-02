@include('template')

<br><br>
<div class="container">

    <form action="{{ route('project.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Project Name</label>
            <input type="text" class="form-control" placeholder="Enter project name" name="project_name" required>
            @error('project_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control form-control-sm" name="status">
                <option value="1">Active</option>
                <option value="0">InActive</option>

            </select>
        </div>

        <br><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
