<?php include'./includes/db.php';
session_start();
header("Cache-Control: no cache");
if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}
if (isset($_POST['addtocart'])) {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  add_to_cart($product_id, $quantity, $price);
}

function add_to_cart($product_id, $quantity, $price) {
  // Check if the product is already in the cart
  if (isset($_SESSION['cart'][$product_id])) {
      // Increment the quantity
      $_SESSION['cart'][$product_id]['quantity'] += $quantity;
  } else {
      // Add the product to the cart
      $_SESSION['cart'][$product_id] = array(
          'quantity' => $quantity,
          'price' => $price
      );
  }
}



?>
<?php include './includes/header.php'?>
<main>
<div class="products_section">
  <div class="row">
    <?php 
if(isset($_GET['cat_id'])){
  $cat_id = $_GET['cat_id'];
}
if(isset($_GET['sub_id'])){
  $sub_id = $_GET['sub_id'];

  $cat_id = $_GET['cat_id'];

}
if(isset($sub_id)){
  $query = "SELECT * FROM products where subcategory_id=$sub_id  and category_id=$cat_id";
 
  
} else if(isset($cat_id)){
  $query = "SELECT * FROM products where category_id=$cat_id ";
}else if(isset($all)){
  $query = "SELECT * FROM products";
}
 else {
  $query = "SELECT * FROM products";
}

    $AllProducts = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($AllProducts)){
      $product_name=$row['product_name'];
      $product_id =$row['product_id'];
      $unit_quantity=$row['unit_quantity'];
      $unit_price=$row['unit_price'];
      $description=$row['description'];
      $image = $row['image'];
   
  ?>
  <div class="product_card">
    <form method='post' action=''>
   <img src= "./assets/<?php echo $image ?>"width="200px"height="200px"/>
   <input type='hidden' name='product_id' value=<?php echo $product_id?>>
  <a href="product.php?prod_id=<?php echo $product_id?>"><h2><?php echo $product_name?></h2></a> 
   <input type="hidden" name="price" value=<?php echo $unit_price?>>
   <p name='price'>Price: <?php echo $unit_price?></p>
   <p> Amount: <?php echo $unit_quantity?></p>
   Quantity: <input type='number' name='quantity' value='1'>
   <button class='cart_btn' type='submit' name='addtocart'>Add to Cart</button>
   </form>
  </div>

  <?php  } ?>
</div>
</div>
<div class='cart_section'>
<?php
if(isset($_POST['updatecart'])) {
    foreach($_SESSION['cart'] as $key => $value) {

      //Retrieve the quantity from the 
        $_SESSION['cart'][$key]['quantity'] = $_POST['quantity'][$key];
    }
}
?>

<!-- HTML code for cart page -->
<div>
  <h2>Cart</h2>
</div>
<form method="post" action="">
    <table class='cart'>
        <tr>
          <th>Product Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
        $total = 0;
        foreach($_SESSION['cart'] as $key => $value) {
            $subtotal = $value['price'] * $value['quantity'];
            $total += $subtotal;
            $query = "SELECT product_name, image from products where product_id = $key";
            $cart_product = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($cart_product)){
              $product_name=$row['product_name'];
              $image = $row['image'];
            }
            ?>
         
            <tr>
              <td><img src="./assets/<?php echo $image?>"></td>
                <td><?php echo $product_name ?></td>
                <td><?php echo $value['price']; ?></td>
                <td><input type="number" name="quantity[<?php echo $key; ?>]" value="<?php echo $value['quantity']; ?>"></td>
                <td><?php echo $subtotal; ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="3" align="right">Total:</td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
    <div class='btncontainer'>
    <input type="submit" name="updatecart" value="Update cart">
</form>
<div>
  <div>
<a class='clear' href="index.php?clear">Clear</a>
    <?php 
    if(isset($_GET['clear'])){
      // unset the session variable that stores the cart data
unset($_SESSION['cart']);
echo"<script>window.location.href = 'index.php' </script>";
    }
    ?>
  </div>
  
  </div>
  </div>
  <?php
 // Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  $is_cart_empty = true;
} else {
  $is_cart_empty = false;
}

?>

<button class="<?php if ($is_cart_empty) { echo 'greyout-btn'; }else{
  echo'open-modal-btn';
}?>" <?php if ($is_cart_empty) { echo "disabled"; } ?>>Checkout</button>
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close-modal">&times;</span>
    <h2>Checkout</h2>
    <form  class ="checkout_form" method="post">
    <div class="container">
			<label for="name">Full Name:</label>
			<input type="text" id="name" name="name" required>

			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>

			<label for="phone">Phone:</label>
			<input type="tel" id="phone" name="phone" required>

			<label for="address">Address:</label>
			<input type="text" id="address" name="address" required>

			<label for="city">City:</label>
			<input type="text" id="city" name="city" required>

			<label for="state">State:</label>
			<select id="state" name="state" required>
				<option value="">Select State</option>
				<option value="NSW">New South Wales</option>
				<option value="VIC">Melbourne</option>
				<option value="ACT">Canberra</option>
			</select>

			<label for="zip">Zip Code:</label>
			<input type="text" id="zip" name="zip" required>
      <input  name="Checkout" type="submit" value="Place Order">
		</div>
  
    </form>
  </div>
</div>
<?php
if(isset($_POST['Checkout'])){
  // foreach($_SESSION['cart'] as $key => $value) {
  //   $quantity = $value['quantity'];
  //   $checkout_query = "SELECT in_stock FROM products WHERE product_id =$key";
  //   $checkout_quantity = mysqli_query($connection,$checkout_query);
  //   $updated_quantity = $checkout_quantity - $quantity;
  //   $updated_query = "UPDATE products SET in_stock=$updated_quantity WHERE product_id =$key ";
  //   mysqli_query($connection,$updated_query);

  // }
  echo"<script>alert('Order Completed and Will be emailed to you shortly')</script>";



  unset($_SESSION['cart']);
echo"<script>window.location.href = 'index.php' </script>";

}
?>

</div>
</main>
    
</body>



</html>