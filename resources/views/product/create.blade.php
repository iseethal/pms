@include('template')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<br><br>

<form action="{{ route('product.store') }}" method="post">
    @csrf
    <div class="container">

        <div class="form-group">
            <label>Select Category</label>
            <select class="form-control form-control-sm" id="category_id" name="category_id"
                onchange="ChangeSubcategory(this.value);" required>
                <option>Select Category</option>

                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group" id="sub_category_id">
            <label>Select Sub Category</label>
            <select class="form-control form-control-sm" id="sub_category_id" name="sub_category_id">
                {{-- <option value="">Select Sub Categories</option> --}}
            </select>
        </div>

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" placeholder="Enter sub product name" name="product_name"
                id="product_name" required>

            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Amount</label>
            <input type="text" class="form-control" placeholder="Enter  amount" name="amount" id="amount"
                required>

            @error('amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" placeholder="Enter quantity" name="quantity" id="quantity"
                required>

            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <br><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>



<script>
    function ChangeSubcategory(categoryId) {

        $.ajax({
            type: 'GET',
            url: '/get-subcategories/' + categoryId,
            dataType: 'json',
            success: function(data) {
                if (data.length == 0) {
                    $('#sub_category_id').hide();
                } else {
                    $('#sub_category_id').show();

                    $('select[name="sub_category_id"]').empty();

                    $.each(data, function(key, value) {

                        $('select[name="sub_category_id"]').append(
                            '<option value=" ' + value.id + ' ">' + value.sub_category_name +
                            '</option>'
                        )

                    });
                }
            }


        });
    }
</script>

{{-- <script>
    function ChangeSubcategory(categoryId) {

        $.ajax({

            url: '/get-subcategories/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.length == 0) {
                    $('#sub_category_id').hide();
                } else {
                    $('#sub_category_id').show();
                    $('select[name="sub_category_id"]').empty();

                    $.each(data, function(key, value) {
                        $('select[name="sub_category_id"]').append(
                            '<option value=" ' + value.id + ' ">' + value.sub_category_name +
                            '</option>'
                        );
                    });

                }
            }

        });

    }
</script> --}}
