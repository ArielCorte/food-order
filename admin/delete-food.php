<?php

include('../config/constants.php');

$id = $_GET['id'];

$img_sql = "SELECT image_name FROM tbl_food WHERE id='$id'";

$img_res = mysqli_query($conn, $img_sql);

if($img_res){
    $image_data = mysqli_fetch_assoc($img_res);
    $image_name = $image_data['image_name'];

    if($image_name!=''){
        $path = '../images/food/'.$image_name;
        $remove = unlink($path);

        if(!$remove){
            $_SESSION['del-food'] = '<div class="error">Failed to delete image</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
}

$sql = "DELETE FROM tbl_food WHERE id='$id'";

$res = mysqli_query($conn, $sql);

if($res){
    $_SESSION['del-food'] = '<div class="success">Food deleted successfully</div>';
    header('location:'.SITEURL.'admin/manage-food.php');
} else {
    $_SESSION['del-food'] = '<div class="success">Food deleted successfully</div>';
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>