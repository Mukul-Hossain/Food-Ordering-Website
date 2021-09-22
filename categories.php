<?php include_once 'Template/header.php'; ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        

        <?php
        $query = "SELECT * FROM category WHERE active='Yes'";
        $result = mysqli_query($connection, $query);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
            echo '<h2 class="text-center">Explore Foods</h2>';
           while($rows = mysqli_fetch_assoc($result)):;

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

                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
            </a>
        <?php
        endwhile;
        }else{
            echo '<h2 class="error">No Category Found!</h2>';
        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include_once 'Template/footer.php'; ?>