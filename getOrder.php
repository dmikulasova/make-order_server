<?php
  include 'connect.php';

  if($method=='POST'){
    $input = file_get_contents('php://input');
    if (isset($input)) {
      $request = json_decode($input);
      $id_customer= $request->id_customer;

      $sql ="SELECT id FROM newOrder AS n WHERE id_customer=$id_customer AND paid=0;";
       // excecute SQL statement
     }
   }else if ($method == 'GET') {
     $sql ="SELECT id FROM newOrder AS n WHERE paid=0;";
   }
       $result = mysqli_query($link,$sql);
       if (!$result) {
         echo "broken database";
       }else { //good
         $food = array();
         for($i=0; $i < mysqli_num_rows($result); $i++){
           echo '[';
            $row = $result->fetch_assoc();
            $food[$i]=$row["id"];

            $sql="SELECT food.name,food.price, food.rate, ordered.id_food, ordered.id_order, ordered.quantity FROM food LEFT JOIN ordered ON food.id= ordered.id_food WHERE ordered.id_order=$food[$i];";
            $result = mysqli_query($link,$sql);
            if (!$result) {
              echo "broken database";
            }else {
              // print results, insert id or affected row count
                for ($i=0;$i<mysqli_num_rows($result);$i++) {
                  echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
                }
            }
         }
         echo ']';
       }





  mysqli_close($link);
?>
