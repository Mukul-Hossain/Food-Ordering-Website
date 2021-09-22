<?php include_once 'Template/header.php'; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo site_url ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $query = "SELECT * FROM food WHERE active='Yes'";
        $result = mysqli_query($connection, $query);

        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($food_rows = mysqli_fetch_assoc($result)) {
                $food_id = $food_rows['id'];
                $food_title = $food_rows['title'];
                $food_price = $food_rows['price'];
                $description = $food_rows['description'];
                $food_image = $food_rows['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($food_image) {
                        ?>
                            <img src="admin/images/food/<?php echo $food_image; ?>" alt="" class="img-responsive img-curve">
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
                        <p class="food-price">$<?php echo $food_price; ?></p>
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
            echo '<h2 class="error">No Food Found!</h2>';
        }
        ?>





        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include_once 'Template/footer.php'; ?>