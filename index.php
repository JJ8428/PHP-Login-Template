<?php
    require "header.php";
?>
<main>
    <?php
        if (isset($_SESSION['username']))
        {
            echo '<br>
            Username:' . $_SESSION['username'] . 
            '<br><br>
            <form action="includes/logout.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>';
        }
        else
        {
            echo '<br>
            <form action="includes/login.php" method="post">
            <input type="text" name="mailuid" placeholder="Username/E-mail...">
            <input type="password" name="pwd" placeholder="Password...">
            <br><br>
            <button type="submit" name="login-submit">Submit</button>
            </form>';
        }
    ?>
</main>
<?php 
    require "footer.php";
?>