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
$id = mysqli_real_escape_string($conn,$_GET['q']);
$query = 'SELECT * FROM product WHERE id='.$id;
$query1 = 'SELECT * FROM price WHERE id='.$id;
//get result
$result = mysqli_query($conn,$query);
$result1 = mysqli_query($conn,$query1);
//fetch data
$post = mysqli_fetch_assoc($result);
$price = mysqli_fetch_assoc($result1);
// var_dump($posts);
// free memory
mysqli_free_result($result);
mysqli_free_result($result1);
//close connection
mysqli_close($conn);

?>


<?php include('header.php');?>
<div class="container">
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
  <div class="detail">
    <h2>Order: </h2>



<form class="" action="index.html" method="post">
    <fieldset>
      <legend>Custom forms</legend>
      <div class="form-group">
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio0" name="customRadio" class="custom-control-input" value="1" checked>
          <label class="custom-control-label" for="customRadio0">Combo 1</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="2">
          <label class="custom-control-label" for="customRadio1">Combo 2</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="3">
          <label class="custom-control-label" for="customRadio2">Combo 3</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="6">
          <label class="custom-control-label" for="customRadio3">Combo 6</label>
        </div>
      </div>

      <div class="form-group">
        <select class="custom-select" id="drink">
          <option selected="" value="0">Select Drink</option>
          <option value="8">Cocacola</option>
          <option value="9">Pepsi</option>
          <option value="10">Fanta</option>
          <option value="0">No Drink</option>
        </select>
      </div>


      <div class="form-group">
        <label class="control-label">Input addons</label>
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input id="price" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $price['price'];?>">
            <div class="input-group-append">
              <span class="input-group-text">.00</span>
            </div>
          </div>
        </div>
      </div>


    </fieldset>

      <button type="submit" class="btn btn-primary btn-lg btn-block">Order Now</button>
    </form>




  </div>
</div>

<script type="text/javascript">
var defaultPrice = $('#price').val();
var finalPrice = defaultPrice;
//alert($('input[name=customRadio]:checked').val());
$('input[name=customRadio]').change(()=>{
  finalPrice = defaultPrice*$('input[name=customRadio]:checked').val() + Number($('#drink').val());
  $('#price').val(finalPrice);

});
$('#drink').change(()=>{
  finalPrice = defaultPrice*$('input[name=customRadio]:checked').val() + Number($('#drink').val());
  $('#price').val(finalPrice);
});


</script>



<?php include('footer.php');?>
