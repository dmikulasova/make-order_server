<?php
include 'connect.php';

if ($method =='POST') {
    $input = file_get_contents('php://input');
    if (isset($input)) {
      $request = json_decode($input);
      $id_customer= $request->id_customer;
      $id_table= $request->id_table;
      $food= $request->food;
      //ceate new order
      $sql ="insert into newOrder (id_customer, id_table) values ($id_customer, $id_table);";

       // excecute SQL statement
       $result = mysqli_query($link,$sql);
       if (!$result) {
         echo "broken database";
         header("HTTP/1.0 404 Database error 1");
       }
       //get id of new order
       $sql="select id from newOrder where id_customer=$id_customer and edit=1;";
       $result=mysqli_query($link, $sql);

       if (!$result) {
         echo "broken database";
         header("HTTP/1.0 404 Database error 2");
       }
       //insert food to order
       if (mysqli_num_rows($result) == 1) {
         $row = $result->fetch_assoc();
         $id_order=$row["id"];

         $sql="update newOrder set edit=0 where id=$id_order;";
         $result=mysqli_query($link, $sql);
         if (!$result) {
           echo "broken database";
           header("HTTP/1.0 404 Database error 3");
         }
         foreach ($food as $item) {
           $sql="insert into ordered(id_order, id_food, quantity) values ($id_order, $item->id, $item->quantity);";
           $result=mysqli_query($link, $sql);

           if(!$result){
             echo "database error";
             header("HTTP/1.0 404 Database error 4");
           }
           //echo $item->id;
           //echo $item->quantity;
         }

       }

    }
}
mysqli_close($link);
?>
