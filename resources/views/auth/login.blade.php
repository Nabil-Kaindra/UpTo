<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Heading */
        h2,h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Styles */
        form table {
            width: 100%;
            margin: 0 auto;
        }

        form table td {
            padding: 10px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Submit Button */
        button[type="submit"] {
            background-color: #4A90E2;
            color: white;
            padding: 10px 20px;
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
    <div class="login-container">
        <h2>Login</h2>
        <h3>DASHBOARD DOKUMENTASI KEGIATAN</h3>
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('postLogin') }}" method="POST">
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
                    <td colspan="2" style="text-align:center;">
                        <p>Belum punya akun?
                            <a href="{{ route('register.form') }}">Daftar di sini</a>
                        </p>
                        <button type="submit">Login</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
