<?php
session_start();

if (isset($_SESSION["rank"]) && ($_SESSION["rank"] == "admin")) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Panel</title>

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
    </head>

    <body>

        <div class="container">

            <form id="forma" class="form-signin">

                <div id="login_result"></div>

                <h3 class="form-signin-heading">Введите ваши данные:</h3>
                <input type="text" name="login"  class="form-control" placeholder="Имя пользователя:" autofocus><!--required -->
                <input type="password" name="password" class="form-control" placeholder="Пароль: " ><!--required-->
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

                <p style="padding-top:10px;"><a id="home" href="#">Web Site</a></p>
            </form>		
        </div> <!-- /container -->

        <script src="js/jquery.min.js"></script>


        <script type="text/javascript">
            $("form").submit(function () {
                $.ajax({
                    type: "POST",
                    url: "actions/login.php",
                    data: $("form").serialize(),
                    success: function (data)
                    {
                        if (data === "OK")
                        {
                            location.reload();
                        } else if (data === "no login")
                        {
                            $("#login_result").html('<div class="alert alert-danger">No login.</div>');

                        } else if (data === "no pass")
                        {
                            $("#login_result").html('<div class="alert alert-danger">No password.</div>');

                        } else {
                            $("#login_result").html('<div class="alert alert-danger">Wrong data.</div>');
                        }
                    }
                });

                return false;
            });
        </script>
        <script type="text/javascript">
            $("#home").click(function () {
                document.location.href = "../index.php";
            });
        </script>
    </body>
</html>
