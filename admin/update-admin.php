<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php

        $id = $_GET['id'];

        $sql = "SELECT full_name, username FROM tbl_admin WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res){
            $user_data = mysqli_fetch_assoc($res);
            
            $full_name = $user_data['full_name'];
            $username = $user_data['username'];
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td class="forgot-password">
                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>">Forgot password?</a>
                    </td>
                    <td class="submit-data">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
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
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['update'] = '<div class="success">Admin updated successfully</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            $_SESSION['update'] = '<div class="error">Failed to update admin</div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>