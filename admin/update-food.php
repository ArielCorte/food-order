<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_food WHERE id='$id'";
            $res = mysqli_query($conn, $sql);
            if($res){
                $food_data = mysqli_fetch_assoc($res);
                $title = $food_data['title'];
                $description = $food_data['description'];
                $price = $food_data['price'];
                $image_name = $food_data['image_name'];
                $current_category_id = $food_data['category_id'];
                $featured = $food_data['featured'];
                $active = $food_data['active'];
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="10"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" min="0" step="any" value="<?php echo $price ?>"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" height="100px">
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <option value="">Select category</option>
                            <?php
                                $cat_sql = "SELECT id, title FROM tbl_category";
                                $res = mysqli_query($conn, $cat_sql);
                                if($res){
                                    $count = mysqli_num_rows($res);
                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res)){
                                            $category_id = $rows['id'];
                                            $category_title = $rows['title'];

                                            ?>
                            <option value="<?php echo $category_id ?>"
                                <?php echo ($current_category_id == $category_id ? 'selected' : ''); ?>>
                                <?php echo $category_title ?>(<?php echo $category_id ?>)
                            </option>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td><input type="checkbox" name="featured" <?php echo $featured ? 'checked' : '' ?>></td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="checkbox" name="active" <?php echo $active ? 'checked' : '' ?>></td>
                </tr>
                <tr>
                    <td class="submit-data" colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if(isset($_FILES['image']['name'])){
            $new_image_name = $_FILES['image']['name'];

            if($new_image_name!=''){
                $path = '../images/food/'.$image_name;
                $remove = unlink($path);
                
                $exploded = explode('.', $new_image_name);
                $ext = end($exploded);

                $image_name = 'Food_'.rand(000, 999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../images/food/'.$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if(!$upload){
                    $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }
            }
        }

        $category_id = $_POST['category_id'];
        
        if(isset($_POST['featured'])){
            $featured = true;
        } else {
            $featured = false;
        }

        if(isset($_POST['active'])){
            $active = true;
        } else {
            $active = false;
        }

        $sql = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'
            WHERE id = '$id'
        ";
        
        $res = mysqli_query($conn, $sql);
        
        if($res){
            $_SESSION['upd-food'] = '<div class="success">Food updated successfully</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            $_SESSION['upd-food'] = '<div class="error">Failed to update food</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
?>