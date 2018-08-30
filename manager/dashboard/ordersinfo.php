<?php
session_start();
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if(empty($name)||empty($password)){
  header('Location: thank.php');
}
// //destroy for security
// session_destroy();

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
//make query
$query = 'SELECT * FROM orders';
//get result
$result = mysqli_query($conn,$query);
//fetch data
$orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
$reverseOrders = array_reverse($orders);
// var_dump($posts);
// free memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);
function getTypeOrder($type){
  if($type == 1){
    return "vip";
  }else{
    return "normal";
  }
}
function getDone($type){
  if($type == 0){
    return "Not";
  }else{
    return "Ok";
  }
}

?>

<?php
if(filter_has_var(INPUT_POST,'submit')){
  header('Location: ordersinfo.php');
}
?>



<?php include('header.php');?>
<div class="container">


  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#home">All Order</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#delivered">Delivered</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#Undelivered">UnDelivered</a>
    </li>
  </ul>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="home">

      <table class="table table-hover">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">address</th>
      <th scope="col">message</th>
      <th scope="col">order type</th>
      <th scope="col">done</th>
      <th scope="col">unit price</th>
      <th scope="col">product number</th>
    </tr>
  </thead>
  <tbody>



    <?php foreach($reverseOrders as $order):?>

      <tr class="table-primary">
        <th scope="row"><?php echo $order['id'];?></th>
        <td><?php echo $order['name'];?></td>
        <td><?php echo $order['email'];?></td>
        <td><?php echo $order['phonenum'];?></td>
        <td><?php echo $order['address'];?></td>
        <td><?php echo $order['message'];?></td>
        <td><?php echo getTypeOrder($order['ordertype']);?></td>
        <td><?php echo getDone($order['done']);?></td>
        <td><?php echo $order['unitPrice']." $";?></td>
        <td><?php echo $order['idprod'];?></td>
      </tr>

    <?php endforeach;?>

  </tbody>
</table>

    </div>
    <div class="tab-pane fade" id="delivered">
      <table class="table table-hover">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">address</th>
      <th scope="col">message</th>
      <th scope="col">order type</th>
      <th scope="col">done</th>
      <th scope="col">unit price</th>
      <th scope="col">product number</th>
    </tr>
  </thead>
  <tbody>



    <?php foreach($reverseOrders as $order):?>

      <?php if($order['done'] == 1):?>
        <tr class="table-primary">
          <th scope="row"><?php echo $order['id'];?></th>
          <td><?php echo $order['name'];?></td>
          <td><?php echo $order['email'];?></td>
          <td><?php echo $order['phonenum'];?></td>
          <td><?php echo $order['address'];?></td>
          <td><?php echo $order['message'];?></td>
          <td><?php echo getTypeOrder($order['ordertype']);?></td>
          <td><?php echo getDone($order['done']);?></td>
          <td><?php echo $order['unitPrice']." $";?></td>
          <td><?php echo $order['idprod'];?></td>
        </tr>
      <?php endif;?>

    <?php endforeach;?>

  </tbody>
</table>
    </div>
    <div class="tab-pane fade" id="Undelivered">
      <table class="table table-hover">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">address</th>
      <th scope="col">message</th>
      <th scope="col">order type</th>
      <th scope="col">done</th>
      <th scope="col">unit price</th>
      <th scope="col">product number</th>
      <th scope="col">Change Status</th>
    </tr>
  </thead>
  <tbody>



    <?php foreach($reverseOrders as $order):?>

      <?php if($order['done'] == 0):?>
        <tr class="table-primary">
          <th scope="row"><?php echo $order['id'];?></th>
          <td><?php echo $order['name'];?></td>
          <td><?php echo $order['email'];?></td>
          <td><?php echo $order['phonenum'];?></td>
          <td><?php echo $order['address'];?></td>
          <td><?php echo $order['message'];?></td>
          <td><?php echo getTypeOrder($order['ordertype']);?></td>
          <td><?php echo getDone($order['done']);?></td>
          <td><?php echo $order['unitPrice']." $";?></td>
          <td><?php echo $order['idprod'];?></td>
          <td><button id="<?php echo $order['id'];?>" type="button" class="btn btn-primary deliver">Deliver</button></td>

        </tr>
      <?php endif;?>

    <?php endforeach;?>

  </tbody>
</table>
    </div>
  </div>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <button type="submit" class="btn btn-primary btn-lg btn-block">Refresh</button>
  <button type="button" name="logout" class="btn btn-primary btn-lg btn-block">Logout</button>
</form>
</div>
<script type="text/javascript">
  $('.deliver').click((e)=>{

    if(confirm('are you sure?')){
      e.currentTarget.parentElement.parentElement.style.display = "none";
      var id = e.currentTarget.id;
      var params = "id="+id;
      var xhr = new XMLHttpRequest();
      xhr.open("POST","process.php",true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onload = function(){
        if(this.status == 200){
          console.log(this.responseText);
        }
      };
      xhr.send(params);
    }
  });
</script>

<?php include('footer.php');?>
