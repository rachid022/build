<form action="" method="post">
  <input type="text" name="newpassword" id="">
  <input type="text" name="retypenewpassword" id="">
  <input type="submit" name="Resetpassword" id="">
</form>

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
  <?php
  if (isset($_POST['Resetpassword'])) {

    if ($_POST['newpassword'] === $_POST['retypenewpassword']) {

      include 'connection.php';

      $resetpassword = $myarticlesdb->prepare("SELECT * FROM users WHERE securityCode=:securityCode");
      $resetpassword->bindParam("securityCode", $_GET["securityCode"]);
      if ($resetpassword->execute()) {
        echo "<br>";
        echo "exec1";
        echo "<br>";
      }

      if ($resetpassword->rowCount() > 0) {


        $upadtePassword = $mybase->prepare("UPDATE users SET securityCode=:newSecurityCode ,password=:password WHERE securityCode=:securityCode");
        $upadtePassword->bindParam("securityCode", $_GET["securityCode"]);
        $newSecurityCode = md5(date("H:m:s"));
        $upadtePassword->bindParam("newSecurityCode", $newSecurityCode);
        $upadtePassword->bindParam("password", $_POST["newpassword"]);

        if ($upadtePassword->execute()) {

          echo "password changed";
          header("refresh:3;url=login.php");
        }
      }
    } else {

      echo "expired code please ,for an other code click here:" . "<br>" . "RESEND ";
      header("refresh:3;url=regpasscde.php", true);
    }
  }



  ?>
  <div>
    <form class="form-login" action="" method="post">
      <!-- <input class="email" type="email" name="email" id="" placeholder="Type your Email" required>
            <input  class="password" type="password" name="password" id="" placeholder="Type your password" required>
            <input class="submit" type="submit" name="submit" id="">
            <a  class="" href="regpasscde.php">forgot password</a>
            <p class="" >
                <a aclass="" a href="signin.php">signin</a>
            </p> -->
      <form action="" method="post">
        <p>Enter recover mail adresse : </p>
        <input class="email" type="email" placeholder="Type your Email" required name="recoveryMail" id="">
        <input class="submit" type="submit" name="submitRecovery">
      </form>
    </form>
  </div>
</body>

</html>