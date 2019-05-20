<?php

//create connect
$conn = mysqli_connect('sql7.freemysqlhosting.net','sql7292489','n8UWR1v9YX','sql7292489');
//check connect
if(mysqli_connect_errno()){
  echo 'Failed to conect to MySql '.mysqli_connect_errno();
}
?>

<?php
//make query
$query = 'SELECT * FROM product';
//get result
$result = mysqli_query($conn,$query);
//fetch data
$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
// var_dump($posts);
// free memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);

?>

<?php include('header.php');?>
<h1 style="text-align:center;">All kind of pizza We Serve</h1>
<div class='container'>


  <?php foreach($posts as $post):?>

    <div class="card mb-3">
      <h3 class="card-header"><?php echo $post['name']; ?></h3>
      <div class="card-body">
        <h5 class="card-title">Chef: <?php echo $post['chef']; ?></h5>
        <h6 class="card-subtitle text-muted"><?php echo $post['origin']; ?></h6>
      </div>
      <img style="height: 200px; width: 100%; display: block;" src="<?php echo $post['img']; ?>" alt="Card image">
      <div class="card-body">
        <p class="card-text"><?php echo $post['describle']; ?></p>
      </div>
      <div class="card-body">
        <a href="checkorder.php?q=<?php echo $post['id']; ?>" class="card-link">Order</a>
        <a href="#" class="card-link">More info</a>
      </div>
    </div>

  <?php endforeach;?>


</div>
<?php include('footer.php'); ?>
