<?php
include 'connect.php';

if ($method =='POST') {
    $input = file_get_contents('php://input');
    if (isset($input)) {
      $request = json_decode($input);
      $username=$request->username;
      $password=$request->password;
      if ($username != "" && $password!= "") {
          $sql ="select * from customer where username='$username' and password='$password';";

           // excecute SQL statement
           $result = mysqli_query($link,$sql);

           // die if SQL statement failed
           if (!$result) {
             echo "Database error";
             header("HTTP/1.0 404 Database error");
           }
           if (mysqli_num_rows($result) != 1) {
             $sql ="select * from customer where username='$username';";
             $result_user = mysqli_query($link,$sql);
             if (mysqli_num_rows($result_user)==1) {
               echo "wrong password";
               header("HTTP/1.0 404 Wrong password");
             }else{
               echo "user does not exist";
               header("HTTP/1.0 404 User not found");
             }

           }else if(mysqli_num_rows($result) == 1) {
            //everything good
             echo '[';
             // print results, insert id or affected row count
               for ($i=0;$i<mysqli_num_rows($result);$i++) {
                 echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
               }
             echo ']';
           }

        }else if ($username!="" && $password == "") {
          echo "You must type password";
          header("HTTP/1.0 404 No password");
        }else {
          echo "You must type username";
          header("HTTP/1.0 404 No username");
        }
    }
}
  mysqli_close($link);
 ?>
