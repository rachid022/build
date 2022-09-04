<?php
  include 'connection.php';
if ($myDatabase) {
  echo "connected...";
}
if (isset($_POST['submitRecovery'])) {
  $mydb = $myarticlesdb->prepare("SELECT * FROM users WHERE email=:recoveryMail");
  $mydb->bindParam("recoveryMail", $_POST['recoveryMail']);
  $mydb->execute();
  if ($mydb->rowCount() > 0) {
    echo "success executed";
    $mydb = $mydb->fetchObject();
    $mailRecovery = $mydb->email;
    $securityCode = $mydb->securityCode;


    require_once 'mail.php';
    $mail->setFrom('8bpt10@gmail.com', 'coderRachid');
    $mail->addAddress($mailRecovery, 'Busnesse');     //Add a recipient
    $mail->addAddress('');               //Name is optional
    $mail->addReplyTo('', '');
    $mail->addCC('');
    $mail->addBCC('');
    $mail->isHTML(true);
    //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'Activate your account<b>in by clicking the link below:</b><br>' .
      '<a href="localhost/myapp1/active.php?securityCode=' . $securityCode . '">Activate</a>';
    $mail->AltBody = 'click';
    //$mail->addAttachment('/Users/samsung/Desktop/imagess/police.png');         //Add attachments 
    $mail->send();
    echo '<div class="btn btn-success" role="alert">
      Activation mail sent to 
 </div>';
    header("refresh:3;url=login.php", true);
  } else {
    echo "email not exist...!";
    header("refresh:3;url=signin.php", true);
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
    <!-- <input class="email" type="email" name="email" id="" placeholder="Type your Email" required>
            <input  class="password" type="password" name="password" id="" placeholder="Type your password" required>
            <input class="submit" type="submit" name="submit" id="">
            <a  class="" href="regpasscde.php">forgot password</a>
            <p class="" >
                <a aclass="" a href="signin.php">signin</a>
            </p> -->
    <!-- <form action="" method="post">
        <p>Enter recover mail adresse : </p>
        <input class="email" type="email" placeholder="Type your Email" required name="recoveryMail" id="">
        <input class="submit" type="submit"  name="submitRecovery">
      </form> -->
    <!-- </form> -->
   
      <p>Enter recover mail adresse : </p>
      <input class="email" type="email" placeholder="Type your Email" required name="recoveryMail" id="">
      <input class="submit" type="submit" name="submitRecovery">
    </form>
  </div>
</body>

</html>