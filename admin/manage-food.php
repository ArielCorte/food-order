<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Foods</h1>

        <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <?php
            if(isset($_SESSION['add-food'])){
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
            if(isset($_SESSION['upd-food'])){
                echo $_SESSION['upd-food'];
                unset($_SESSION['upd-food']);
            }
            if(isset($_SESSION['del-food'])){
                echo $_SESSION['del-food'];
                unset($_SESSION['del-food']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);

                if($res){
                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $category_id = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            $cat_sql = "SELECT title FROM tbl_category WHERE id='$category_id'";
                            $cat_res = mysqli_query($conn, $cat_sql);

                            if($cat_res){
                                $category_data = mysqli_fetch_assoc($cat_res);
                                $category_title = $category_data['title'];
                            }

                            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $title ?></td>
                <td><?php echo $description ?></td>
                <td>$<?php echo $price ?></td>
                <td><img src="<?php echo SITEURL?>/images/food/<?php echo $image_name?>" height="100rem"></td>
                <td><?php echo $category_title ?>(<?php echo $category_id ?>)</td>
                <td>
                    <?php
                                                        echo $featured ? 'Yes' : 'No'
                                                    ?>
                </td>
                <td>
                    <?php
                                                        echo $active ? 'Yes' : 'No'
                                                    ?>
                </td>
                <td>
                    <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id ?>"
                        class='btn-secondary'>Update Food</a>
                    <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id ?>" class='btn-danger'>Delete
                        Food</a>
                </td>
            </tr>
            <?php
                        }
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>