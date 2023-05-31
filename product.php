<?php 
include'./includes/db.php';
include'./includes/header.php';
if($_GET['prod_id']){
    $product_id = $_GET['prod_id'];
    echo $product_id;


 
$query  = "SELECT * FROM products where product_id= $product_id";
$AllProducts = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($AllProducts)){
      $product_name=$row['product_name'];
      $product_id =$row['product_id'];
      $unit_quantity=$row['unit_quantity'];
      $unit_price=$row['unit_price'];
      $description=$row['description'];
      $image = $row['image'];
      $stock = $row['in_stock'];
   
  ?>
  <div class="product_card">
    <form method='post' action='index.php'>
   <img src= "./assets/<?php echo $image ?>"width="200px"height="200px"/>
   <input type='hidden' name='product_id' value=<?php echo $product_id?>>
  <a href="product.php?prod_id=<?php echo $product_id?>"><h2><?php echo $product_name?></h2></a> 
   <input type="hidden" name="price" value=<?php echo $unit_price?>>
   <p name='price'><?php echo $unit_price?></p>
   <div><?php echo $description?></div>
   <p><?php echo $unit_quantity?></p>
   Quantity: <input type='number' name='quantity' value='1'>
   <?php
   if($stock<=0){
    echo "<script>alert('No More Stock. Item cannot be added to cart')</script>";
   }else{
echo" <button type='submit' name='addtocart'>Add to Cart</button>";
   }
   ?>
  
   </form>
  </div>


   <?php 
   }
 }
?>
</body>
</html>