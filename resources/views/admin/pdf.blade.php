<!DOCTYPE html>
<html>
<head>
    <style>

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid black;
            padding:8px;
        }

    </style>
</head>

<body>

<h2>Laporan Transaksi</h2>

<table>

<tr>
    <th>ID</th>
    <th>Total</th>
    <th>Tanggal</th>
</tr>

@foreach($transactions as $transaction)

<tr>
    <td>{{ $transaction->id }}</td>
    <td>{{ $transaction->total }}</td>
    <td>{{ $transaction->created_at }}</td>
</tr>

@endforeach

</table>

</body>
</html>