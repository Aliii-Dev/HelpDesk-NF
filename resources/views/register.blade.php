<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | HelpDesk NF</title>
    <link rel="stylesheet" href="/assets/css/login.css" />
</head>

<body>
    <div class="wrapper">
        <form action="#">
            <h2>Register</h2>
            <div class="input-field">
                <input type="text" required />
                <label>Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" required />
                <label>Enter your password</label>
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember" />
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log In</button>
            <div class="register">
                <p>already have an account? <a href="login.html">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>
