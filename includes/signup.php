<?php
    if (isset($_POST['signup-submit']))
    {
        require "dbh.php";

        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
        {
            header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
            # Info is passed back in link and we can use GET methods to reuse those inputs
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            header("Location: ../signup.php?error=invalidemail&uid=" . $username);
            exit();
        }
        else if ($password !== $passwordRepeat)
        {
            header("Location: ../signup.php?error=passworderror");
            exit();
        }
        else
        {
            # Check if user already exists/taken
            # ? is a place holder
            # This is a SQL search that returns only uidUsers values
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $statement = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statement, $sql)) 
            {
                # ? matches number of s's below
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else
            {
                # s as in string statement, b as in boolean statement, i as in integer statement
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                # SQL execution is saved in arg1
                mysqli_stmt_store_result($statement);
                # SQL execution counts number of rows in results, should be 0 to indicate it as unique
                $resultCheck = mysqli_stmt_num_rows($statement);
                if ($resultCheck > 0)
                {
                    header("Location: ../signup.php?error=userTaken&mail=" . $email);
                    exit();
                }
                else
                {
                    # id users is set to auto increment (1, 2, 3, ...)
                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                    $statement = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($statement, $sql)) 
                    {
                        # ? matches number of s's below
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedpwd);
                        mysqli_stmt_execute($statement);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
    else
    {
        header("Location: ../signup.php");
        exit();
    }

?>