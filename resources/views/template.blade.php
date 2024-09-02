<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<meta name="csrf-token" content="{{ csrf_token() }}">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">PMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {{-- <li class="nav-item active">
                <a class="nav-link" href="{{ route('project.index') }}">Project <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.index') }}">Task</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('time') }}">Time Entry</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">Report</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.index') }}">Category</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('sub-category.index') }}">Sub Category</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">Product</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('all-products') }}">All Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Cart Count:<span id="cart-count"></span></a>
            </li>
        </ul>

    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateCartCount() {
        $.ajax({
            type: 'GET',
            url: "{{ route('cart.count') }}",
            success: function(response) {
                $('#cart-count').text(response.count);
            }
        });
    }

    $(document).ready(function() {
        updateCartCount();
    });
</script>
