<?php 
   
  if ($_POST["g-recaptcha-response"]) {
 	 echo "<hr>Respuesta -> ";
    require_once "recaptchalib.php";
    // your secret key
    //$secret = "6LcLBGEUAAAAAPBAMc5Fr92oWPuuAkUZb4RHi0df";
    $secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
    // empty response
    $response = null;
 
    // check secret key
    $reCaptcha = new ReCaptcha($secret);

    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
    if ($response != null && $response->success) {
	echo "Funciono reCaptcha Sr. ".$_POST["name"];
    } else {

        echo "Captcha no valido";
	echo "<br>errorCodes>>";
	if (is_array($response->errorCodes)){
		for ($i=0;$i<count($response->errorCodes);$i++){
			echo "<br>Pos $i) =".$response->errorCodes[$i];
		}
	}else{
		echo $response->errorCodes;
	}
     }//end if
	echo "<hr><br><br>";
  }  
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>reCatcha de Google</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form action="" method="post">
    <label for="name">Name:</label>
    <input name="name" required><br /><br>
    <div class="g-recaptcha"  data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
    <br><input type="submit" value="Submit" />
</form>
</body>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
</html>
