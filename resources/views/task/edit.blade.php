@include('template')

<br><br>
<div class="container">

    <form action="{{ route('task.update', $task->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Select Project</label>
            <select class="form-control form-control-sm" name="project_id">
                @foreach ($projects as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $task->project_id) selected @endif>
                        {{ $item->project_name }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label>Project Name</label>
            <input type="text" class="form-control" placeholder="Enter task name" name="task_name"
                value="{{ $task->task_name }}" required>
            @error('task_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Hours</label>
            <input type="number" class="form-control" placeholder="Enter hours" name="hours"
                value="{{ $task->hours }}" required>
            @error('hours')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control" placeholder="Enter date" name="date"
                value="{{ $task->date }}" required>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" placeholder="Enter description" name="description"> {{ $task->description }} </textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control form-control-sm" name="status">
                <option value="1" @if ($task->status == 1) selected @endif>Active</option>
                <option value="0" @if ($task->status == 0) selected @endif>InActive</option>

            </select>
        </div>

        <br><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
