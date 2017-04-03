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
             $sql ="select * from customer where username='$username';";
             $result = mysqli_query($link,$sql);
             if ($result) {
               echo "wrong password";
             }else {
               echo "user does not exist";
             }
           }else { //everything good
             echo '[';
             // print results, insert id or affected row count
               for ($i=0;$i<mysqli_num_rows($result);$i++) {
                 echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
               }

             echo ']';
           }

        }else if ($username!="") {
          echo "You must type password";
        }else {
          echo "You must type username";
        }
    }
}
  mysqli_close($link);
 ?>
