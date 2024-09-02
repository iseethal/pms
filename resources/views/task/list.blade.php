@include('template')

<br><br>

<div class="container">
    <div style="padding-bottom: 10px">
        <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
    </div>
    <table class="table">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Manage Tasks</b></p>

            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Project Name</th>
                <th scope="col">Task Name</th>
                <th scope="col">Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($task as $item)
                @php
                    if ($item->status == 1) {
                        $status_is = 'Active';
                    } else {
                        $status_is = 'InActive';
                    }
                @endphp
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->project->project_name }}</td>
                    <td>{{ $item->task_name }}</td>
                    <td>{{ $status_is }}</td>
                    <td>
                        <a href="{{ route('task.edit', $item->id) }}" class="btn btn-info"> Edit</a> </a>

                        <a href="{{ route('task.destroy', $item->id) }}" class="btn btn-danger">Delete<i
                                class="fas fa-trash-alt"></i></a>
                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>
</div>
