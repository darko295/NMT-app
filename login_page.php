<html>
<head>
    <link rel="stylesheet" href="vendor/css/login.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <div id="failed-login"></div>

</div>
</div>
</body>

<footer class="page-footer text-center" style="position:absolute; bottom: 15px; color: #0b2e13; width: 100%">
    <hr>
    <div class="footer-copyright">
        <div class="container-fluid">© 2019 Made by D. Blagojević | <i class="glyphicon glyphicon-envelope"></i> darkob295@gmail.com |
            <a title="LinkedIn profile" href="https://www.linkedin.com/in/darko-blagojevi%C4%87-186118141/"><i style="color: black;" class="fa fa-linkedin-square"></i></a>
        </div>
    </div>
</footer>

</html>
