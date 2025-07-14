{{-- resources/views/admin/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>

<body>
    <div class="background">
        <div class="blob1"></div>
        <div class="blob2"></div>
        <div class="blob3"></div>

        <div class="login-box">
            <h1 class="logo">Admin</h1>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label for="email">EMAIL ADDRESS</label>
                <input type="email" id="email" name="email" required placeholder="Enter email" />

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" required placeholder="Enter password" />

                <button type="submit">LOG IN</button>
            </form>
        </div>
    </div>
</body>

</html>
