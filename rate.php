<?php
include 'connect.php';

if ($method =='POST') {
  $input = file_get_contents('php://input');
  if (isset($input)) {
    $request = json_decode($input);
    $id_food=$request->id_food;
    $rate=$request->rate;

    $sql ="select * from food where id='$id_food';";
     // excecute SQL statement
     $result = mysqli_query($link,$sql);

            if (!result) {
              echo "database error";
              header("HTTP/1.0 404 Database error");
            }
     if (mysqli_num_rows($result) == 1) {
       $row = $result->fetch_assoc();
       $old_rate=$row["rate"];
       $rate_number=$row["rate_number"];

       $rate=($rate+($old_rate*$rate_number))/($rate_number+1);
       $rate_number++;
       $sql="update newOrder set rate=$rate, rate_number=$rate_number where id=$id_food;";
       $result=mysqli_query($link, $sql);

       if (!result) {
         echo "database error";
         header("HTTP/1.0 404 Database error");
       }

}
  mysqli_close($link);
 ?>
