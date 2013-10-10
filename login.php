<?php
$page_name = 'Login';
require_once('includes/head.php');
?>



    <div id="form" class="grid_5">
        <h3>Login</h3>

        <?php
            if(empty($_GET["login"]))
            {
                echo "<p>Please enter your login details</p>";
				$errors["email"] = "";
				$errors["password"] = "";
            }
            else
            {
               $values = unserialize($_GET["login"]);
               $valid = $values["valid"];
               $errors = $values["errors"];

               echo "<p class='error'>".$errors[0]."</p>";
			}
            
			if(empty($valid["email"]))
			{
				$valid["email"] = "";
			}
        ?>

        <form method="post" action="validation/login_validation.php">
            <dl>
                <dt>
                    <dd><label for='email'>Email:</label></dd>
                    <dd><p class="error"><?php echo $errors["email"];?></p></dd>
                    <dd><input name="email" id="email" type="text" value="<?php echo $valid["email"] ?>"></dd>
                </dt>
                <dt>
                    <dd><label for="name">Password:</label></dd>
                    <dd><p class="error"><?php echo $errors["password"];?></p></dd>
                    <dd><input name="password" id="password" type="password"></dd>
                </dt>
                <dt>
                    <dd class="submit"><input type="submit" value="Login" class="btn-submit"></dd>
                </dt>
            </dl>
        </form>
    </div>

<?php require_once('includes/footer.php'); ?>