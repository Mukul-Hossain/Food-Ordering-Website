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

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">

    <?php 
            
            if(isset($_SESSION['order'])){
              echo '<p class="success">' . $_SESSION['order'] . '</p>';
              unset($_SESSION['order']);
            }
          ?>
        

        <?php
        //Create sql qeuery to display category from database
        $query = "SELECT * FROM category WHERE active='Yes' and featured='Yes' LIMIT 3";
        $result = mysqli_query($connection, $query);

        $count = mysqli_num_rows($result);
        if ($count > 0) {
            echo '<h2 class="text-center">Featured Category</h2>';
            while ($rows = mysqli_fetch_assoc($result)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image = $rows['image_name'];
        ?>
                <a href="<?php echo site_url ?>category-foods.php?id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image) {
                        ?>
                            <img src="admin/images/category/<?php echo $image; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        } else {
                        ?>
                            <img src="admin/images/category/default_category_image.png" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo '<h2 class="error">No Featured Category Found!</h2>';
        }
        ?>



        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="<?php echo site_url ?>/categories.php">See All Categories</a>
    </p>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        

        <?php
        //qeury for get featured food from database
        $food_query = "SELECT * FROM food WHERE featured='Yes' AND active='Yes'";
        $food_result = mysqli_query($connection, $food_query);

        $food_count = mysqli_num_rows($food_result);
        if ($food_count > 0) {
            echo '<h2 class="text-center">Featured Food</h2>';
            while ($food_rows = mysqli_fetch_assoc($food_result)) {
                $food_id = $food_rows['id'];
                $food_title = $food_rows['title'];
                $food_price = $food_rows['price'];
                $description = $food_rows['description'];
                $food_image = $food_rows['image_name']
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                         if($food_image){
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
                        <h4><?php echo $food_title ?></h4>
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
            echo '<h2 class="error">No Featured Food Found!</h2>';
        }
        ?>






        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="<?php echo site_url ?>/foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include_once 'Template/footer.php'; ?>