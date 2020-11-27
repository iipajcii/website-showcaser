<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login Form</h1>
    <form action="{{route('dashboard')}}" method="post">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username"/>
        <label for="password">Password</label>
        <input type="password" name="password">
        <input type="submit" value="Login"/>
    </form>
</body>
</html>
