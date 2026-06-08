<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f4f4f4;
        }

        .card{
            width:350px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        h1{
            text-align:center;
            margin-bottom:30px;
            color:#24364d;
        }

        input{
            width:100%;
            padding:14px;
            border:none;
            background:#f1f1f1;
            border-radius:12px;
            margin-bottom:20px;
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            background:#ff6b4a;
            color:white;
            border-radius:12px;
            cursor:pointer;
            font-size:16px;
        }

        a{
            display:block;
            text-align:center;
            margin-top:20px;
            text-decoration:none;
            color:#ff6b4a;
        }

        .logo{
            text-align:center;
            font-size:60px;
            margin-bottom:15px;
        }

    </style>

</head>
<body>

<div class="card">

    <div class="logo">
        ☕
    </div>

    <h1>
        Create Account
    </h1>

    <form action="/register" method="POST">

        @csrf

        <input
        type="text"
        name="username"
        placeholder="Username">

        <input
        type="password"
        name="password"
        placeholder="Password">

        <button type="submit">
            Register
        </button>

    </form>

    <a href="/">
        Back to Login
    </a>

</div>

</body>
</html>