[page:Add Your Piece]
<?php
if(!empty($_POST['blog_text']))
{
    $entry_text = $_POST['blog_text'];
    var_dump($entry_text);
}
?>

    <div id="heading" class="grid_12">
        <h3>Add Your Piece</h3>
    </div>

    <div id="autor_area" class="grid_8">
        <form method="post" action="word/add-piece.php">
            <input type="text" name="piece_name" id="piece_name" placeholder="Title">
            <textarea name="blog_text"><?php if(!empty($entry_text)) { echo $entry_text;} ?></textarea>
            <input type="submit" value="Save" id="btn-save">
        </form>
    <div>