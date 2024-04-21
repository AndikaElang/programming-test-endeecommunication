<!DOCTYPE html>
<html>
<head>
    <style>
        #table-order {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table-order td, #table-order th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table-order tr:nth-child(even){background-color: #f2f2f2;}

        #table-order tr:hover {background-color: #ddd;}

        #table-order th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Data Pesanan</h2>

    <table id="table-order">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Nama Klien</th>
                <th>Nama Item</th>
                <th>Harga Klien</th>
                <th>Tanggal Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->client_name }}</td>
                    <td>{{ $order->item_name }}</td>
                    <td>{{ $order->item_price }}</td>
                    <td>{{ $order->date_order }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
