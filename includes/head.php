<?php
    session_start();

    echo '

        <html lang="en">

        <head lang="en">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		    <meta name="viewport" content="width=device-width, initial-scale = 1.3 user-scalable = no">
    ';
    echo '  <title> '.$page_name.' </title>';

    echo '
            <link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    ';

    if($page_name == 'Add Your Piece')
    {
        echo '
            <!-- Place inside the <head> of your HTML -->
            <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
            <script type="text/javascript">
                tinymce.init({
                    selector: "textarea"
                });
            </script>
        ';
    }

    echo '
          </head>
    ';

    echo '
        <div id="topper">
            <div id="title">
                <a href="../wordworld"><h2>Palavra Maravilha do Mundo</h2></a>
            </div>
    ';

    if(isset($_SESSION['user_email']))
    {
        $user_email = $_SESSION['user_email'];

        echo '
            <div id="links" class="animated">
                <a href="validation/log_out.php">Log out</a>
            </div>

            <div id="links">
                <a href="../wordworld">Home</a>&nbsp;
                <a href="add_piece.php">Add</a>&nbsp;
                <a href="profile.php">Profile</a>&nbsp;
            </div>
        ';
    }
    else
    {
        echo '
            <div id="links" class="animated">
                <a href="login.php">Log in</a> | <a href="register.php">Sign up</a>
            </div>
        ';
    }

    echo '
        </div>

        <body>
            <div class="container" xmlns="http://www.w3.org/1999/html">
    ';

?>