@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>

<div class="container">
    <div style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('sub-category.create') }}">Add SubCategory</a>
    </div>
    <table class="table" id="subCategoryTable">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Manage Projects</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">category Name</th>
                <th scope="col">Sub category Name</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($sub_categories as $item)
                @php
                    if ($item->status == 1) {
                        $status_is = 'Active';
                    } else {
                        $status_is = 'InActive';
                    }
                @endphp
                <tr id="sub-category-row-{{ $item->id }}">
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item->category->category_name }}</td>
                    <td>{{ $item->sub_category_name }}</td>
                    <td>{{ $status_is }}</td>
                    <td>
                        <a href="{{ route('sub-category.edit', $item->id) }}" class="btn btn-info">Edit</a> &nbsp;
                        &nbsp;
                        <a href="" class="btn btn-danger"
                            onclick="DeleteSubCategory({{ $item->id }})">Delete</a>
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

    function DeleteSubCategory(id) {
        $.ajax({
            type: 'DELETE',
            url: '/sub-category/' + id,

            success: function(response) {
                alert(response.success);
                $('#sub-category-row-' + id).remove();
            }


        });
    }
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>


<script>
    $(document).ready(function() {
        $('#subCategoryTable').DataTable({
            "searching": true,
            "ordering": true,
            "paging": true,
        });
    });
</script>
