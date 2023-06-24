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

if (isset($_POST['key']))
{
    $key = trim($_POST['key']);
    $info = file_get_contents("https://upgrader.cc/API/?info=$key");
    $info = json_decode($info);
    if (isset($info->invite)) $invite = $info->invite;
    if (isset($info->address)) $address = $info->address;
    if (isset($info->verify_address)) $verify_address = $info->verify_address;
    if (isset($info->status)) $status = $info->status;
    if (isset($status))
    {
        if (isset($info->purchase_date)) $purchase_date = $info->purchase_date;
        if (isset($info->used_date)) $used_date = $info->used_date;
        if (isset($info->used)) $used = $info->used;
        switch ($status)
        {
            case "upgrade_processing":
                $message = "Upgrade in progress..";
            break;

            case "in_queue":
                $message = "Upgrade in queue";
            break;

            case "check_processing":
                $message = "Renewal in progress..";
            break;

            case "success":
                $message = "Account Upgraded";
            break;

            case "renewed":
                $message = "Key Renewed";
            break;

            case "error":
                $message = $info->message;
            break;

            case "failed":
            default:
                $message = $info->message;
            break;
        }
        if (isset($used)) {
          switch ($used){
              case 0:
              $usable = "Yes";
              break;

              case 1:
              $usable = "No";
              break;

              default:
              $usable = null;
              break;
          }
        }
        if (isset($info->country)) $country = $info->country;
    }
}
?>
   
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Spotify Upgrade | Key Check</title>
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
                        <form class="contact-from" action="info.php" method="post" id="contactForm"
                           novalidate="novalidate">
                        <div align="center" style="padding-bottom:3%;" class="d-flex justify-content-center">
                           <h3 class="d-flex justify-content-center">CHECK YOUR KEY</h3>
                        </div>
                        </br>
                        <?php 
                           if (isset($_POST['key']) && isset($status) && $status != "not_exist") {
                           echo'
                           <ul style="text-size-adjust: 1; font-size: 20px; line-height: 1.5em; text-align: center;">';
                           if (isset($message) && $message != "none") echo '<li><span style="font-size: 130%;"><b>STATUS:</b> <span style="color: #E33060;">' . $message . '</span></span></li>'; echo '
                           <li><b>KEY:</b> '. $key . '</li>';
                           if (isset($address)) echo '</br><li><b>UPGRADE LINK:</b> <a href="https://www.spotify.com/uk/family/join/invite/'.$invite.'" target="_blank">Spotify Premium Invitation</a></li>';
                           if (isset($address)) echo '<li><b>ADDRESS:</b> '. $address . '</li></br>';
                           if (isset($verify_address)) echo '<li><b>ADDRESS:</b> '. $verify_address . '</li></br>';
                           if (isset($usable)) echo '<li><b>USABLE:</b> '. $usable . '</li>';
                           if (isset($message) && $message == "none" && $purchase_date != null) echo '<li><b>PURCHASED:</b> '. $purchase_date . '</li>';
                           if (isset($used_date) && $used_date != "1970-01-01 01:00") echo '<li><b>LAST USE:</b> '. $used_date . '</li>'; echo '
                           </ul><hr></br></br>';
                           }
                           if (!isset($status) or $status != "not_exist") { echo '
                           <form action="info.php" method="POST">
                           <div class="col-md-12 ">
                           <div align="center" class="d-flex justify-content-center">
                           <input type="text" style="width: 60%;" class="d-flex justify-content-center" name="key" placeholder="XXXX-XXXX-XXXX-XXXX"></div>
                           </div><div align="center" style="padding-top:4%;" class="d-flex justify-content-center">
                           <button class="site-btn d-flex justify-content-center">check</button></div>
                           </div></form>';}
                           else {echo'<ul style="text-size-adjust: 1; font-size: 20px; line-height: 1.5em; text-align: center; margin:0 auto;">
                           <li><b>'. $message . '</b></li></ul></br><hr><div align="center" style="padding-top:4%;" class="d-flex justify-content-center"><button class="site-btn d-flex justify-content-center">Go back</button></div>'; }?> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Blog section end -->
      <style>
         .alert {
         margin-top: 1rem;
         padding: 20px;
         background-color: #f44336;
         color: white;
         }
         .success {
         margin-top: 1rem;
         padding: 20px;
         background-color: #f2f2f2;
         color: green;
         }
      </style>
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