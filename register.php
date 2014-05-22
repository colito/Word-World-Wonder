<?php
$page_name = 'Registration';
require_once('includes/head.php');
?>

    <div id="heading" class="grid_12">
        <h3>Get yourself registered</h3>
    </div>

    <div id='form' class='grid_7 omega'>
        <?php

            if(!empty($_GET['registration_success']))
            {
                if($_GET['registration_success'] == 'success')
                {
                    echo "<p class='success'>Your registration was successful. </p>";
                    echo "<p class='success'>Click <a href='../word_world_wonder'>here</a> to access the home page</p>";
                    return;
                }
                else
                {
                    echo $_GET['registration_success'];
                }
            }

            if(empty($_GET['registration']) && empty($_GET['registration_success']))
            {
                echo "<p>All fields marked with <i>*</i> are compulsory</p>";
				
				$errors["email"] = "";
				$errors["surname"] = "";
				$errors["name"] = "";
				$errors["user_name"] = "";
				$errors["dob"] = "";
				$errors["password"] = "";
				$errors["password_confirm"] = "";
            }
            else if(!empty($_GET['registration']))
            {
                echo "<p class='error'>There are errors!</p>";

                $values = unserialize($_GET['registration']);
                $valid = $values["valid"];
                $errors = $values["errors"];
            }
			
			if(empty($valid["email"]))
			{
				$valid["email"] = "";
			}
			if(empty($valid["name"]))
			{
				$valid["name"] = "";
			}
			if(empty($valid["surname"]))
			{
				$valid["surname"] = "";
			}
			if(empty($valid["user_name"]))
			{
				$valid["user_name"] = "";
			}
			if(empty($errors["password"]))
			{
				$errors["password"] = "";
			}
			if(empty($errors["password_confirm"]))
			{
				$errors["password_confirm"] = "";
			}

        ?>

        <form action='validation/registration_validation.php' method='post'>
            <dl>
                <dt>
                    <dd><label for='name'>Name:</label></dd>
                    <dd><input name='name' id='name' type='text' value='<?php echo $valid['name'];?>'></dd>
                </dt>

                <dt>
                    <dd><label for='surname'>Surname:</label></dd>
                    <dd><input name='surname' id='surname' type='text' value='<?php echo $valid['surname'];?>'></dd>
                </dt>

                <dt>
                    <dd><label for='user_name'>Preferred User Name:<i>*</i></label></dd>
                    <dd><b class="error"><?php echo $errors["user_name"];?></b></dd>
                    <dd><input name='user_name' id='user_name' type='text' value="<?php echo $valid['user_name'];?>"></dd>
                </dt>

                <dt>
                    <dd><label for='gender'>Gender:<i>*</i></label></dd>
                    <dd><input name='gender' id='gender' type='radio' value="1" checked="true">Male</dd>
                    <dd><input name='gender' id='gender' type='radio' value="2">Female</dd>
                </dt>

                <dt>
                    <dd><label for='email'>Email:<i>*</i></label></dd>
                    <dd><b class="error"><?php echo $errors["email"];?></b></dd>
                    <dd><input name='email' id='email' type='text' class='required' value="<?php echo $valid['email'];?>"></dd>
                </dt>

                <dt>
                    <dd><label for='password'>Password:<i>*</i></label></dd>
                    <dd><b class="error"><?php echo $errors["password"];?></b></dd>
                    <dd><input name='password' id='password' type='password'></dd>
                </dt>

                <dt>
                    <dd><label for='password_confirm'>Confirm Password:<i>*</i></label></dd>
                    <dd><b class="error"><?php echo $errors["password_confirm"];?></b></dd>
                    <dd><input name="password_confirm" id="password_confirm" type="password"></dd>
                </dt>

                <dt>
                    <dd>Date of Birth:<i>*</i></dd>
                    <dd><b class="error"><?php echo $errors["dob"];?></b></dd>
                    <dd>
                        <select name="day_of_birth" id="day_of_birth">
                            <option>Select day</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                        </select>

                        <select name="month_of_birth" id="month_of_birth">
                            <option>Select month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>

                        <select name="year_of_birth" id="year_of_birth">
                            <option>Select year</option>
                            <option>1950</option>
                            <option>1951</option>
                            <option>1952</option>
                            <option>1953</option>
                            <option>1954</option>
                            <option>1955</option>
                            <option>1956</option>
                            <option>1957</option>
                            <option>1958</option>
                            <option>1959</option>
                            <option>1960</option>
                            <option>1961</option>
                            <option>1962</option>
                            <option>1963</option>
                            <option>1964</option>
                            <option>1965</option>
                            <option>1966</option>
                            <option>1967</option>
                            <option>1968</option>
                            <option>1969</option>
                            <option>1970</option>
                            <option>1971</option>
                            <option>1972</option>
                            <option>1973</option>
                            <option>1974</option>
                            <option>1975</option>
                            <option>1976</option>
                            <option>1977</option>
                            <option>1978</option>
                            <option>1979</option>
                            <option>1980</option>
                            <option>1981</option>
                            <option>1982</option>
                            <option>1983</option>
                            <option>1984</option>
                            <option>1985</option>
                            <option>1986</option>
                            <option>1987</option>
                            <option>1988</option>
                            <option>1989</option>
                            <option>1990</option>
                            <option>1991</option>
                            <option>1992</option>
                            <option>1993</option>
                            <option>1994</option>
                            <option>1995</option>
                            <option>1996</option>
                            <option>1997</option>
                            <option>1998</option>
                            <option>1999</option>
                        </select>

                    </dd>
                </dt>

                <dt>
                    <dd class="submit"><input type="submit" value="Submit" class="btn-submit"></dd>
                </dt>
            </dl>
        </form>
    </div>


<?php require_once('includes/footer.php'); ?>