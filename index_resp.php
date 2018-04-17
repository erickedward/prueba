<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="includes/bootstrap/css/fileinput.min.css">
 	<!-- Tema opcional -->
	<link rel="stylesheet" href="includes/bootstrap/css/bootstrap-theme.min.css">
 	<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
	<script src="includes/js/jquery-2.2.1.min.js"></script>	
	<script src="includes/bootstrap/js/bootstrap.min.js"></script>
	<script src="includes/bootstrap/js/fileinput.min.js"></script>
	<script src="js/js_pruebas.js"></script>

	<title></title>
</head>
<body>

<a href="bootstrap/index.html">Bootstrap</a>
<input id="id_asunto_correo" name="asunto_correo" class="form-control" maxlength="200" size="59" value="" type="text" placeholder="Asunto">



<div class="container">
<h1>Bootstrap File Input Example</h1>
<form enctype="multipart/form-data">
<div class="form-group">
<input id="file-1" type="file" class="file" multiple=true data-preview-file-type="any">
</div>
<div class="form-group">
<input id="file-2" type="file" class="file" readonly=true>
</div>
<div class="form-group">
<input id="file-3" type="file" multiple=true>
</div>
<div class="form-group">
<button class="btn btn-primary">Submit</button>
<button class="btn btn-default" type="reset">Reset</button>
</div>
</form>
</div>
 
<br><br><br><hr><br><br><br>


<div class="alert alert-success">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>

<div class="alert alert-info">
  <strong>Info!</strong> Indicates a neutral informative change or action.
</div>

<div class="alert alert-warning">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> Indicates a warning that might need attention.
</div>

<div class="alert alert-danger">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
</div>

<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Indicates a successful or positive action.
</div>


<div class="w3-code notranslate">
      <h1>Asunto</h1>
      <h2>h2 heading <small>secondary text</small></h2>
      <h3>h3 heading <small>secondary text</small></h3>
      <h4>h4 heading <small>secondary text</small></h4>
      <h5>h5 heading <small>secondary text</small></h5>
      <h6>h6 heading <small>secondary text</small></h6>
</div>

<pre>prueba

asd
</pre>



 <form class="form-inline">
  <div class="form-group">
    <label for="focusedInput">Focused</label>
    <input class="form-control" id="focusedInput" type="text">
  </div>
  <div class="form-group">
    <label for="inputPassword">Disabled</label>
    <input class="form-control" id="disabledInput" type="text" disabled>
  </div>
  <div class="form-group has-success has-feedback">
    <label for="inputSuccess2">Input with success</label>
    <input type="text" class="form-control" id="inputSuccess2">
    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
  </div>
  <div class="form-group has-warning has-feedback">
    <label for="inputWarning2">Input with warning</label>
    <input type="text" class="form-control" id="inputWarning2">
    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
  </div>
  <div class="form-group has-error has-feedback">
    <label for="inputError2">Input with error</label>
    <input type="text" class="form-control" id="inputError2">
    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
  </div>
</form>


 <form class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <p class="form-control-static">someone@example.com</p>
    </div>
  </div>
</form>





 <form class="form-horizontal">
  <div class="form-group">
    <label class="col-sm-2 control-label">Focused</label>
    <div class="col-sm-10">
      <input class="form-control" id="focusedInput" type="text" value="Click to focus">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Disabled</label>
    <div class="col-sm-10">
      <input class="form-control" id="disabledInput" type="text" disabled>
    </div>
  </div>
  <fieldset disabled>
    <div class="form-group">
      <label for="disabledTextInput" class="col-sm-2 control-label">Fieldset disabled</label>
      <div class="col-sm-10">
        <input type="text" id="disabledTextInput" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="disabledSelect" class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <select id="disabledSelect" class="form-control">
          <option>Disabled select</option>
        </select>
      </div>
    </div>
  </fieldset>
  <div class="form-group has-success has-feedback">
    <label class="col-sm-2 control-label" for="inputSuccess">
    Input with success and icon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputSuccess">
      <span class="glyphicon glyphicon-ok form-control-feedback"></span>
    </div>
  </div>
  <div class="form-group has-warning has-feedback">
    <label class="col-sm-2 control-label" for="inputWarning">
    Input with warning and icon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputWarning">
      <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
    </div>
  </div>
  <div class="form-group has-error has-feedback">
    <label class="col-sm-2 control-label" for="inputError">
    Input with error and icon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputError">
      <span class="glyphicon glyphicon-remove form-control-feedback"></span>
    </div>
  </div>
  <br><br>

  <div class="input-group" style="margin-bottom: 25px">
    <span class="input-group-addon">
<i class="glyphicon glyphicon-user"></i>
</span>
      <input id="login-username" class="obligatorio" type="text" onkeypress="capLock(event)" autocomplete="false" placeholder="Usuario" value="" name="username">
  </div>

</form>
</body>

</html>