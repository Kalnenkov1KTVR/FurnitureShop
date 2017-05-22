<?php
session_start();

if (!isset($_SESSION["rank"]) || ($_SESSION["rank"] != "admin")) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <!-- ajaxupload - скрипт для загрузки файлов на сервер -->        
        <script type="text/javascript" src="js/ajaxupload.3.5.js"></script>

    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" id="title" href="#"> Title </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a id="categories" href="#">Categories</a></li>
                        <li><a id="items" href="#">Items</a></li>
                        <li><a id="images" href="#">Images</a></li>
                        <li><a id="comments" href="#">Comments</a></li>
                        <li><a id="logout" href="#" style="margin-left: 250px;">
                                
                                <?php echo $_SESSION["rank"] . " "; ?>
                                
                                <span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
                        <li><a  href="../index.php" target=_blank >
                                <span class="glyphicon glyphicon-home"></span> Web site</a></li>			
                    </ul><!--id="leht"-->

                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        <div id="main" class="container">
            <h3>HEADING</h3>
            <div class="row">
                <div class="col-md-9">
                    <p>Sampletext.</p>
                </div>


                <div class="clearfix visible-lg"></div>
            </div>
        </div>

        <script type="text/javascript">
            $("#categories").click(function () {
                $("#main").load("content/categories.php");
            });
            $("#items").click(function () {
                $("#main").load("content/items.php");
            });
            $("#images").click(function () {
                $("#main").load("content/images.php");
            });
            $("#comments").click(function () {
                $("#main").load("content/comments.php");
            });
            $("#logout").click(function () {

                document.location.href = "actions/logout.php";
            });
            $("#leht").click(function () {
                document.location.href = "../index.php";
            });
        </script>
    </body>
</html>
