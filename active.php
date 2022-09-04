<?php
if(isset($_GET["securityCode"])){
    include 'connection.php';
    $checkAccount=$mybase->prepare("SELECT * FROM users WHERE securityCode=:securityCode");
    $checkAccount->bindParam("securityCode",$_GET["securityCode"]);
    if($checkAccount->execute()){
        echo "<br>";
        echo "exec1";
        echo "<br>";
    }
   
    if($checkAccount->rowCount()>0){
        $checkObject=$checkAccount->fetchObject();
        if($checkObject->accountstat==0){
        $activateAccount=$mybase->prepare("UPDATE users SET securityCode=:newSecurityCode ,accountstat=true WHERE securityCode=:securityCode");
        $activateAccount->bindParam("securityCode",$_GET["securityCode"]);
        $newSecurityCode=md5(date("H:m:s"));
        $activateAccount->bindParam("newSecurityCode",$newSecurityCode);
  
        if($activateAccount->execute()){

            echo "CONGRATULATION YOUR ACCOUNT ACTIVED";
            header("refresh:3;url=login.php",true);
        }
                                        }else{
                                            echo "your Account is already activated";
                                        }
    }else{

        echo "expired code please ,for an other code click here:"."<br>"."RESEND ";
        header("refresh:3;url=resendactivation.php",true);
    }


}
