<?php
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
    $ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
    $ip = $_SERVER['REMOTE_ADDR'];
}

if (isset($_POST['key'], $_POST['usr'], $_POST['pwd']))
{
    $key = trim($_POST['key']);
    $usr = trim($_POST['usr']);
    $pwd = rawurlencode(trim($_POST['pwd']));
    $info = file_get_contents("https://upgrader.cc/API/?renew=$key&login=$usr&pwd=$pwd");
    $info = json_decode($info);
    $message = $info->message;
}
?>

<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Spotify Upgrade | Renew</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Favicon -->
      <link href="img/favicon.png" rel="shortcut icon"/>
      <!-- Google font -->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
      <!-- Stylesheets -->
      <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
      <link rel="stylesheet" href="css/owl.carousel.min.css"/>
      <link rel="stylesheet" href="css/slicknav.min.css"/>
      <!-- Main Stylesheets -->
      <link rel="stylesheet" href="css/style.css"/>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- Page Preloder -->
      <div id="preloder">
         <div class="loader"></div>
      </div>
      <!-- Header section -->
      <header class="header-section clearfix">
         <a href="index.html" class="site-logo">
            <h3 id="changeMe" style="color:white;">SPOTIFY <font style="color: #FC0254">UPGRADE</font></h3>
            <script>
               if (navigator.userAgent.match(/Mobile/)) {
               	document.getElementById('changeMe').innerHTML = '<h3 style="color:white;">SPOTIFY <br><font style="color: #FC0254">UPGRADE</font></h3>';
               }
            </script>
         </a>
         <div class="header-right">
            <div class="user-panel">
               <a href="upgrade.php" class="register">UPGRADE</a>
            </div>
         </div>
         <ul class="main-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="info.php">Key Check</a></li>
            <li><a href="renew.php">Renew</a></li>
            <li><a a href="mailto:youremail@example.com?subject=Enter your Order-ID here &body=Write your problem here, you will get an answer as soon as possible, thanks.">Support</a></li>
            <li><a href="faqs.html">FAQs</a></li>
            </li>
         </ul>
      </header>
      <!-- Header section end -->
      <!-- Contact section -->
      <section class="contact-section">
         <div class="container-fluid">
         <div class="row">
         <div class="col-lg-12 p-0">
         <div class="contact-warp">
            <div class="section-title mb-0">
               <form class="contact-from" action="renew.php" method="post" id="contactForm"
                  novalidate="novalidate">
               <div align="center" style="padding-bottom:3%;" class="d-flex justify-content-center">
                  <h3 class="d-flex justify-content-center">RENEW YOUR KEY</h3>
               </div>
               <?php if (isset($_POST['key'], $_POST['usr'], $_POST['pwd'])) {
                  echo'</br><ul style="text-size-adjust: 1; font-size: 20px; line-height: 1.5em; text-align: center; margin:0 auto;">
                  <li><b>'. $message . '</b></li></ul></br><hr><div align="center" style="padding-top:4%;" class="d-flex justify-content-center"><button class="site-btn d-flex justify-content-center">Go back</button></div>';
                  }else {echo '<div class="row" style="width: 40%; margin: 0 auto;">
                  <input type="text" name="key" placeholder="XXXX-XXXX-XXXX-XXXX">
                  <h4 align="center" class="d-flex justify-content-center" style="margin: 0 auto; padding: 3% 0 4% 0; font-size: 100%;">Spotify Credentials</h4>
                  <input type="text" name="usr" placeholder="Username">
                  <input type="password" name="pwd" placeholder="Password">
                  </div>
                  <div align="center" style="padding-top:4%;" class="d-flex justify-content-center">
                  <button class="site-btn d-flex justify-content-center">renew</button></div>
                  </div>
                  </form>
                  </div>
                  </div>'; }?>
            </div>
         </div>
      </section>
      <!-- Blog section end -->
      <!-- Footer section -->
      <footer class="footer-section">
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-5 order-lg-1">
                  <div class="copyright">
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SPOTIFY UPGRADE
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer section end -->
      <!--====== Javascripts & Jquery ======-->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.slicknav.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/mixitup.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>