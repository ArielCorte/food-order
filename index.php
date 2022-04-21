<?php include('frontend/partials/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <div class="category-wrapper">
            <?php
                $sql = "SELECT id, title, image_name FROM tbl_category WHERE featured=true AND active=true";
                $res = mysqli_query($conn, $sql);
    
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
            ?>
            <div class="box-3">
                <a href="category-foods.php?id=<?php echo $id ?>">
                    <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" alt="<?php echo $title ?>"
                        class="img-responsive img-curve">
                    <h3 class="float-text text-white"><?php echo $title ?></h3>
                </a>
            </div>
            <?php
                    }
                }
            }
            ?>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            $sql = "SELECT * FROM tbl_food WHERE active = true";
            $res = mysqli_query($conn, $sql);
            if($res){
                $count = mysqli_num_rows($res);
                if($count>0){
                    $food_qty = 1;
                    while($food_qty++<=6 && $rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $image_name = $rows['image_name'];
                        $active = $rows['active'];

        ?>

        <div class="food-menu-box">
            <div class="food-menu-img">
                <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" alt="<?php echo $title ?>"
                    class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title ?></h4>
                <p class="food-price">$<?php echo $price ?></p>
                <p class="food-detail"><?php echo $description ?></p>
                <br>

                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>

        <?php
                    }
                }
            }
        ?>
        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('frontend/partials/footer.php'); ?>