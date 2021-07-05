<?php 
header("Content-Type: text/html; charset=utf8");
require_once 'connect.php';
$name = $_POST['UserID'];
$passowrd = $_POST['Password'];
if ($name && $passowrd){//如果使用者名稱和密碼都不為空
$sql = "select * from user where UserID = '$name' and Password='$passowrd'";//檢測資料庫是否有對應的username和password的sql
$result = mysqli_query($con,$sql);//執行sql
$rows=mysqli_num_rows($result);//返回一個數值
if($rows){//0 false 1 true
header("refresh:0;url=C:/xampp/htdocs/Hands-up/Welcome.html");//如果成功跳轉至welcome.html頁面
exit;
}else{
echo "使用者名稱或密碼錯誤";
echo "
<script>
setTimeout(function(){window.location.href='loginframe.html';},1000);
</script>
";
}
}else{//如果使用者名稱或密碼有空
echo "表單填寫不完整";
echo "
<script>
setTimeout(function(){window.location.href='login.html';},1000);
</script>";
//如果錯誤使用js 1秒後跳轉到登入頁面重試;
}
mysql_close($con);//關閉資料庫
?>