@include('template')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
    integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<br><br>
<div class="container">



    <form action="{{ route('category.store') }}" method="post">
        @csrf

        <input type="hidden" name="id" id="id" value="{{ $category->id }}">

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" placeholder="Enter category name" name="category_name"
                id="category_name" value="{{ $category->category_name }}" required>

            @error('category_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                <option value="1" @if ($category->status == 1) selected @endif>Active</option>
                <option value="0" @if ($category->status == 0) selected @endif>InActive</option>

            </select>
        </div>

        <br><br>

        <button type="button" class="btn btn-primary" onclick="editcategory()">update</button>
    </form>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function editcategory() {

        var id = document.getElementById('id').value;
        var category_name = document.getElementById('category_name').value;
        var status = document.getElementById('status').value;

        const formData = new FormData();
        formData.append('id', id);
        formData.append('category_name', category_name);
        formData.append('status', status);
        formData.append('_method', 'PUT');


        $.ajax({

            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            url: '/category/' + id,
            data: formData,
            success: function(data) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + xhr.responseText);
            }

        });


    }
</script>
