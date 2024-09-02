@include('template')

<div class="container">
    <p style="font-size: 20px; text-align:center"><b>Report</b></p>
    <table id="reportTable" class="table">
        <thead>
            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Project Name</th>
                <th scope="col">Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($projects as $item)
                @php
                    $project = App\Models\Project::find($item->id);
                    $tasks = $project->task;
                    $task_total = 0;
                    $total_hours = App\Models\Task::where('project_id', $item->id)->pluck('hours');
                    foreach ($total_hours as $value) {
                        $task_total += $value;
                    }
                @endphp
                <tr>
                    <td scope="row"> {{ $i++ }} </td>
                    <td> <b>{{ $item->project_name }}</b> <br>
                        @foreach ($tasks as $task)
                            {{ $task->task_name }} <br>
                        @endforeach
                    </td>
                    <td>
                        <b>{{ $task_total }} </b><br>
                        @foreach ($tasks as $task)
                            {{ $task->hours }} <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            "searching": true,
            "paging": true,
            "ordering": true
        });
    });
</script>
