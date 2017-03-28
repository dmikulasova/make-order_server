<?php
include 'connect.php';

if ($method =='POST') {
    $input = json_decode(file_get_contents('php://input'),true);
    if (isset($input)) {
      $request = json_decode($input);
      $username=$request->username;
      $password=$request->password;
      if ($username != "" && $password!= "") {
          $sql ='select * from customer where username="'+$username+'" and password="'+$password+'";';

           // excecute SQL statement
           $result = mysqli_query($link,$sql);

           // die if SQL statement failed
           if (!$result) {
             http_response_code(404);
             exit(1);
           }
           echo '[';
           // print results, insert id or affected row count
             for ($i=0;$i<mysqli_num_rows($result);$i++) {
               echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
             }

           echo ']';
        }
    }
}
  mysqli_close($link);
 ?>
