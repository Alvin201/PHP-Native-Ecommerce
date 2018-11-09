   <title>Login Admin</title>
    <head>
      	<style>
			body {
  background: #eee !important;
}

.wrapper {
  margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 30px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

		</style>
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>

<link href="../themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="../themes/bootshop/bootstrap.min.css" media="screen"/>

</head>


<body OnLoad="document.login.username.focus();">
       <div class="wrapper">
    <form class="form-signin" name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">       
      <h2 class="form-signin-heading">Harika Music</h2>
      <input type="text" class="form-control" name="username" id="login" required="" autofocus="" placeholder="Username" style="width: 100%;" />
      <br/>
      <br/>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="" style="width: 100%;"/>      
       <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block"> 

    </form>
  </div>
    </body>


  <script src="../themes/js/jquery.js" type="text/javascript"></script>
	<script src="../themes/js/bootstrap.min.js" type="text/javascript"></script>