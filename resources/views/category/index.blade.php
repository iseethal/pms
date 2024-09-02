@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<br><br>

<div class="container">
    <div style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('category.create') }}">Add Category</a>
    </div>
    <table class="table">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Manage Projects</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">category Name</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($categories as $item)
                @php
                    if ($item->status == 1) {
                        $status_is = 'Active';
                    } else {
                        $status_is = 'InActive';
                    }
                @endphp
                <tr id="category-row-{{ $item->id }}">
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $status_is }}</td>
                    <td>
                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info">Edit</a> &nbsp; &nbsp;
                        <a class="btn btn-danger" onclick="DeleteCategory({{ $item->id }})">Delete</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function DeleteCategory(id) {

        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: 'DELETE',
                url: '/category/' + id,
                success: function(response) {
                    alert(response.success);
                    $('#category-row-' + id).remove();
                },
                error: function(xhr) {
                    alert('failed delete');

                }

            });
        }
    }
</script>
