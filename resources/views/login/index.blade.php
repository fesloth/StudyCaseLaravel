<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "MontSerrat", sans-serif;
            background-color: #4B3832;
        }

        .card {
            width: 300px;
            padding: 50px;
            padding-top: 20px;
            border: 2px solid transparent;
            border-radius: 5px;
            background-color: #dacdb7;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        }

        .card h1 {
            text-align: center;
            color: #8A583C;
        }

        .card label {
            display: block;
            margin-bottom: 10px;
        }

        .card input[type="text"],
        .card input[type="password"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px;
            border-radius: 3px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .card button[type="submit"] {
            max-width: 100%;
            padding: 10px 3px;
            border: none;
            border-radius: 5px;
            background-color: #8A583C;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-family: sans-serif;
            margin-top: 10px;
        }

        .card button[type="submit"]:hover {
            background-color: #B89685;
        }

        .image img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            box-shadow: 0px 0px 10px #1c1e40;
        }

        .image {
            text-align: center;
        }

        p {
            text-align: end;
            color: #4B3832;
        }

        i {
            opacity: 0.8;
        }

        @media screen and (max-width: 600px) {
            .card {
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <form id="login-form" action="" method="post">
        @csrf
        @method('post')
        <div class="card">
            <h1>Login</h1>
            <label for="username">Username <i class="fas fa-user"></i>:</label>
            <input type="text" id="username" name="username" placeholder="username..." />

            <label for="password">Password <i class="fas fa-key"></i>:</label>
            <input type="password" id="password" name="password" placeholder="password..." />

            <button type="submit" name="submit">Login</button> <br>
            <p>don't have an account? <br>
                <a href="/registration">create account</a>
            </p>
        </div>
    </form>
    @if($message = Session::get('failed'))
    <script>
        alert('Email atau Password salah')
    </script>
    @endif
    @if($message = Session::get('success'))
    <script>
        alert('Selamat registrasi berhasil! Silahkan login kembali.')
    </script>
    @endif
</body>

</html>