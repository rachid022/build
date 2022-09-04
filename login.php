

<?php
session_start();
// if(isset($_POST['submit'])){
if (isset($_POST['submit'])) {

    include 'connection.php';

    // if ($mybase) {
    //     echo "<br>";
    //     echo "you are connected";
    //     echo "<br>";
    // }
    $login = $myarticlesdb->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $login->bindParam("email", $_POST["email"]);
    $login->bindParam("password", $_POST["password"]);
    $login->execute();
    if ($login->rowCount() > 0) {
        $login = $login->fetchObject();
        if ($login->accountstat == 1) {
            $_SESSION['email'] = $login->email;
            $_SESSION['password'] = $login->password;
            header("refresh:3;url=artmgr/wposts.php", true);;
        } else {
            echo "your acount not activated, please check your mail box " .
                "<br>" . "<a href=" . "'resendactivation.php'>" . "send actiavation link</a>";
            header("refresh:3;url=login.php", true);
        }
    } else {

        echo "email or password are false";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div>
        <form class="form-login" action="" method="post">
            <h1>تسجيل الدخول</h1>
            <input class="email" type="email" name="email" id="" placeholder="البريد الالكتروني هنا" required>
            <input  class="password" type="password" name="password" id="" placeholder="كلمة السر هنا" required>
            <input class="submit" type="submit" value="أدخل" name="submit" id="">
            <a  class="" href="regpasscde.php">نسيت كلمة السر</a>
            <p class="" >
                <a aclass="" a href="signin.php">تسجل في الموقع</a>
            </p>
        </form>
    </div>
</body>

</html>

