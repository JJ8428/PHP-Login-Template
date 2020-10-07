<?php
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="description" content="This is description of website if googled.">
    <title>SQLPHP Template</title>
</head>
<body>
    <header>
        <nav>
            <b><i>PHP Template</i></b>
            Tabs:
            <a href="index.php">index.php</a>
            |
            <a href="signup.php">signup.php</a>
            |
            add more ...
        </nav>
    </header>
    <!--
        method="get" is faster, but has form data in link
        method="post" is more secure, form data not shown in link
        includes folder is a dir that holds php folder for scripts, no actual content to display

        SQL code:
        create TABLE users 
        (
            uidUsers TINYTEXT NOT NULL,
            emailUsers TINYTEXT NOT NULL,
            pwdUsers LONGTEXT NOT NULL
        );
    -->
</body>