<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter food title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" id="" cols="30" rows="10"
                            placeholder="Enter food description"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" min="0" step="any" placeholder=100></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
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
                            <option value="<?php echo $category_id ?>">
                                <?php echo $category_title ?>(<?php echo $category_id ?>)</option>
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
                    <td><input type="checkbox" name="featured"></td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="checkbox" name="active"></td>
                </tr>
                <tr>
                    <td class="submit-data" colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            $exploded = explode('.', $image_name);
            $ext = end($exploded);

            $image_name = 'Food_'.rand(000, 999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = '../images/food/'.$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if(!$upload){
                $_SESSION['upload'] = '<div class="error">Failed to upload the image</div>';
                header('location:'.SITEURL.'admin/add-food.php');
                die();
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

        $sql = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'
        ";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['add-food'] = '<div class="success">Food added successfully</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            $_SESSION['add-food'] = '<div class="error">Failed to add food</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }

?>