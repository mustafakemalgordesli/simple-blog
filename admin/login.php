<?php
include("../config/dbconnect.php");
session_start();
if (isset($_SESSION['user'])) {
    Header('Location: ./index.php');
    exit();
}
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $salt = 'ultrasuperkey';
        $passwordHash = md5($password . $salt);
        $query = 'Select * FROM users WHERE username="' . $username . '"';;
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['role'] == "Admin" && $row['password'] == $passwordHash) {
                $_SESSION['user'] = $row;
                Header("Location: ./index.php");
                exit();
            } else {
                echo "<script>alert('Giriş Yapılamadı')</script>";
            }
        } else {
            echo "<script>alert('Giriş Yapılamadı')</script>";
        }
    }
} catch (\Throwable $th) {
    echo "<script>alert('Giriş Yapılamadı')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-bg: #e91e63;
        }

        .main-bg {
            background: var(--main-bg) !important;
        }

        input:focus,
        button:focus {
            border: 1px solid var(--main-bg) !important;
            box-shadow: none !important;
        }

        .form-check-input:checked {
            background-color: var(--main-bg) !important;
            border-color: var(--main-bg) !important;
        }

        .card,
        .btn,
        input {
            border-radius: 0 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-6 col-sm-6 border pb-3 bg-light rounded">
                <div class="card-title text-center border-bottom">
                    <h2 class="pt-3 pb-1">Login</h2>
                </div>
                <form id="loginForm" method="POST">
                    <div class="mb-3 form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required />
                    </div>
                    <div class="mb-3 form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn text-light main-bg" form="loginForm">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>