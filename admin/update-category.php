<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <?php
            $id = $_GET['id'];

            $sql = "SELECT title, image_name, featured, active FROM tbl_category WHERE id='$id'";

            $res = mysqli_query($conn, $sql);

            if($res){
                $cat_data = mysqli_fetch_assoc($res);

                $title = $cat_data['title'];
                $image_name = $cat_data['image_name'];
                $featured = $cat_data['featured'];
                $active = $cat_data['active'];
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><img src="../images/category/<?php echo $image_name; ?>" height="100rem"></td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td><input type="checkbox" name="featured" <?php echo ($featured ? 'checked' : '') ?>></td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="checkbox" name="active" <?php echo ($active ? 'checked' : '') ?>></td>
                </tr>
                <tr>
                    <td class="submit-data" colspan="3">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
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

        if(isset($_FILES['image']['name'])){
            $new_image_name = $_FILES['image']['name'];

            if($new_image_name!=''){
                $path = '../images/category/'.$image_name;
                $remove = unlink($path);
                
                $exploded = explode('.', $new_image_name);
                $ext = end($exploded);
    
                $image_name = 'Food_category_'.rand(000, 999).'.'.$ext;
    
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;
    
                $upload = move_uploaded_file($source_path, $destination_path);
    
                if(!$upload){
                    $_SESSION['upload'] = '<div class="error">Failed to upload the image</div>';
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }
        }

        $sql = "UPDATE tbl_category SET 
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id='$id'";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['upd-cat'] = "<div class='success'>Category updated successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            $_SESSION['upd-cat'] = "<div class='error'>Failed to update category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
?>