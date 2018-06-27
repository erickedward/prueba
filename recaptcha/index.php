<?php 
    

//   foreach ($_POST as $key => $value) {
//     echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
//   }

  if ($_POST["g-recaptcha-response"]) {
    require_once "recaptchalib.php";
    // your secret key
    $secret = "6LcLBGEUAAAAAPBAMc5Fr92oWPuuAkUZb4RHi0df";
 
    // empty response
    $response = null;
 
    // check secret key
    $reCaptcha = new ReCaptcha($secret);

    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
    if ($response != null && $response->success) {
        echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
    } else {
        echo "<br><br><br><br>captcha no valido<br><br><br><br>";
     }//end if
  }else{

  }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>reCatcha de Google</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<form action="" method="post">
    <label for="name">Name:</label>
    <input name="name" required><br />
    <div class="g-recaptcha" data-theme="dark" data-sitekey="6LcLBGEUAAAAAPs2Ppo4FjXuMk0WEzUWsjOzZ-9v"></div>
    <input type="submit" value="Submit" />
</form>
</body>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
</html>