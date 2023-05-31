<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Assignment 1</title>
    <link rel="stylesheet" href="./index.css"/>
    <script defer>
document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("modal");
  const openModalBtn = document.querySelector(".open-modal-btn");
  const closeModalBtn = document.querySelector(".close-modal");

  openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
  });

  closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
});

    </script>
    
</head>
<body>
    <div class="categories-section">
        <div>
    <ul>
      <li><img src="./assets/logo.png" width="70px" style="background:white;" height="50px"></li>
        <li><a href="index.php?all">All Products</a></li>
      <?php 
    $cat_query = "SELECT * FROM categories";
    $AllCategories = mysqli_query($connection,$cat_query);
    while($row = mysqli_fetch_assoc($AllCategories)){
      $name = $row['name'];
      $category_id  = $row['category_id'];
      ?>

    <li> <a href="index.php?cat_id=<?php echo $category_id  ?>"><?php echo $name?> </a>
   
      <ul class='dropdown'>
      <?php 
     $subcat_query = "SELECT * FROM subcategories where category_id =$category_id";
     $AllSubCategories = mysqli_query($connection,$subcat_query);
     while($row = mysqli_fetch_assoc($AllSubCategories)){
       $name = $row['name'];
       $subcategory_id = $row['subcategory_id'];	
       
       ?>
        <li><a href="index.php?sub_id=<?php echo $subcategory_id?>&cat_id=<?php echo $category_id?>"><?php echo $name?></a></li>
        <?php } ?>
      </ul>
    </li>
    <?php
    }    
      ?>
        </ul>
        </div>
        <div class='search_functionality'>
        <div>
        <form action="" method="POST">
        <input type="text" id="search" name="search_term" placeholder="Search for a product">
        <button type="submit">Search</button>
        </form>
        </div>


        <?php
        if(isset($_POST['search_term'])){
        $search_term = $_POST['search_term'];

        // Escape the search term to prevent SQL injection
$search_term = mysqli_real_escape_string($connection, $search_term);
if($search_term ==  " " or$search_term == "" ){
    echo "<script>
    alert('Search Query Cannot be Empty');
    </script>";
}else{

// Query the database for matching products
$search_query = "SELECT * FROM products WHERE product_name LIKE '%$search_term%'";

$result = mysqli_query($connection, $search_query);

// Display the matching products in a dropdown
if (mysqli_num_rows($result) > 0) {
  echo '<div class="resultbox">';
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div><a href="product.php?prod_id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></div>';
  }
  echo '</div>';
} else {
  echo 'No results found';
}
}
}
        ?>
        </div>
</div>