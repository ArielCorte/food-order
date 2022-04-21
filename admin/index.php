<!-- Menu section -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br>

        <div class="col-4 text-center">
            <h2>5</h2>
            </br>
            Categories
        </div>

        <div class="col-4 text-center">
            <h2>5</h2>
            </br>
            Categories
        </div>

        <div class="col-4 text-center">
            <h2>5</h2>
            </br>
            Categories
        </div>

        <div class="col-4 text-center">
            <h2>5</h2>
            </br>
            Categories
        </div>
    </div>
</div>

<!-- Footer section -->
<?php include('partials/footer.php'); ?>
