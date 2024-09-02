@include('template')

<form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container">

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" placeholder="image" name="image" id="image" required>
        </div>

        <br><br>

        <div class="form-group">
            <button type="button" class="btn ripple btn-success" onclick="AddRow()">Add Row</button>
            <input type="hidden" id="row_cnt" name="row_cnt" value="0">

        </div>

        <table id="myTable" class="table table-borderd">
            <thead>
                <tr>
                    <th>name</th>
                    <th>phone</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>


        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

{{--
<div class="container">
    @foreach ($images as $item)
        <img src="images/{{ $item->image }}" alt="" style="width: 100px; height:100px">
    @endforeach
</div> --}}

<script>
    function AddRow() {

        let rowcnt = document.getElementById("row_cnt").value;
        let row_cnt = Number(rowcnt);

        var table = document.hetElementById("myTable").getElementByTagName('tbody')[0];
        var row = table.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        let containerHTML = '<div class="container">';
        cell1.innerHTML = '<input type="text" class="form-control" name="name_' + row_cnt_ '" id="name_' + row_cnt +
            '">'

        let cnt = 1;
        let new_cnt = row_cnt + cnt;
        document.getElementById("row_cnt").value = new_cnt;

    }
</script>
