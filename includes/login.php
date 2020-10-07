<?php
# Checks if the user got here legally
# Legal is pressing the LOGIN button, illegal is typing a link to get here
if (isset($_POST['login-submit']))
{
    require("dbh.php");
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    if (empty($mailuid) || empty($password))
    {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else
    {
        # ?'s to be filled later
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) 
        {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else
        {
            # Pass in parameters to do a search, or fill in the ?'s
            mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $row = mysqli_fetch_assoc($result);
            # Now check if we got results
            $pwdCheck = password_verify($password, $row['pwdUsers']) + 0;
            /*
                var_dump($pwdCheck);
                var_dump($row);
                var_dump($password);
                exit();
            */
            if ($pwdCheck == 0) # Password failed check
            {
                header("Location: ../index.php?error=invalid");
                exit();
            }
            else if ($pwdCheck == 1)
            {
                # User is valid and credentials are correct, so we need to start a SESSION
                session_start();
                $_SESSION['username'] = $row['uidUsers'];
                header("Location: ../index.php?login=successful");
                exit();
            }
        }
    }
}
else
{
    # If illegal, go back to ...
    header("Location: ../index.php");
    exit();
}