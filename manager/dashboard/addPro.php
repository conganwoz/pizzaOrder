<?php
session_start();
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if(empty($name)||empty($password)){
  header('Location: thank.php');
}

?>



<?php
//check for the submit
//messageg var
$msg = '';
$msgClass = '';
if(filter_has_var(INPUT_POST,'submit')){
  //get form data
  $name = htmlspecialchars($_POST['name']);
  $origin = htmlspecialchars($_POST['origin']);
  $img = htmlspecialchars($_POST['img']);
  $chef = htmlspecialchars($_POST['chef']);
  $describle = htmlspecialchars($_POST['describle']);
  $price = htmlspecialchars($_POST['price']);
  //check required Feilds
  if(!empty($name) && !empty($origin) && !empty($img) && !empty($chef) && !empty($describle)){
    //passed
    //check email

      //do when evarythings good
      $connIn = mysqli_connect('localhost','root','123456','pizzaprod');
      //check connect
      if(mysqli_connect_errno()){
        echo 'Failed to conect to MySql '.mysqli_connect_errno();
      }
      $queryChange = "INSERT INTO product(name,origin,img,chef,describle) VALUES('$name','$origin','$img','$chef','$describle')";
      $queryPrice = "INSERT INTO price(price) VALUES('$price')";
      if(mysqli_query($connIn,$queryChange)&&mysqli_query($connIn,$queryPrice)){
        $msg = 'Add successed!';
        $msgClass = 'alert-success';
      }else{
        echo 'error'.mysqli_error($connIn);
      }

  }else{
    $msg = 'Please fill in all the fields';
    $msgClass = 'alert-danger';
  }
}
?>



<?php

//create connect
$conn = mysqli_connect('localhost','root','123456','pizzaprod');
//check connect
if(mysqli_connect_errno()){
  echo 'Failed to conect to MySql '.mysqli_connect_errno();
}
?>

<?php
  $query = 'SELECT * FROM product WHERE id=1';
  $result = mysqli_query($conn,$query);
  $pizza = mysqli_fetch_all($result,MYSQLI_ASSOC);
  //var_dump($pizza);
  mysqli_free_result($result);
  mysqli_close($conn);


?>

<?php include('header.php');?>
<div class="container">
  <?php if($msg != ''):?>
    <div class="alert <?php echo $msgClass;?>">
      <?php echo $msg;?>
    </div>
  <?php endif;?>
  <button type="button" id="back" class="btn btn-primary">Back</button>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <fieldset>
    <legend>Change Pizza Property</legend>
    <div class="form-group">
      <label for="pizzaName">Name</label>
      <input name="name" type="text" class="form-control" id="pizzaName" placeholder="<?php echo $pizza[0]['name'];?>">
    </div>
    <div class="form-group">
      <label for="Origin">Origin</label>
      <input name="origin" type="text" class="form-control" id="Origin" placeholder="<?php echo $pizza[0]['origin'];?>">
    </div>


    <div class="form-group">
      <label for="img">Img</label>
      <input name="img" type="text" class="form-control" id="img" placeholder="<?php echo $pizza[0]['img'];?>">
    </div>

    <div class="form-group">
      <label for="chef">chef</label>
      <input name="chef" type="text" class="form-control" id="chef" placeholder="<?php echo $pizza[0]['chef'];?>">
    </div>

    <div class="form-group">
      <label for="descible">descible</label>
      <input name="describle" type="text" class="form-control" id="descible" placeholder="<?php echo $pizza[0]['describle'];?>">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input name="price" type="text" class="form-control" id="price" placeholder="20"><span>$</span>
    </div>






  </fieldset>
      <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">ADD</button>
</form>
</div>
<script type="text/javascript">
$('#back').click(()=>{
  $(location).attr('href', 'ordersinfo.php');
});

</script>
<?php include('footer.php');?>
