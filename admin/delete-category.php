<?php
    include('../config/constants.php');

    $id = $_GET['id'];

    $img_sql = "SELECT image_name FROM tbl_category WHERE id='$id'";

    $img_res = mysqli_query($conn, $img_sql);

    if($img_res){
        $user_data = mysqli_fetch_assoc($img_res);
        $image_name = $user_data['image_name'];

        if($image_name!=""){
            $path = "../images/category/".$image_name;

            $remove = unlink($path);

            if(!$remove){
                $_SESSION['del-cat'] = "<div class='error'>Failed to delete category image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }

    } else {
        $_SESSION['del-cat'] = "<div class='error'>Failed to delete category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    $sql = "DELETE FROM tbl_category WHERE id='$id'";

    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['del-cat'] = "<div class='success'>Category deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    } else {
        $_SESSION['del-cat'] = "<div class='error'>Failed to delete category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>