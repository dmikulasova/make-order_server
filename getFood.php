<?php
include 'connect.php';

if ($method =='GET') {
  $sql ="select * from food;";
  $result = mysqli_query($link,$sql);
   if (!$result) {
     echo "something went wrong";
   }else {
     echo '[';
     // print results, insert id or affected row count
       for ($i=0;$i<mysqli_num_rows($result);$i++) {
         echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
       }
     echo ']';
   }
}
  mysqli_close($link);
?>
