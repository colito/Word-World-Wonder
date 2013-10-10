<?php
$page_name = 'Add Your Piece';
require_once('includes/head.php');
?>

    <div id="heading" class="grid_12">
        <h3>Add Your Piece</h3>
    </div>

     <div id="autor_area" class="grid_8">
        <form method="post">
            <input type="text" name="piece_name" id="piece_name" placeholder="Title">
            <textarea name=""></textarea>
            <input type="submit" value="Save" id="btn-save">
        </form>
     <div>

<?php require_once('includes/footer.php'); ?>