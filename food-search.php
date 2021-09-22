<?php include_once 'Template/header.php'; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

    <?php 
    //Get the search keyword
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        

        <?php
        
        //SQL query to get foods based on search keyword
        $query = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = mysqli_query($connection, $query);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
            echo '<h2 class="text-center">Food Menu</h2>';
            while ($rows = mysqli_fetch_assoc($result)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $description = $rows['description'];
                $image = $rows['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                    <?php 
                         if($image){
                        ?>
                        <img src="admin/images/food/<?php echo $image; ?>" alt="" class="img-responsive img-curve">
                        <?php 
                         }else{
                            ?>
                            <img src="admin/images/food/default_food_image.png" alt="" class="img-responsive img-curve">
                            <?php
                         }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description ?>
                        </p>
                        <br>

                        <a href="<?php echo site_url ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<h2 class="error">Food not found!</h2>';
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<<?php include_once 'Template/footer.php'; ?>