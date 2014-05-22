<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if(array_key_exists('user_email', $_SESSION))
    if($_SESSION['user_email'] == null)
        $state = 0;
    else
        $state = 1;
else
    $state = -1;
?>

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- Base path: Very important especially when the systems uses clean URLs -->
    {base-url}

    <title>{page-title}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="icon" type="image/png" href="{favicon}">

    <!-- CSS Libraries -->

    <!--{templata:css}-->

    <link rel="stylesheet" href="{template-res:css:normalize.css}" type="text/css" media="screen">
    <link rel="stylesheet" href="{template-res:css:grid.css}" type="text/css" media="screen">
    <link href="http://fonts.googleapis.com/css?family=Armata" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{template-res:css:flexslider.cs}s" type="text/css" media="screen">
    <link rel="stylesheet" href="{template-res:css:style.css}" type='text/css' media="screen">

    <!-- JQuery -->
    {templata:jquery}

</head>

<body {templata:right-click}>

<div id="topper">

    <div id="title">
        <h1><a href="">{templata:app-name}</a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        {navi:desktop}
    </div>

</div>

<div id="panel">
    {navi:mobile}
</div>

<div class="container_12 clearfix">
    <?php //var_dump('State: '.$state);?>
    {body-content}

    <div id='footer' class='grid_12'>
        <div id='copyright'>
            <p>&copy; 2014 Word World Wonder. All Rights Reserved</p>
        </div>
    </div>
</div>

</body>

</html>