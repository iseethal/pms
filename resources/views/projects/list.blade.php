@include('template')

<br><br>


<div class="container">
    <div style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('project.create') }}">Add Project</a>
    </div>
    <table class="table">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Manage Projects</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Project Name</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($projects as $item)
                @php
                    if ($item->status == 1) {
                        $status_is = 'Active';
                    } else {
                        $status_is = 'InActive';
                    }
                @endphp
                <tr>
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item->project_name }}</td>
                    <td>{{ $status_is }}</td>
                    <td>
                        <a href="{{ route('project.edit', $item->id) }}" class="btn btn-info">Edit</a> &nbsp; &nbsp;
                        <a href="{{ route('project.destroy', $item->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
