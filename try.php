<?php
include 'connect.php';

if ($method =='POST') {
    $input = file_get_contents('php://input');
    echo "1: $input";

    //$input = json_decode($input);

    if (isset($input)) {
echo "aaaaaaaaaaaaa";
      $request = json_decode($input);

      //$firstName = $request->firstName;
      //$surname=$request->surname;
      //$email=$request->email;
      //$creditCard=$request->creditCard;
      $username=$request->username;
      //$password=$request->password;
echo "username: $request->username";
      if ($username != "") {
          //$sql ="insert into customer(firstName, surname, email, creditCard, username, password)
           //VALUES ("+$firstName+", "+$surname+","+$email+", "+$creditCard+", "+$username+", //"+$password+")";
$sql = "insert into customer(username) VALUES ('$username');";
           // excecute SQL statement
           $result = mysqli_query($link,$sql);

           // die if SQL statement failed
           if (!$result) {
echo "Database error.";
             http_response_code(404);
             exit(1);
    }else{
      echo "success.";
       }
        }else {
          echo "Empty username parameter!";
        }
      }
      else {
          echo "Not called properly with username parameter!";
        }

    }
mysqli_close($link);
?>
