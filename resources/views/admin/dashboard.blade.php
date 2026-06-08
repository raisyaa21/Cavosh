<!DOCTYPE html>

<html>

<head>

<title>Dashboard Admin</title>

<style>

body{

margin:0;

font-family:Arial;

display:flex;

background:#f5f5f5;

}

.sidebar{

width:220px;

height:100vh;

background:#24364d;

padding:25px;

}

.sidebar a{

display:block;

padding:12px;

margin-bottom:10px;

background:white;

text-decoration:none;

color:black;

border-radius:8px;

}

.content{

flex:1;

padding:30px;

}

.card{

background:white;

padding:20px;

border-radius:15px;

margin-bottom:20px;

box-shadow:0 0 8px rgba(0,0,0,.1);

}

.cards{

display:grid;

grid-template-columns:repeat(4,1fr);

gap:15px;

}

</style>

</head>

<body>

<div class="sidebar">

<h2 style="color:white;">CAVOSH</h2>

<a href="/admin/dashboard">Dashboard</a>

<a href="/admin/menu">Menu</a>

<a href="/admin/report"> Laporan </a>

<a href="/logout">Logout</a>

</div>

<div class="content">

<h1>Dashboard Admin</h1>

<div class="cards">

<div class="card">

<h3>Total Menu</h3>

<h1>{{ $menu }}</h1>

</div>

<div class="card">

<h3>Total User</h3>

<h1>{{ $user }}</h1>

</div>

<div class="card">

<h3>Total Order</h3>

<h1>{{ $transaction }}</h1>

</div>

<div class="card">

<h3>Pendapatan</h3>

<h1>Rp {{ number_format($income) }}</h1>

</div>

</div>

<div class="card">

<h2>Selamat Datang {{ auth()->user()->name ?? 'Admin' }}</h2>

<p>Admin dapat mengelola seluruh data Cafe.</p>

</div>

</div>

</body>

</html>