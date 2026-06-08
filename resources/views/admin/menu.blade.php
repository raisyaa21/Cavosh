<!DOCTYPE html>

<html>

<head>

<title>Kelola Menu</title>

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

button{

padding:8px 15px;

}

</style>

</head>

<body>

<h1>Kelola Menu</h1>

<a href="#">Tambah Menu</a>

<br><br>

<table>

<tr>

<th>Nama</th>

<th>Harga</th>

<th>Stock</th>

<th>Aksi</th>

</tr>

@foreach($menus as $menu)

<tr>

<td>{{ $menu->name }}</td>

<td>{{ $menu->price }}</td>

<td>{{ $menu->stock }}</td>

<td>

<button>Edit</button>

<button>Delete</button>

</td>

</tr>

@endforeach

</table>

</body>

</html>