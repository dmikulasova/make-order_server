<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);

// connect to the mysql database
$link = mysqli_connect('localhost', 'id1140352_localhost', 'password', 'id1140352_make_order');
mysqli_set_charset($link,'utf8');

if ($link->connect_errno) {
    printf ("Connect failed: %s\n", $link->connect_error);
    exit(1);
}

//$result = $link->query("select * from customer");

// create SQL based on HTTP method
if ($method =='GET') {
    $sql = "select * from customer";
  }

// excecute SQL statement
$result = mysqli_query($link,$sql);


// die if SQL statement failed
if (!$result) {

  http_response_code(404);
  exit(1);
}
echo '[';
// print results, insert id or affected row count
if ($method == 'GET') {
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }

}
echo ']';
// close mysql connection
mysqli_close($link);

?>
