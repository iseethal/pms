@include('template')

<br><br>
<div class="container">



    <form action="{{ route('task.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Select Project</label>
            <select class="form-control form-control-sm" name="project_id">
                @foreach ($projects as $item)
                    <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label>Project Name</label>
            <input type="text" class="form-control" placeholder="Enter task name" name="task_name" required>
            @error('task_name')
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
