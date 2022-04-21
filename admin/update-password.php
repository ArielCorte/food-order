<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <?php 

            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }

        ?>

        <form action="" method="POST">
            <table class="tbl-40">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>
                <tr>
                    <td class="submit-data" colspan="2">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

            if(isset($_POST['submit'])){
                
                $id=$_POST['id'];
                $current_password=md5($_POST['current_password']);
                $new_password=md5($_POST['current_password']);
                $confirm_password=md5($_POST['confirm_password']);

                $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

                $res = mysqli_query($conn, $sql);

                if($res){
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //user exists
                    } else {
                        $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            }

?>