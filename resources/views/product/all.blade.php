@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>

<div class="container">

    <table class="table">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>All Products</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Category Name</th>
                <th scope="col"> Sub Category Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Availability</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($products as $item)
                <tr id="product-row-id-{{ $item->id }}">
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item->category->category_name }}</td>
                    <td>{{ $item->sub_category->sub_category_name }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->quantity }}</td>

                    <td>
                        <div>
                            <input type="number" name="product_quantity" id="product_quantity_{{ $item->id }}"
                                min="1" max="{{ $item->quantity }}" value="1"
                                onclick="CalculateAmount({{ $item->id }})">

                            <input type="hidden" name="quantity" id="quantity_{{ $item->id }}"
                                value="{{ $item->quantity }}">
                            <input type="hidden" name="amount" id="amount_{{ $item->id }}"
                                value="{{ $item->amount }}">
                        </div>
                    </td>

                    <td>
                        <span id="new-price-{{ $item->id }}"></span>
                    </td>
                    <td>

                        <a class="btn btn-success" onclick="AddToCart({{ $item->id }})">Add To Cart</a> &nbsp;
                        &nbsp;
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>

<script>
    function CalculateAmount(id) {

        var product_quantity = document.getElementById('product_quantity_' + id).value;
        var amount = document.getElementById('amount_' + id).value;
        var total_amount = product_quantity * amount;
        document.getElementById('new-price-' + id).innerHTML = total_amount;
    }
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function AddToCart(id) {

        var quantity = document.getElementById('product_quantity_' + id).value;
        var price = document.getElementById('amount_' + id).value;
        var total_amount = quantity * price;

        const formData = new FormData();
        formData.append('quantity', quantity);
        formData.append('price', price);
        formData.append('total_amount', total_amount);

        $.ajax({

            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            url: '/add-to-cart/' + id,
            success: function(response) {
                alert('product added to cart');
                updateCartCount();
            },
            error: function(xhr) {
                alert('failed to aded to cart');
            }

        });
    }
</script>
