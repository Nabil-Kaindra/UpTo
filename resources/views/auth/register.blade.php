<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f6fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Centered Container */
        .register-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Heading */
        h2, h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Styles */
        form {
            width: 100%;
        }

        form table {
            width: 100%;
        }

        form table td {
            padding: 10px;
            text-align: left;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Submit Button */
        button[type="submit"] {
            background-color: #4A90E2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #357ABD;
        }

        /* Link Styles */
        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: #4A90E2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun</h2>
        <h3>DASHBOARD DOKUMENTASI KEGIATAN</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" required autofocus></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Konfirmasi Password</td>
                    <td><input type="password" name="password_confirmation" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Daftar</button>
                    </td>
                </tr>
            </table>
        </form>
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</body>
</html>
