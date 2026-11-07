<!DOCTYPE html>
<html>
<head>
    <title>Cavosh Cafe</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f4f4f4;
            display:flex;
        }

        .sidebar{
            width:220px;
            height:100vh;
            background:#24364d;
            color:white;
            padding:30px 20px;
            position:fixed;
        }

        .sidebar h1{
            margin-bottom:40px;
        }

        .sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    margin-bottom:20px;
    padding:12px;
    border-radius:10px;
}

.sidebar a.active{
    background:rgba(255,255,255,0.1);
    border-left:4px solid #ff6b4a;
}

        .content{
            margin-left:220px;
            width:100%;
            padding:30px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            margin-bottom:30px;
        }

        .menu-container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
        }

        .menu-card{
            background:white;
            border-radius:20px;
            padding:20px;
        }

        .menu-card img{
            width:100%;
            height:180px;
            object-fit:cover;
            border-radius:15px;
        }

        .gray{
            filter:grayscale(100%);
            opacity:0.5;
        }

        .qty{
            display:flex;
            gap:10px;
            align-items:center;
            margin-top:15px;
        }

        .qty button{
            width:35px;
            height:35px;
            border:none;
            background:#ff6b4a;
            color:white;
            border-radius:8px;
            cursor:pointer;
        }

        .cart{
            margin-top:40px;
            background:white;
            padding:25px;
            border-radius:20px;
        }

        .cart-item{
            display:flex;
            justify-content:space-between;
            margin-top:10px;
        }

        .checkout{
            width:100%;
            padding:15px;
            border:none;
            background:#ff6b4a;
            color:white;
            border-radius:10px;
            margin-top:20px;
            cursor:pointer;
        }

        select{
            width:100%;
            padding:12px;
            margin-top:15px;
        }

       .popup{
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    background:white;
    padding:40px;
    border-radius:20px;
    z-index:999;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);

    animation:popup 0.3s ease;
}

@keyframes popup{

    from{
        opacity:0;
        transform:translate(-50%, -50%) scale(0.7);
    }

    to{
        opacity:1;
        transform:translate(-50%, -50%) scale(1);
    }
}

    </style>

</head>
<body>

<div class="sidebar">

    <h1>Cavosh Cafe</h1>

    <a href="/dashboard"
class="{{ request()->is('dashboard') ? 'active' : '' }}">
    Dashboard
</a>

<a href="/history"
class="{{ request()->is('history') ? 'active' : '' }}">
    History
</a>

    <a href="/logout">Logout</a>

</div>

