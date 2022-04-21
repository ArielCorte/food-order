<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

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
                    <td><input type="text" name="title" placeholder="Enter category title"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
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

        //print_r($_FILES['image']);

        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            $exploded = explode('.', $image_name);
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
        } else {
            $image_name="";
        }

        $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name = '$image_name',
            featured='$featured',
            active='$active'
            ";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['add-cat'] = "<div class='success'>Category added successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            $_SESSION['add-cat'] = "<div class='error'>Failed to add category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }

?>