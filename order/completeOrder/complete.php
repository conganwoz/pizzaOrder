




<?php
session_start();
function nameDrink($name){
      $na = '';
  switch ($name) {
    case '0':{
      $na = 'No Drink';
      break;}
    case '1':{
      $na = 'Cocacola';
      break;
    }
    case '2':{
      $na = 'pepsi';
      break;
    }
    case '3':{
      $na = 'fanta';
      break;
    }
  }
  return $na;
}
$customRadio = $_SESSION['customRadio'];
$drink = nameDrink($_SESSION['drink']);
$price = $_SESSION['price'];
?>




<?php
//check for the submit
//messageg var
$msg = '';
$msgClass = '';
if(filter_has_var(INPUT_POST,'submit')){
  //get form data
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);
  $address = htmlspecialchars($_POST['address']);
  $orderType = htmlspecialchars($_POST['orderType']);
  $unitprice = $price;
  $idprod = $_GET['q'];
  $products = htmlspecialchars($_POST['order']);
  $message .= "--".$products."--";
  //check required Feilds
  if(!empty($email) && !empty($name) && !empty($address)){
    //passed
    //check email
    if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
      //failed
      $msg = 'Please fill a valid email';
      $msgClass = 'alert-danger';
    }else {
      //do when evarythings good
      $connIn = mysqli_connect('localhost','root','123456','pizzaprod');
      //check connect
      if(mysqli_connect_errno()){
        echo 'Failed to conect to MySql '.mysqli_connect_errno();
      }
      $queryInsert = "INSERT INTO orders(idprod,name,email,address,message,ordertype,done,unitPrice) VALUES('$idprod','$name','$email','$address','$message','$orderType',0,'$unitprice')";
      if(mysqli_query($connIn,$queryInsert)){
        header('Location: thank.php?name='.$name);
      }else{
        echo 'error'.mysqli_error($connIn);
      }

    }
  }else{
    $msg = 'Please fill in all the feilds';
    $msgClass = 'alert-danger';
  }
}
?>



<?php
//connect databasae
//create connect
$conn = mysqli_connect('localhost','root','123456','pizzaprod');
//check connect
if(mysqli_connect_errno()){
  echo 'Failed to conect to MySql '.mysqli_connect_errno();
}
?>

<?php
//make query
$id = mysqli_real_escape_string($conn,$_GET['q']);
$query = 'SELECT * FROM product WHERE id='.$id;

//get result
$result = mysqli_query($conn,$query);

//fetch data
$post = mysqli_fetch_assoc($result);

// var_dump($posts);
// free memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<?php include('header.php');?>
<div class="container">
  <?php if($msg != ''):?>
    <div class="alert <?php echo $msgClass;?>">
      <?php echo $msg;?>
    </div>
  <?php endif;?>

  <form action="<?php echo $_SERVER['PHP_SELF']."?q=".$_GET['q'];?>" method="post">
  <fieldset>
    <legend>Complete Order</legend>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
      </div>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input name="name" type="text" class="form-control" id="address" placeholder="Your Name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">address</label>
      <input name="address" type="text" class="form-control" id="address" placeholder="Your address">
      <small id="emailHelp" class="form-text text-muted">We'll never share your address with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Product</label>
      <input name="order" type="text" class="form-control" id="address" value="<?php echo $post['name']." ,drink: ".$drink." ,Combo: ".$customRadio; ?>">
    </div>

    <div class="form-group">
      <label for="exampleTextarea">Some note for Your Order</label>
      <textarea name="message" class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>


    <fieldset class="form-group">
      <legend>Order's type</legend>
      <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="orderType" value="1" checked="">
          Vip
        </label>
      </div>
      <div class="form-check disabled">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="orderType" value="0">
          Normal
        </label>
      </div>

      <div class="form-group">
        <label class="control-label">Input addons</label>
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input name="price" id="price" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $price;?>" disabled >
            <div class="input-group-append">
              <span class="input-group-text">.00</span>
            </div>
          </div>
        </div>
      </div>


    </fieldset>


  </fieldset>
      <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Order Now</button>
</form>

</div>

<?php include('footer.php');?>
