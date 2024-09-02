@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>
<div class="container">

    <input type="hidden" name="id" id="id" value="{{ $sub_category->id }}">

    <div class="form-group">
        <select class="form-control form-control-sm" id="category_id" name="category_id">
            @foreach ($categories as $item)
                <option value="{{ $item->id }}" @if ($item->id == $sub_category->category_id) selected @endif>
                    {{ $item->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sub Category Name</label>
        <input type="text" class="form-control" placeholder="Enter sub category name" name="sub_category_name"
            id="sub_category_name" value="{{ $sub_category->sub_category_name }}" required>

        @error('sub_category_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control form-control-sm" name="status" id="status">
            <option value="1" @if ($sub_category->status == 1) selected @endif>Active</option>
            <option value="0" @if ($sub_category->status == 0) selected @endif>InActive</option>

        </select>
    </div>

    <br><br>

    <button type="button" class="btn btn-primary" onclick="updateSubcategory()">Submit</button>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateSubcategory() {

        var category_id = document.getElementById('category_id').value;
        var sub_category_name = document.getElementById('sub_category_name').value;
        var status = document.getElementById('status').value;
        var id = document.getElementById('id').value;
        // alert(category_id);


        const formData = new FormData();
        formData.append('category_id', category_id);
        formData.append('sub_category_name', sub_category_name);
        formData.append('status', status);
        formData.append('id', id);
        formData.append('_method', 'PUT');

        $.ajax({

            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            url: '/sub-category/' + id,
            data: formData,
            success: function(data) {
                window.location.reload();
            }


        });

    }
</script>
