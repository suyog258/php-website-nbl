<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nepal Bhoomi Limited</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>Chose your house, apartment</h3>
         <p>We have many types of houese and apartment </p>
         <a href="about.php" class="white-btn">Discover more</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title"></h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" style="width:100%;">
                  <div class="name">
                     <?php echo $fetch_products['name']; ?>
                  </div>
                  <div class="price">$
                     <?php echo $fetch_products['price']; ?>/-
                  </div>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">load more</a>
      </div>

   </section>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/headingbg.jpg" alt="">
         </div>

         <div class="content">
            <h3>You can find us</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
               corporis ratione saepe sed adipisci?</p>
            <a href="about.php" class="btn">Read more</a>
         </div>
      </div>
   </section>
   <section class="home-contact">
      <div class="content">
         <h3>Have any questions?</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet
            ullam voluptatibus?
         </p>
         <a href="contact.php" class="white-btn">contact us</a>
      </div>
   </section>
   <div style="width: 100%">
   <iframe
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28266.31885657624!2d85.40695698965214!3d27.67743485471396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1aada2042dd3%3A0xb400f1fd12ee29b7!2sBig%20Bell%20Guest%20House%20%26%20Restro!5e0!3m2!1sen!2snp!4v1680588925014!5m2!1sen!2snp"
         width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
         referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>
   <?php include 'footer.php'; ?>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>