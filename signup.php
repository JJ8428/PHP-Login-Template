<?php
    require "header.php";
?>
<main>
    <br>
    Sign Up:
    <br>
    <br>
    <form action="includes/signup.php" method="post">
        <input type="text" name="uid" placeholder="Username"><br>
        <input type="text" name="mail" placeholder="E-mail"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="pwd-repeat" placeholder="Repeat Password"><br><br>
        <button type="submit" name="signup-submit">Signup</button>
    </form>
</main>
<?php 
    require "footer.php";
?>