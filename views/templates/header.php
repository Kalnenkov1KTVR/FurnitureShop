<!DOCTYPE HTML>
<html>

    <head>
        <title>textured_blue</title>
        <meta name="description" content="website description" />
        <meta name="keywords" content="website keywords, website keywords" />
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" /> 

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>       
        <!-- start light_box -->
        <link rel="stylesheet" type="text/css" href="style/jquery.fancybox.css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox-1.2.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("div.fancyDemo a").fancybox();
            });
        </script>
        <!--  webfonts  -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>   
        <div id="main">    
            <div id="header">
                <div id="logo">
                    <div id="logo_text">
                        <!-- class="logo_colour", allows you to change the colour of the text -->
                        <h1><a href="index.php">textured<span class="logo_colour">blue</span></a></h1>
                        <h2>Simple. Contemporary. Website Template.</h2>
                        <a  href="admin/index.php"><h2>Log in</h2></a>
                    </div>
                </div>   
                <div id="menubar">          
                    <ul id="menu">

                        <?php
                        $db = new db();
                        $sql = "SELECT * FROM `menu` ORDER BY `menu`.`menu_order`";
                        $rowsComms = $db->getAll($sql);
                        include 'views/navigation_menu.php';
                        ?>

                    </ul>    
                </div>
                
                <ol class="breadcrumb">
                    <?php
                    $menu_link = '';
                    if (isset($_GET['page'])) { // если установлена передача
                        $page = $_GET['page'];
                        $sql = "SELECT * FROM `menu` WHERE `menu_id` = $page";
                        $rowItm = $db->getOne($sql);

                        $menu_link = MENUTITLE . '<li class="active">' . $rowItm['menu_name'] . '</li>';

                        if (isset($_GET['idCat'])) {
                            $menu_link = MENUTITLE . '<li><a href="' . INDEX . '?page=' . $page . '">' . $rowItm['menu_name'] . '</a></li>';
                            $idCat = $_GET['idCat'];
                            $sqlCat = "SELECT * FROM `categories` WHERE `category_id` = " . $idCat;
                            $rowCat = $db->getOne($sqlCat);
                            if (!isset($_GET['idItem'])) {
                                $menu_link .= '<li class="active">' . $rowCat['category_name'] . '</li>';
                            }
                            if (isset($_GET['idItem'])) {
                                $menu_link .= '<li><a href="' . INDEX . '?page=' . $page . '&idCat=' . $idCat . '">' . $rowCat['category_name'] . '</a></li>';
                                $idItem = $_GET['idItem'];
                                $sqlItem = "SELECT * FROM `items` WHERE `item_id` = " . $idItem;
                                $rowItem = $db->getOne($sqlItem);
                                $menu_link .= '<li class="active">' . $rowItem['item_name'] . '</li>';
                            }
                        }
                    } else {
                        $menu_link = '<li class="active">Главная</li>';
                    }
                    echo $menu_link;
                    ?>
                </ol>
                
            </div>

            <div id="site_content">

                <div class="sidebar">

                    <h3>Категории мебели: </h3>

                    <?php
                    $sqlCat = "SELECT * FROM `categories` ORDER BY `categories`.`category_name`";
                    $rowsCat = $db->getAll($sqlCat);
                    $page = 2;
                    foreach ($rowsCat as $rowCat) {
                        echo '<li><a href="' . INDEX . '?page=' . $page . '&idCat=' . $rowCat['category_id'] . '">' . $rowCat['category_name'] . '</a></li>';
                    }
                    
                    echo '<li><a href="' . INDEX . '?page=2">Все категории</a></li>';
                    ?>

                    <h3>Поиск</h3>
                    <form method="GET" role="search"">
                        <p>
                            <input type="hidden" name="page" id="page" value="2">
                            <input class="search" type="text" name="search" placeholder="..." />
                            <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
                        </p>
                    </form>

                    
                </div>

                <div id="content">

