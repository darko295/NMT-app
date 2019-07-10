<html>
<head>
    <link rel="stylesheet" href="vendor/css/login.css"/>
    <script type="text/javascript" src="vendor/js/login.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <title>Naša mala trgovina</title>
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form">
      <input id="login-username" type="text" placeholder="username"/>
      <input id="login-password" type="password" placeholder="password"/>
      <button id="login-submit" type="button" name="login_submit" onclick="login()">login</button>

    </form>
      <img id="loader"
           src="https://gifimage.net/wp-content/uploads/2017/10/colorful-loader-gif-transparent-13.gif"
           style="width: 20px; height: 20px; display: none; ">
      <div id="failed-login">
  </div>

</div>

</body>
</html>
