<!DOCTYPE html>
<html>

<head>


    <!-- Incluye jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ... otras etiquetas ... -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
</head>




<body>

    <div class="container">
        <h1>Altas Agrupadas por UOR</h1>
        <table id="altas-table" class="table">
            <thead>
                <tr>
                    <th>UOR</th>
                    <th>CANTIDAD</th>
                </tr>
            </thead>
        </table>
    </div>



    <script>
        $(document).ready(function() {
            var periodo = "{{ $periodo }}"; // Obtener el periodo de la URL

            $('#altas-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": `http://localhost:3000/altas_agrupadas_por_uor/202301`,
                    "type": "GET"
                },

                "columns": [{
                        "data": "UOR"
                    },
                    {
                        "data": "CANTIDAD"
                    }
                ],



                "searching": true,
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

</body>

</html>