<div class="content">

    <div class="topbar">

        <div>

            <h2>
                Halo, {{ auth()->user()->name ?? 'Admin' }}
            </h2>

            <p>Welcome Back</p>

        </div>

    </div>

    @if(session('success'))
        <div class="mb-4 mx-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 mx-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex gap-6 p-6">
        <!-- KOLOM KIRI: DAFTAR MENU -->
        <div class="w-2/3 grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($menus as $menu)
                <div class="border rounded-xl p-4 bg-white shadow-sm flex flex-col justify-between">
                    <div>
                        <!-- Foto Menu -->
                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="w-full h-36 object-cover rounded-lg mb-3 {{ $menu->stock <= 0 ? 'grayscale opacity-60' : '' }}">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $menu->name }}</h3>
                        <p class="text-orange-600 font-semibold mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        <span class="text-xs text-gray-500">Stok: {{ $menu->stock }}</span>
                    </div>

                    <!-- Tombol Tambah ke Cart -->
                    <form action="/add-to-cart/{{ $menu->id }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-lg font-medium hover:bg-orange-600 transition {{ $menu->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $menu->stock <= 0 ? 'disabled' : '' }}>
                            {{ $menu->stock <= 0 ? 'Stok Habis' : '+ Tambah' }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- KOLOM KANAN: CART (Keranjang Belanja) -->
        <div class="w-1/3 bg-white p-6 rounded-xl shadow-sm h-fit">
            <h2 class="text-xl font-bold mb-4">Cart</h2>
            
            <!-- Menampilkan Total dari Session Cart -->
            @php
                $cart = session('cart', []);
                $total = array_reduce($cart, function($carry, $item) {
                    return $carry + ($item['price'] * $item['quantity']);
                }, 0);
            @endphp

            @if(!empty($cart))
                <div class="space-y-2 mb-4 max-h-48 overflow-y-auto divide-y divide-gray-100">
                    @foreach($cart as $id => $item)
                        <div class="flex justify-between items-center pt-2 text-sm">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-orange-600">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                                <form action="/remove-from-cart/{{ $id }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold px-1 rounded" title="Hapus item">✕</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-sm mb-4 italic">Keranjang masih kosong</p>
            @endif

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <p class="text-lg font-bold mb-4">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>

                <!-- Dropdown PILIH METODE PEMBAYARAN -->
                <select name="payment_method" class="w-full p-2 border rounded-md mb-4" required>
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>
                </select>

                <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition disabled:opacity-50" {{ empty($cart) ? 'disabled' : '' }}>
                    Checkout
                </button>
            </form>
        </div>
    </div>

</div>

<div id="popup"></div>

<script>

let cart = [];

function plusQty(id, price, stock, name){

    let qtyElement =
    document.getElementById('qty-' + id);

    let stockElement =
    document.getElementById('stock-' + id);

    let qty = parseInt(qtyElement.innerText);

    let stockNow = parseInt(stockElement.innerText);

    if(stockNow <= 0){
        return;
    }

    qty++;

    stockNow--;

    qtyElement.innerText = qty;

    stockElement.innerText = stockNow;

    let existing =
    cart.find(item => item.menu_id === id);

    if(existing){

        existing.qty++;

        existing.subtotal =
        existing.qty * price;

    }else{

        cart.push({
            menu_id:id,
            name:name,
            qty:1,
            subtotal:price,
            price:price
        });
    }

    renderCart();
}

function minusQty(id, price){

    let qtyElement =
    document.getElementById('qty-' + id);

    let stockElement =
    document.getElementById('stock-' + id);

    let qty = parseInt(qtyElement.innerText);

    let stockNow = parseInt(stockElement.innerText);

    if(qty <= 0){
        return;
    }

    qty--;

    stockNow++;

    qtyElement.innerText = qty;

    stockElement.innerText = stockNow;

    let existing =
    cart.find(item => item.menu_id === id);

    if(existing){

        existing.qty--;

        existing.subtotal =
        existing.qty * price;

        if(existing.qty <= 0){

            cart =
            cart.filter(item =>
            item.menu_id !== id);
        }
    }

    renderCart();
}

function renderCart(){

    let cartItems =
    document.getElementById('cartItems');

    cartItems.innerHTML = "";

    let total = 0;

    cart.forEach(item => {

        total += item.subtotal;

        cartItems.innerHTML += `

        <div class="cart-item">

            <span>
                ${item.name} x ${item.qty}
            </span>

            <span>
                Rp ${item.subtotal}
            </span>

        </div>

        `;
    });

    document.getElementById('totalPrice')
    .innerText = total;
}

function checkout(){

    let total =
    document.getElementById('totalPrice')
    .innerText;

    let payment =
    document.getElementById('paymentMethod')
    .value;

    if(total == 0){

        alert('Cart kosong');

        return;
    }

    if(payment === 'QRIS'){

        document.getElementById('popup')
        .innerHTML = `

        <div class="popup">

            <h2>
                Scan QRIS
            </h2>

            <br>

            <img
            src="{{ asset('images/qris.jpg') }}"
            width="250">

            <br><br>

            <button onclick="finishCheckout()"
            style="
                padding:12px 20px;
                border:none;
                background:#ff6b4a;
                color:white;
                border-radius:10px;
                cursor:pointer;
            ">
                Saya Sudah Bayar
            </button>

        </div>

        `;

    }else{

        finishCheckout();
    }
}

function finishCheckout(){

    let total =
    document.getElementById('totalPrice')
    .innerText;

    let payment =
    document.getElementById('paymentMethod')
    .value;

    fetch('/checkout', {

        method:'POST',

        headers:{

            'Content-Type':'application/json',

            'X-CSRF-TOKEN':
            document.querySelector(
            'meta[name="csrf-token"]')
            .content
        },

        body:JSON.stringify({

            total:total,

            payment_method:payment,

            items:cart

        })

    })

    .then(res => res.json())

    .then(data => {

        document.getElementById('popup')
        .innerHTML = `

        <div class="popup">

            <h1 style="font-size:60px;">
                ☕
            </h1>

            <h2>
                Terima Kasih
            </h2>

            <p style="margin-top:10px;">
                Pesanan berhasil dibuat
            </p>

            <br>

            <button onclick="location.reload()"
            style="
                padding:12px 25px;
                border:none;
                background:#ff6b4a;
                color:white;
                border-radius:10px;
                cursor:pointer;
            ">
                Back to Dashboard
            </button>

        </div>

        `;
    });
}
</script>

</body>
</html>