<?php
  include 'connect.php';

  if($method=='POST'){
  $input = file_get_contents('php://input');
  if (isset($input)) {
    $request = json_decode($input);
    $id_customer= $request->id_customer;
    $sql ="SELECT id FROM newOrder WHERE id_customer=$id_customer AND paid=0;";
     // excecute SQL statement
   }
 }else if ($method == 'GET') {
   $sql ="SELECT id FROM newOrder WHERE paid=0;";
 }
     $result = mysqli_query($link,$sql);
     if (!$result) {
       echo "broken database";
     }else { //good
       $food = array();
       for($i=0; $i < mysqli_num_rows($result); $i++){

          $row = $result->fetch_assoc();
          $food[$i]=$row["id"];
          $sql="SELECT food.name,food.price, food.rate, ordered.id_food, ordered.id_order, ordered.quantity, newOrder.id_table, newOrder.id_customer FROM food
          INNER JOIN ordered ON food.id= ordered.id_food
          INNER JOIN newOrder ON newOrder.id= ordered.id_order
          WHERE ordered.id_order=$food[$i];";
          $result2 = mysqli_query($link,$sql);
          if (!$result2) {
            echo "broken database 2";
          }else {
            // print results, insert id or affected row count
              for ($j=0;$j<mysqli_num_rows($result2);$j++) {
                echo ($j>0?',':'').json_encode(mysqli_fetch_object($result2));
              }
          }
       }

     }


  mysqli_close($link);
?>
