<?php 
header("Content-Type: text/html; charset=utf8");
$name=$_POST['UserID'];//post獲取表單裡的name
$password=$_POST['Password'];//post獲取表單裡的password
require_once 'connect.php';//連結資料庫
$q="insert into user(ID,UserID,Password) values (null,'$name','$password')";//向資料庫插入表單傳來的值的sql
$reslut=mysqli_query($con,$q);//執行sql
if (!$reslut){
die('Error: ' . mysqli_error());//如果sql執行失敗輸出錯誤
}else{
echo "註冊成功";//成功輸出註冊成功
}
mysqli_close($con);//關閉資料庫
?>