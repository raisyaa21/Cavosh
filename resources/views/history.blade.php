<!DOCTYPE html>
<html>
<head>
    <title>History</title>

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
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
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

        .title{
            margin-bottom:30px;
        }

        .history-container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
            gap:20px;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .icon{
            font-size:40px;
        }

        .payment{
            padding:8px 15px;
            border-radius:20px;
            background:#ff6b4a;
            color:white;
            font-size:14px;
        }

        .total{
            font-size:28px;
            font-weight:bold;
            margin-top:20px;
            color:#24364d;
        }

        .date{
            margin-top:15px;
            color:gray;
            font-size:14px;
        }

        .empty{
            background:white;
            padding:40px;
            border-radius:20px;
            text-align:center;
        }

    </style>

</head>
<body>

<div class="sidebar">

    <h1>Cavosh</h1>

    <a href="/dashboard">
        Dashboard
    </a>

    <a href="/history"
    class="active">
        History
    </a>

    <a href="/logout">
        Logout
    </a>

</div>

<div class="content">

    <div class="title">

        <h1>
            Transaction History
        </h1>

        <p>
            Your recent cafe orders
        </p>

    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:25px;">
            {{ session('success') }}
        </div>
    @endif

    @if($transactions->count() > 0)

    <div class="history-container">

        @foreach($transactions as $transaction)

        <div class="card">

            <div class="top">

                <div class="icon">
                    ☕
                </div>

                <div class="payment">
                    {{ $transaction->payment_method }}
                </div>

            </div>

            <div class="total">

                Rp {{ number_format($transaction->total) }}

            </div>

            <div class="date">

                {{ $transaction->created_at }}

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="empty">

        <h2>
            No Transaction Yet ☕
        </h2>

        <p style="margin-top:10px;">
            Start ordering your favorite coffee
        </p>

    </div>

    @endif

</div>

</body>
</html>