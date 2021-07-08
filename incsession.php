<?php


// Check for a cookie, if none go to login page
if (!isset($_COOKIE['session_id']))
{
    header('Location: login.php?refer='. urlencode(getenv('REQUEST_URI')));
}

// Try to find a match in the database
$guid = $_COOKIE['session_id'];
$con = mysqli_connect("localhost","109306066","109306066","hands-up_user");

$query = "SELECT ID FROM user WHERE guid = '$guid'";
$result = mysqli_query($con,$query);

if (!mysqli_num_rows($result))
{
    // No match for guid
header('Location: loginframe.html?refer='. urlencode(getenv('REQUEST_URI')));
}
?>