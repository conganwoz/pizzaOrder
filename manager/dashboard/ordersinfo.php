<?php
session_start();
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if(empty($name)||empty($password)){
  header('Location: thank.php');
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
//make query
$query = 'SELECT * FROM orders';
$query1 = 'SELECT * FROM product';
//get result
$result = mysqli_query($conn,$query);
$result1 = mysqli_query($conn,$query1);
//fetch data
$orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
$reverseOrders = array_reverse($orders);
// var_dump($posts);
// free memory
mysqli_free_result($result);
$products = mysqli_fetch_all($result1,MYSQLI_ASSOC);
//free memory
mysqli_free_result($result1);
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
// if(filter_has_var(INPUT_POST,'submit')){
//   header('Location: ordersinfo.php');
// }
if(isset($_POST['refresh'])){
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
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#manageProduct">Manage Product</a>
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

    <div class="tab-pane fade" id="manageProduct">



      <table class="table table-hover">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID</th>
      <th scope="col">name</th>
      <th scope="col">origin</th>
      <th scope="col">img</th>
      <th scope="col">chef</th>
      <th scope="col">descible</th>
      <th scope="col">Change Status</th>
    </tr>
  </thead>
  <tbody>



    <?php foreach($products as $product):?>

      <tr class="table-success">
        <th scope="row"><?php echo $product['id'];?></th>
        <td><?php echo $product['name'];?></td>
        <td><?php echo $product['origin'];?></td>
        <td><?php echo $product['img'];?></td>
        <td><?php echo $product['chef'];?></td>
        <td><?php echo $product['describle'];?></td>
        <td><button id="<?php echo "p".$product['id'];?>" type="button" class="btn btn-primary propizza">Change info</button></td>
      </tr>

    <?php endforeach;?>

  </tbody>
</table>
 <button type="button" id="addProd" class="btn btn-primary">add Pizza</button>
    </div>
  </div>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <button type="submit" name="refresh" class="btn btn-primary btn-lg btn-block">Refresh</button>
  <button type="button" id="logout" class="btn btn-primary btn-lg btn-block">Logout</button>
</form>
</div>
<script type="text/javascript">
  $('.deliver').click((e)=>{

    if(confirm('are you sure?')){
      // e.currentTarget.parentElement.parentElement.style.display = "none";
      // var itemDelivered = e.currentTarget.parentElement.parentElement.cloneNode(true);
      //itemDelivered.style.display = 'block';
      //$('#delivered').find('table').prepend(e.currentTarget.parentElement.parentElement);
      var id = e.currentTarget.id;
      e.currentTarget.parentElement.parentElement.remove();
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
  $('#logout').click(()=>{
    var xhr = new XMLHttpRequest();
    xhr.open("POST","logout.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.onload = function(){
      if(this.status == 200){
        console.log(this.responseText);
      }
    };
    xhr.send();
    $(location).attr('href', '../login.php');
  });


  $(".propizza").click((e)=>{



    if(confirm('are you sure?')){
      var idProduct = e.currentTarget.id.split("")[1];
      var params = "id="+idProduct;
      $(location).attr('href', `processPro.php?${params}`);
    }

  });
  $('#addProd').click(()=>{
    $(location).attr('href', 'addPro.php');
  });
</script>

<?php include('footer.php');?>
