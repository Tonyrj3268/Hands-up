<?php
echo $_POST['UserID'];
$UserID=$_POST['UserID'];
$Password = $_POST['Password'];
$refer=$_POST['refer'];

if ($UserID == '' || $Password == '')
{
    header('Location: login.php?refer='. urlencode($_POST['refer']));

}
else
{
    // Authenticate user
    $con = mysqli_connect("localhost","109306066","109306066","hands-up_user");
    
    $query = "SELECT ID, MD5(UNIX_TIMESTAMP() + ID + RAND(UNIX_TIMESTAMP()))
        guid FROM user WHERE UserID = '$UserID' AND Password= '$Password'";
        
    $result = mysqli_query($con,$query)
    	or die ('Error in query');
    
    if (mysqli_num_rows($result))
    {
        $row = mysqli_fetch_row($result);
        // Update the user record
        $query = "UPDATE user SET guid = '$row[1]' WHERE ID = $row[0]";
            
        mysqli_query($con,$query)
        	or die('Error in query');
        
        // Set the cookie and redirect
        // setcookie( string name [, string value [, int expire [, string path
        // [, string domain [, bool secure]]]]])
        // Setting cookie expire date, 6 hours from now
        $cookieexpiry = (time() + 21600);
        setcookie("session_id", $row[1], $cookieexpiry);

        if (empty($refer) || !$refer)
        {
            $refer = 'index.php';
        }

        header('Location: Welcome.html?refer='. $refer);
    }
    else
    {
        // Not authenticated
        header('Location: loginframe.html?refer='. urlencode($refer));
    }
}
?>