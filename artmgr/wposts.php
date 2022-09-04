<?php
session_start();

include '../connection.php';
if ($myarticlesdb) {

    echo "you are connected";
}
if (isset($_POST['submit'])) {
    $myarticle = $myarticlesdb->prepare("INSERT INTO posts (title,post,userID,imgPostUrl,category)VALUES(:title,:mypost,:userID,:imgPostUrl,:category)");
    $myarticle->bindParam("title", $_POST["title"]);
    $myarticle->bindParam("mypost", $_POST["mypost"]);
    $myarticle->bindParam("imgPostUrl", $_POST["imgPostUrl"]);
    $myarticle->bindParam("category", $_POST["category"]);
    $myarticle->bindParam("userID", $_SESSION["email"]);
    if ($myarticle->execute()) {
        echo "you post sended for approbation";
        header("refresh:3;url=../index.php");
    } else {
        echo "something is wrong";
    }
}

?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/login.css">
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
            <h1>أكتب مقال</h1>
            <label for="postselect">إختر صنف المقال::</label>
            <select name="category" id="postselect">
                <option value="news" selected>اخبار</option>
                <option value="legacy">ثراث</option>
                <option value="history">تاريخ</option>
                <option value="culture">ثقافة</option>
                <option value="sport">رياضة</option>
                <option value="health">صحة</option>
            </select>
            <input class="" type="text" name="title" id="" placeholder="أكتب العنوان" required>
            <textarea name="mypost" class="form-control" placeholder="أكتب المقال هنا ....." id="floatingTextarea" rows="10" required>
            </textarea>
            <input type="text" name="imgPostUrl" placeholder="ضع رابط الصورة هنا">
            <input class="submit" type="submit" value="أرسل المقال" name="submit">
        </form>
    </div>
</body>

</html>











<!--    ---------------------------- -->