<?php 
include 'admin/config/data.php';


//Get the all details from selected food
if(isset($_GET['food_id'])){
$id = $_GET['food_id'];

$query = "SELECT * FROM food WHERE id= {$id}";
$result = mysqli_query($connection, $query);

$count = mysqli_num_rows($result);
if($count == 1){
    $rows = mysqli_fetch_assoc($result);
    
    $title = $rows['title'];
    $price = $rows['price'];
    $food_image = $rows['image_name'];
}else{
    $error = "Food Not Found!";
   header('Location:'. site_url);
}
}else{
    $error = "Food Not Found!";
    header('Location:'. site_url);
}


  if(isset($_POST['order'])){
      //Get all the details from the form
      $food = filter_input(INPUT_POST, 'food', FILTER_SANITIZE_STRING);
      $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
      $qty = filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_STRING);
      $total = $price * $qty;
      $order_date =  date("Y-m-d h:i:sa");
      $status = "Ordered";//Orderd, On Delivery, Delivered, Cancelled
      $customer_name = filter_input(INPUT_POST, 'full-name', FILTER_SANITIZE_STRING);
      $customer_contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
      $customer_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
      $customer_address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

      $query2 = "INSERT INTO order_tbl SET
              food = '$food',
              price = $price,
              qty = $qty,
              total = $total,
              order_date = '$order_date',
              status = '$status',
              customer_name = '$customer_name',
              customer_email = '$customer_email',
              customer_contact = '$customer_contact',
              customer_address = '$customer_address'
              ";

     $result2 = mysqli_query($connection, $query2);
     if($result2){
         $_SESSION['order'] = "Thanks for your ordering. We will deliver your food as soon as possible.";
         header('Location:'. site_url. 'order.php');
     }else{
        $_SESSION['order'] = "Food Order Failed.";
        header('Location:' . site_url. 'order.php');
     }
  }
?>

<?php include_once 'Template/header.php'; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
           
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>


                    <div class="food-menu-img">
                    <?php 
                         if(isset($food_image)){
                        ?>
                        <img src="admin/images/food/<?php echo $food_image; ?>" alt="" class="img-responsive img-curve">
                        <?php 
                         }else{
                            ?>
                            <img src="admin/images/food/default_food_image.png" alt="" class="img-responsive img-curve">
                            <?php
                         }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Mukul Hossain" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 01727282149" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hossenmukul99@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="order" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include_once 'Template/footer.php'; ?>