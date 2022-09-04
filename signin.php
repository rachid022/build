<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<form action="" method="post">

<div class="input-group input-group-sm mb-3">
<span class="input-group-text" id="inputGroup-sizing-sm">Name:</span>
<input class="form-control" type="text" name="name" id=""  placeholder="name..." required><br>
</div>

Last Name:<input class="form-control" type="text" name="lastname" id="" placeholder="lastname..." required><br>
Date of birth:<input class="form-control" type="date" name="birthdate" id="" placeholder="age..." required><br>
Email<input class="form-control" type="email" name="email" id="" placeholder="email..." required><br>
Password<input class="form-control" type="password" name="password" id="" placeholder="password..." required><br>
Accept CGU:<input type="checkbox" name="agree" id="" value="validated" required><br>
SEND<input class="form-control" type="submit" name="submit" id=""><br>

</form> -->




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
        <input class="email" type="email" palceholder="Write your email" required name="recoveryMail" id="">
        <input class="submit" type="submit"  name="submitRecovery"> -->
      <h1>تسجل في الموقع</h1>
      <input class="form-control" type="text" name="name" id="" placeholder="Type your Name"required><br>
      <input class="" type="text" name="lastname" id="lastname" placeholder="Type your Laste Name" required><br>
      <input class="" type="date" name="birthdate" id="birdday" placeholder="Type your Age" required><br>
      <input class="" type="email" name="email" id="emailsignin" placeholder="Type your Email" required><br>
      <input class="" type="password" name="password" id="passwordsignin" placeholder="Type your Password" required><br>
      <label for="cgu">Accept CGU:</label><input type="checkbox" name="agree" id="cgu" value="validated" required><br>
      <input class="submit" type="submit" value="submit" name="submit" id=""><br>

    </form>
  </div>
</body>

</html>


<!-- ------------------------------------------------------------------ -->
<?php

include 'connection.php';
if ($mybase) {
  echo "<br>";
  echo "you are connected";
  echo "<br>";
}
if (isset($_POST["submit"])) {

  $checkemail = $myarticlesdb->prepare("SELECT * FROM USERS WHERE email=:email");
  $checkemail->bindParam("email", $_POST["email"]);
  $checkemail->execute();

  if ($checkemail->rowCount() > 0) {

    echo '<div class="alert alert-warning" role="alert">
   already subscribed!
 </div>';
    header("refresh:3;url=login.php", true);
    echo $_POST['agree'];
  } else {
    $addUser = $mybase->prepare("INSERT INTO users(name,lastname,birthdate,email,password
,securityCode)VALUES(:name,:lastname,:birthdate,:email,:password,:securityCode)");

    $addUser->bindParam("name", $_POST["name"]);
    $addUser->bindParam("lastname", $_POST["lastname"]);
    $securityCode = md5(date("h:m:s"));
    echo $securityCode;
    $addUser->bindParam("securityCode", $securityCode);
    //$date = explode('/', $_POST['date']);
    //$time = mktime(0,0,0,$date[0],$date[1],$date[2]);
    //$mysqldate = date( 'Y-m-d H:i:s', $time );
    $dateConvert = explode('/', $_POST['birthdate']);
    echo $dateConvert[0] . "this is the date";
    //$mktime=mktime(0,0,0,$dateConvert[0],$dateConvert[1],$dateConvert[2]);
    //$birthdateResult=date("Y-d-m",$mktime);
    $addUser->bindParam("birthdate", $_POST["birthdate"]);
    echo $_POST["birthdate"];
    $addUser->bindParam("email", $_POST["email"]);
    $addUser->bindParam("password", $_POST["password"]);
    if ($addUser->execute()) {

      require_once 'mail.php';
      $mail->setFrom('8bpt10@gmail.com', 'coderRachid');
      $mail->addAddress($_POST["email"], 'Busnesse');     //Add a recipient
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
   successfuly subscribed, check your mail box to activate you account !
 </div>';
      header("refresh:3;url=login.php", true);
    }
  }
}

?>