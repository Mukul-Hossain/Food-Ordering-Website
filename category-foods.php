<?php include_once 'Template/header.php'; ?>


<?php 

 if(isset($_GET['id'])){
     $id = $_GET['id'];

     $query = "SELECT * FROM category WHERE id={$id}";
     $result = mysqli_query($connection, $query);

     //$count = mysqli_num_rows($result);
     $rows = mysqli_fetch_assoc($result);
     $title = $rows['title'];
 }
 
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="<?php echo site_url ?>category-foods.php?id=<?php echo $id; ?>" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            

            <?php 
              $query2 = "SELECT * FROM food WHERE category_id={$id}";
              $result2 = mysqli_query($connection, $query2);

              $count = mysqli_num_rows($result2);

              if($count>0){
                echo '<h2 class="text-center">Food Menu</h2>';
                  while($rows2 = mysqli_fetch_assoc($result2)){
                      $food_id = $rows2['id'];
                      $food_title = $rows2['title'];
                      $price = $rows2['price'];
                      $description = $rows2['description'];
                      $image_name = $rows2['image_name'];
                      ?>
                      <div class="food-menu-box">
                <div class="food-menu-img">
                <?php
                        if ($image_name) {
                        ?>
                            <img src="admin/images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        } else {
                        ?>
                            <img src="admin/images/food/default_food_image.png" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $food_title; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo site_url ?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
                  }
              }else{
                echo '<h2 class="error">No Food Found On '. '"'. $title. '"' .' Category! </h2>';
              }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include_once 'Template/footer.php'; ?>