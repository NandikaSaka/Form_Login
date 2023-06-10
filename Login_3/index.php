<!DOCTYPE html>
<html>
<head>
    <title>Login and Register Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="register-container">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="alamat" placeholder="Alamat" required>
                <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" required>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
