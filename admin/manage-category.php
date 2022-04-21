<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Categories</h1>

        <a href="add-category.php" class="btn-primary">Add Category</a>

        <?php
            if(isset($_SESSION['add-cat'])){
                echo $_SESSION['add-cat'];
                unset($_SESSION['add-cat']);
            }

            if(isset($_SESSION['upd-cat'])){
                echo $_SESSION['upd-cat'];
                unset($_SESSION['upd-cat']);
            }

            if(isset($_SESSION['del-cat'])){
                echo $_SESSION['del-cat'];
                unset($_SESSION['del-cat']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                if($res){
                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?>

                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $title ?></td>
                                <td><?php 
                                    if ($image_name!=''){
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" height="100rem">
                                        <?php
                                    } else {
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                ?></td>
                                <td><?php 
                                    if($featured){
                                        echo 'Yes';
                                    } else {
                                        echo 'No';
                                    }
                                ?></td>
                                <td><?php 
                                    if($active){
                                        echo 'Yes';
                                    } else {
                                        echo 'No';
                                    }
                                ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
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