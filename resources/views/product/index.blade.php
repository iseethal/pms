@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>


<div class="container">
    <div style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('product.create') }}">Add Product</a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table" id="reportTable">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Manage Products</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Category Name</th>
                <th scope="col"> Sub Category Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($products as $item)
                @php
                    if ($item->status == 1) {
                        $status_is = 'Active';
                    } else {
                        $status_is = 'InActive';
                    }
                @endphp
                <tr id="product-row-id-{{ $item->id }}">
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item->category->category_name }}</td>
                    <td>{{ $item->sub_category->sub_category_name }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $status_is }}</td>
                    <td>
                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info">Edit</a> &nbsp; &nbsp;
                        <a href="" class="btn btn-danger"
                            onclick="DeleteProduct({{ $item->id }})">Delete</a>
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

    function DeleteProduct(id) {
        if (confirm("Do you want to delete this product?")) {
            $.ajax({

                type: 'DELETE',
                url: '/product/' + id,
                success: function(response) {
                    alert(response.success);
                    $('#product-row-id-' + id).remove();
                },
                error: function(xhr) {
                    alert('failed');
                }

            });
        }
    }
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            "searching": true,
            "paging": true,
            "ordering": true,
        });
    });
</script>
