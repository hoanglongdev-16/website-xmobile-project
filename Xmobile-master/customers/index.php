<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xmobile</title>
    <link rel="shortcut icon" type="image/png" href="images/header/logo.png">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/icon.css">
</head>
<body>
  
    <div class="page-wrapper">
    <?php
        //header
        include_once "pages/header.php";
        //main content
        include_once "pages/main.php";
        //footer
        include_once "pages/footer.php";
    ?>
    </div>
</body>
    <!-- icon -->
<div class='float-contact'>
  <div class='chat-zalo'>
    <a href='https://zalo.me/0858622575' target='_blank'>
      <img title='Chat Zalo' src='images/icon/Icon_of_Zalo.svg.webp' width='40' height='40' />
    </a>
  </div>

  <div class="chat-facebook">
    <a href="https://www.facebook.com/messages/e2ee/t/24690525940538823" target="_blank">
      <img title="Chat Facebook" src="images/icon/Facebook_Messenger_logo_2020.svg.webp" width="40" height="40" />
    </a>
  </div>
</div>
<!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="js/aos.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</html>