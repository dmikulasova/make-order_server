<?php
include 'connect.php';

if ($method =='POST') {
    $input = file_get_contents('php://input');
    if (isset($input)) {
      $request = json_decode($input);
      $firstName = $request->firstName;
      $surname=$request->surname;
      $email=$request->email;
      $creditCard=$request->creditCard;
      $username=$request->username;
      $password=$request->password;


      if ($username != "" && $password != "") {
          $sql ="insert into customer(firstName, surname, email, creditCard, username, password)
           VALUES ('$firstName', '$surname','$email', '$creditCard', '$username', '$password');";

           // excecute SQL statement
           $result = mysqli_query($link,$sql);

           // die if SQL statement failed
           if (!$result) {
             http_response_code(404);
             exit(1);
           }else{
             echo "success";
           }
        }else { //not first name
          echo "Empty username parameter!";
        }
      }else { //wrong input
          echo "Not called properly with username parameter!";
      }

  }
mysqli_close($link);
?>
