<?php
$username = 'admin';
$password = 'admin';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($username == 'admin' && $password == '123') {
            session_start();
            $_SESSION["authenticated"] = 'true';
            header('Location: ./admin.php?page=data');
            exit();
        } else {
            header('Location: ./index.php');
            exit();
        }

    } else {
        header('Location: ./index.php');
        exit();
    }
} else {
    ?>


                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Sign in</title>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <link rel="stylesheet" href="./style.css"> 
                        </head>
                        <body>
                            <form id="login" method="POST">
                                <h3>Login Here</h3>
      
                                <label for="username">Username</label>
                                <input type="text" placeholder="username" name="username" id="username">
      
                                <label for="password">Password</label>
                                <input type="password" placeholder="password" name="password" id="password">
                                <br>

                                <button name="login" type="submit" class="g-recaptcha" 
                               >Log In</button>

                              </form>
                        </body>
                        </html>

<?php } ?>