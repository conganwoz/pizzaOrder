
<?php
//check for the submit
//messageg var
$msg = '';
$msgClass = '';
if(filter_has_var(INPUT_POST,'submit')){
  //get form data
  $name = htmlspecialchars($_POST['name']);
  $password = htmlspecialchars($_POST['password']);

  //check required Feilds
  if(!empty($name) && !empty($password)){
    //passed
    //check email

      //do when evarythings good
      $conn = mysqli_connect('localhost','root','123456','pizzaprod');
      //check connect
      if(mysqli_connect_errno()){
        echo 'Failed to conect to MySql '.mysqli_connect_errno();
      }
      $query = 'SELECT * FROM manager WHERE id=1';
      $result = mysqli_query($conn,$query);
        $manager = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        //close connection
        mysqli_close($conn);
        //var_dump($manager);
        if((strcmp($name,$manager[0]['namelogin'])==0)&&(strcmp($password,$manager[0]['password'])==0)){
          session_start();
          $_SESSION['name'] = htmlentities($_POST['name']);
          $_SESSION['password'] = htmlentities($_POST['password']);
          header('Location: dashboard/ordersinfo.php');

        }else{
          $msg = 'Wrong login name or password!';
          $msgClass = 'alert-danger';
        }

  }else{
    $msg = 'Please fill in all the fields';
    $msgClass = 'alert-danger';
  }
}
?>


<?php include('header.php');?>

<div class="container">
  <?php if($msg != ''):?>
    <div class="alert <?php echo $msgClass;?>">
      <?php echo $msg;?>
    </div>
  <?php endif;?>
<h1 class="form-heading">Fast pizza Login system</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
   <p>Please enter your name and password</p>
   </div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="name">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="forgot">
        <a href="#">Forgot password?</a>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>

    </form>
    </div>
<p class="botto-text"> Fast pizza Hi Manager!</p>
</div></div>


<?php include('footer.php');?>
