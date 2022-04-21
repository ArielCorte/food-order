<?php include('frontend/partials/menu.php'); ?>

<?php
    $category_id = $_GET['id'];
    $cat_sql = "SELECT title FROM tbl_category WHERE id='$category_id'";
    $cat_res = mysqli_query($conn, $cat_sql);
    if($cat_res){
        $category_data = mysqli_fetch_assoc($cat_res);
        $category_title = $category_data['title'];
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            $sql = "SELECT * FROM tbl_food WHERE category_id='$category_id' AND active=true";
            $res = mysqli_query($conn, $sql);
            if($res){
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($rows = mysqli_fetch_assoc($res)){
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

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('frontend/partials/footer.php'); ?>