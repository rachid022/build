<?php include '../header.php'; ?>

<div class="main-aside-parent">

  <div class="main-aside-div">

    <!-- start of PHP -->

    <?php



    $username = "root";
    $passwordDB = "";
    $myarticlesdb = new PDO("mysql:host=localhost;dbname=myapp1;utf8", $username, $passwordDB);
    if ($myarticlesdb) {
      session_start();
      if (isset($_GET['category'])) {

    ?>



        <!-- start main -->
        <div class="main-container">
          <main>
            <?php
            $myarticle = $myarticlesdb->prepare("SELECT * FROM posts WHERE category=:category ORDER BY date DESC ");
            $myarticle->bindParam("category", $_GET["category"]);
            $myarticle->execute();

            if ($myarticle->rowCount() > 0) {

            ?>

              <?php foreach ($myarticle as $articles) { ?>
                <a href=" <?php echo '../post.php?id=' . $articles['id'] ?>">
                  <div class="articles-container">
                    <p class="title-post"><?php echo $articles['title']; ?></p>
                    <div class="post-container">
                      <div class="img-post" style="background-image: url('')"><img class="img-post2" src="<?php echo $articles['imgPostUrl'] ?>" alt=""></div>
                      <article class="main-posts">
                        <?php $monPost = mb_substr($articles['post'], 0, 300) . "<p class='read-more'>" . "  إقرأ المزيد  ....  " . "</p>";
                        // $remplacemtCaracter = str_replace("�", "jhgjhgjkh", $monPost);
                        $trimMonPost = trim($monPost, "");
                        echo $trimMonPost; ?>
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

  $myarticle = $myarticlesdb->prepare("SELECT * FROM posts ORDER BY date DESC LIMIT 10");
  // $myarticle->bindParam("category", $_GET["category"]);
  $myarticle->execute(); ?>




  <div class="aside">
    <?php
    if ($myarticle->rowCount() > 0) {
    ?>

     
        <?php foreach ($myarticle as $titles) { ?>
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
<?php include '../footer.php'; ?>