[page:Profile]
<?php
include_lib('profile_handler');

$user_profile = new profile_handler();

session_start();
$user_email = $_SESSION['user_email'];

$profile = $user_profile->get_user_profile_data($user_email);
$gravatar = $user_profile->get_gravatar($user_email, 250);
?>

    <div id="content" class="grid_4 suffix_8">
        <h3>Your Profile</h3>
    </div>

    <div id="content" class="grid_4 omega">
        <img src="<?php echo $gravatar?>" alt="gravatar">
        <p><a href="https://public-api.wordpress.com/oauth2/authorize?client_id=1854&response_type=code&blog_id=0&state=0c2e682565486e2e50292380feb1aa0d692e32e465cd31b41b72ad2b0bf91d61&redirect_uri=https%3A%2F%2Fen.gravatar.com%2Fconnect%2F%3Faction%3Drequest_access_token">Change Gravatar</a></p>
    </div>

    <div id="content" class="grid_7">
        <h4>Basic Details</h4>

        <p>Name : ........................................................ <?php echo $profile[0]['user_actual_name'] ?></p>
        <p>Surname : ................................................... <?php echo $profile[0]['user_surname'] ?></p>
        <p>Email : ......................................................... <?php echo $profile[0]['user_email'] ?></p>
        <p>Date of birth : ............................................. <?php echo $profile[0]['dob'] ?></p>
        <p><a href="#">Edit profile</a></p>
    </div>