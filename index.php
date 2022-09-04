<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;800;900&family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
  <!-- font awesome -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- athan css -->
  <link rel="stylesheet" href="css/athan.css">
  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <div class="nav">
    <div class="header-large-screen">
      <div class="brand-container">
        <div class="logocontainer">
          <img class="logo" src="images/logo.png" alt="">
        </div>
        <div class="maqal">
          <h1 class="maqal2">مقالات و أخبار</h1>
        </div>

      </div>
      <div class="container">

        <ul>
          <li><a href="index.php">الرئيسية</a></li>
          <li><a href="content/news.php?category=news"">أخبار</a></li>
          <li><a href=" content/legacy.php?category=legacy">ثرات</a></li>
          <li><a href="content/history.php?category=history">تاريخ</a></li>
          <li><a href="content/culture.php?category=culture">ثقافة</a></li>
          <li><a href="content/sport.php?category=sport">رياضة</a></li>
          <li><a href="content/health.php?category=health">صحة</a></li>
          <li><a href="login.php">أكتب مقال</a></li>
        </ul>
      </div>
      <div class="banner1">
      </div>
    </div>
    <div class="header">
      <div class="container">
        <div class="links">
          <span class="icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
          <ul>
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="content/health.php?category=news"">أخبار</a></li>
          <li><a href=" content/health.php?category=legacy"">ثرات</a></li>
            <li><a href="content/health.php?category=history"">تاريخ</a></li>
          <li><a href=" content/health.php?category=islam"">إسلام</a></li>
            <li><a href="content/health.php?category=sport"">رياضة</a></li>
          <li><a href=" content/health.php?category=health"">صحة</a></li>
          </ul>
        </div>
        <img class="logo" src="images/logo.png" alt="">
      </div>
      <div class="banner1">
      </div>
    </div>
  </div>


  <div class="main-aside-parent">

    <div class="main-aside-div">

      <!-- start of PHP -->
      <?php
      include 'connection.php';
      ?>
      <?php
      if ($myarticlesdb) {
        session_start();
        // if (isset($_SESSION['email'])) {
        if (1 == 1) {

      ?>



          <!-- start main -->
          <div class="main-container">
            <main>
              <?php
              $myarticle = $myarticlesdb->prepare("SELECT * FROM posts LIMIT 10 ");
              // --  WHERE userID=:userID ORDER BY date DESC");
              // -- $myarticle->bindParam("userID", $_SESSION["email"]);
              $myarticle->execute();

              if ($myarticle->rowCount() > 0) {
              ?>

                <?php foreach ($myarticle as $articles) { ?>
                  <a href=" <?php echo 'post.php?id=' . $articles['id'] ?>">
                    <div class="articles-container">
                      <p class="title-post"><?php echo $articles['title']; ?></p>
                      <div class="post-container">
                        <div class="img-post" style="background-image: url('')"><img class="img-post2" src="<?php echo $articles['imgPostUrl'] ?>" alt=""></div>
                        <article class="main-posts">
                          <?php
                           $monPost = mb_substr($articles['post'], 0, 300) . "<p class='read-more'>" . "  إقرأ المزيد  ....  " . "</p>";
                           // $remplacemtCaracter = str_replace("�", "jhgjhgjkh", $monPost);
                           $trimMonPost = trim($monPost, "");
                           echo $trimMonPost;
                          ?>


                          <!-- <a href="#" class="read-more-link"> إقرأ المزيد </a> -->
                        </article>
                      </div>
                      <p class="post-infos"><?php echo strlen($articles['post']); ?>
                        تاريخ النشر <?php echo  $articles['date']; ?> </p>
                    </div>
                  </a>




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

    $myTitles = $myarticlesdb->prepare("SELECT * FROM posts ORDER BY date DESC LIMIT 10 ");
    // $myTitles->bindParam("userID", $_SESSION["email"]);
    $myTitles->execute(); ?>


   
  <div class="aside">
    <?php
    if ($myarticle->rowCount() > 0) {
    ?>

     
        <?php foreach ($myTitles  as $titles) { ?>
          <a href=" <?php echo '../post.php?id=' . $titles['id'] ?>">
          <div class="aside-p-div">
          <img class="img-aside" src="<?php echo $titles['imgPostUrl'] ?>" alt="">
          <p  id="indexPageAsideP1" class="indexPageAsideP1"><?php echo $titles['title'] ?></p>
          </div>
        </a>
        <?php  } ?>
      <?php } else {
      echo "something is wrong";
    } ?>
     
  </div>

    </div>
  </div>
  <footer class="footer-large-screen">
    <div class="container">
      <ul>
        <li><a href="infos.php?id=1&swi=about&title=عنا">من نحن</a></li>
        <li><a href="infos.php?id=1&swi=contact&title=إتصل بنا">إتصل بنا</a></li>
        <li><a href="infos.php?id=1&swi=privacyPolicy&title=Privacy Policy">سياسة الخصوصية</a></li>
        <li><a href="infos.php?id=1&swi=cgu&title=Privacy Policy"> شروط الاستخدام</a></li>
      </ul>
    </div>
  </footer>
</body>

</html>