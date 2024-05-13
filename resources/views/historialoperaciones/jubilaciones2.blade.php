<!-- Include Bootstrap Table CSS and JavaScript -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

<!-- HTML table structure -->
<table id="myTable" data-toggle="table" data-url="http://localhost:3000/jubilaciones_detalle/202309" data-pagination="true">
    <thead>
        <tr>
            <th data-field="CUIL"> </th>
            <th data-field="NOMBREAPELLIDO"> </th> 

            <!-- Add more columns as needed -->
        </tr>
    </thead>
</table>

<!-- JavaScript to initialize Bootstrap Table -->
<script>
    $(document).ready(function() {
        $('#myTable').bootstrapTable();
    });
</script>
