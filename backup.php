<?php

// echo time();
// $array=array("rachid","khalid","abdo","meriem","ali");


// $randomkey=array_rand($array,3);
// echo "<pre>";
//  print_r($randomkey);
//  echo "<br>";
//  print_r($array[$randomkey[0]]);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <header class="header-large-screen">
      <div class="div-header-logo"><img class="logo" src="" alt="">
      </div>
      <div class="div-header-links">
        <a href="" class="indexPageNav1a indexPageNav1a1"> الرئسية </a>
        <a href="" class="indexPageNav1a indexPageNav1a1"> اخبار </a>
        <a href="" class="indexPageNav1a indexPageNav1a2"> سياسة </a>
        <a href="" class="indexPageNav1a indexPageNav1a3"> ثقافة </a>
        <a href="" class="indexPageNav1a indexPageNav1a4"> رياضة </a>
        <a href="artmgr/wposts.php" class="indexPageNav1a indexPageNav1a1"> مقالك </a>
      </div>

    </header>
    <header class="header-small-screen">
      <div class="small-screen-container ">
        <img class="logo" src="logo.png" alt="">
        <div class="menu">
          <span class="menu-drower">
            <span class="hamborger-menu"></span>
            <span class="hamborger-menu"></span>
            <span class="hamborger-menu"></span>
          </span>
          <ul class="links">
            <li><a href="" class="indexPageNav1a indexPageNav1a1"> الرئسية </a></li>
            <li><a href="" class="indexPageNav1a indexPageNav1a1"> اخبار </a></li>
            <li><a href="" class="indexPageNav1a indexPageNav1a2"> سياسة </a></li>
            <li><a href="" class="indexPageNav1a indexPageNav1a3"> ثقافة </a></li>
            <li><a href="" class="indexPageNav1a indexPageNav1a4"> رياضة </a></li>
            <li><a href="artmgr/wposts.php" class="indexPageNav1a indexPageNav1a1"> مقالك </a></li>
          </ul>
        </div>
      </div>
    </header>

    <div class="main-aside-div">
      <!-- start of PHP -->

      <?php



      $username = "root";
      $passwordDB = "";
      $myarticlesdb = new PDO("mysql:host=localhost;dbname=myapp1;utf8", $username, $passwordDB);
      if ($myarticlesdb) {
        session_start();
        if (isset($_SESSION['email'])) {

      ?>



          <!-- start main -->
          <div class="main-container">
            <main>
              <?php
              $myarticle = $myarticlesdb->prepare("SELECT * FROM posts  WHERE userID=:userID ORDER BY date DESC");
              $myarticle->bindParam("userID", $_SESSION["email"]);
              $myarticle->execute();

              if ($myarticle->rowCount() > 0) {
              ?>

                <?php foreach ($myarticle as $articles) { ?>
                  <div class="articles-container">
                    <p class="title-post"><?php echo $articles['title']; ?></p>
                    <div class="post-container">
                      <div class="img-post" style="background-image: url('<?php echo $articles['imgPostUrl'] ?>')"></div>
                      <div class="main-posts">
                        <?php echo substr($articles['post'], 0, 600) ?>
                        <!-- <a href="#" class="read-more-link"> إقرأ المزيد </a> -->
                      </div>
                    </div>
                    <p class="indexPageMainH2"><?php echo strlen($articles['post']); ?>
                      تاريخ النشر <?php echo  $articles['date']; ?> </p>
                  </div>



                  <!-- end main -->

                <?php } ?>
            </main>
          </div>




        <?php
              } else {
                echo '<a href="artmgr/wposts.php" class="indexPageNav1a indexPageNav1a1">' . 'اكتب مقال' . '</a>';
              } ?>
      <?php
        } else {
          echo '<a href="login.php" class="">' . 'login in here ' . '</a>';
        } ?>
    <?php
      }
    ?>

    <?php

    // pour extraire les titres

    $myTitles = $myarticlesdb->prepare("SELECT * FROM posts  WHERE userID=:userID ORDER BY date DESC");
    $myTitles->bindParam("userID", $_SESSION["email"]);
    $myTitles->execute(); ?>




    <div class="aside">
      <?php
      if ($myTitles->rowCount() > 0) {
      ?>


        <div class="aside-p-div">
          <?php foreach ($myTitles as $titles) { ?>
            <p id="indexPageAsideP1" class="indexPageAsideP1"><?php echo $titles['title'] ?></p>
          <?php  } ?>



        <?php } else {
        echo "something is wrong";
      } ?>
        </div>

    </div>

    </div>
    <footer id="pageindexFooter1" class="pageIndexFooter pageIndexFooter1">

      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a1"> من نحن </a>
      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a1"> سياسة الموقع </a>
      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a2"> تواصل معنا </a>
      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a3"> مواقع مفيدة </a>
      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a4"> فريق العمل </a>
      <a href="" class="indexPageNavFooter1a indexPageNavFooter1a1"> للاشهار في الموقع </a>
    </footer>
  </div>
  <script src="js/javascript1.js"></script>
</body>

</html>