<?php
   require_once('fns/runner2.php');
   $blogger = new blogger();

   $page_name = 'Home';
   require_once('includes/head.php');
   //require_once('includes/links.php');
?>
    <div id="heading" class="grid_12">
        <h3>Welcome!</h3>
    </div>

   <div id="content" class="grid_7 omega">
       <p>This is a little demo project to play around with some light weight blogging.</p>
   </div>

<?php require_once('includes/footer.php'); ?>