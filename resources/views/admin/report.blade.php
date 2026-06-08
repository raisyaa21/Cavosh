<!DOCTYPE html>
<html>
<head>

<title>Laporan</title>

<style>

body{

font-family:Arial;

padding:40px;

background:#f5f5f5;

}

table{

width:100%;

background:white;

border-collapse:collapse;

}

th,td{

padding:15px;

border:1px solid #ddd;

}

input{

padding:10px;

width:250px;

}

button{

padding:10px 20px;

}

</style>

</head>
<body>

<h1>Laporan Transaksi</h1>
<a href="/admin/report/pdf">

<button>
Export PDF
</button>

</a>

<a href="/admin/report/excel">

<button>
Export Excel
</button>

</a>

<br><br>
<form method="GET">

<input
type="text"
name="search"
placeholder="Cari ID transaksi">

<button type="submit">

Cari

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>

<th>Total</th>

<th>Tanggal</th>

</tr>

@foreach($transactions as $transaction)

<tr>

<td>{{ $transaction->id }}</td>

<td>
Rp {{ number_format($transaction->total) }}
</td>

<td>
{{ $transaction->created_at }}
</td>

</tr>

@endforeach

</table>

</body>
</html>