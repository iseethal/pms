@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>
<div class="container">

    <div class="form-group">
        <label>Select Category</label>
        <select class="form-control form-control-sm" id="category_id" name="category_id">
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sub Category Name</label>
        <input type="text" class="form-control" placeholder="Enter sub category name" name="sub_category_name"
            id="sub_category_name" required>

        @error('sub_category_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control form-control-sm" name="status" id="status">
            <option value="1">Active</option>
            <option value="0">InActive</option>

        </select>
    </div>

    <br><br>

    <button type="button" class="btn btn-primary" onclick="addSubcategory()">Submit</button>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addSubcategory() {

        var category_id = document.getElementById('category_id').value;
        var sub_category_name = document.getElementById('sub_category_name').value;
        var status = document.getElementById('status').value;

        const formData = new FormData();
        formData.append('category_id', category_id);
        formData.append('sub_category_name', sub_category_name);
        formData.append('status', status);

        $.ajax({

            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            url: "{{ route('sub-category.store') }}",
            data: formData,
            success: function(data) {

                window.location.reload();
                document.getElementById('sub_category_name').value = "";
            }

        });


    }
</script>
