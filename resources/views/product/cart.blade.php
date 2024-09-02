@include('template')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<br><br>

<div class="container">

    <table class="table">
        <thead>
            <p style="font-size: 20px; text-align:center"><b>Cart Products</b></p>


            <tr>
                <th scope="col">SNO</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Change Quantity</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($cart as $item)
                <tr id="product-row-id-{{ $item['id'] }}">
                    <th scope="row"> {{ $i++ }} </th>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['total_amount'] }}</td>

                    <td>
                        <div class="max-0 pt-0">
                            <input type="number" min="1" name="product_qty" id="product_qty_{{ $item['id'] }}"
                                max="" value="{{ $item['quantity'] }}"
                                onchange="CalculateAmount({{ $item['id'] }})" style="width: 50px;">
                            <input type="hidden" name="price" id="price_{{ $item['id'] }}"
                                value="{{ $item['price'] }}">

                        </div>
                    </td>

                    <td>
                        <span id="new-price-{{ $item['id'] }}" style="color: red">
                            {{ $item['total_amount'] }}
                    <td>
                        <a class="btn btn-success" onclick="CartUpdate({{ $item['id'] }})">Update</a> &nbsp;
                        &nbsp;
                    </td>
                </tr>
            @endforeach

            @php
                $sub_total = 0;
                foreach ($cart as $item) {
                    $sub_total += $item['total_amount'];
                }

            @endphp
            <tr>
                <td colspan="4"><b>Sub Total</b> </td>
                <td> <b>{{ $sub_total }}</b> </td>
            </tr>


        </tbody>
    </table>
</div>


<script>
    function CalculateAmount(id) {
        var quantity = document.getElementById('product_qty_' + id).value;
        var price = document.getElementById('price_' + id).value;
        var total_amount = quantity * price;
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

        var quantity = document.getElementById('product_qty_' + id).value;
        var price = document.getElementById('price_' + id).value;
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
