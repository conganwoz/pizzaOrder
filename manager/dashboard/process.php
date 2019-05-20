<?php
echo "processing..........";

//connect with database
$conn = mysqli_connect('sql7.freemysqlhosting.net','sql7292489','n8UWR1v9YX','sql7292489');

// check if post value is set
if(isset($_POST['id'])){
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  //echo 'POST: your name is: '. $_POST['name'];
  $query = "UPDATE orders SET done=1 WHERE id=".$id;
  if(mysqli_query($conn, $query)){
    echo 'Change success...';
  }else {
    echo 'ERROR: '. mysqli_error($conn);
  }
}
