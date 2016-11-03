<?php
session_start();

if(isset($_SESSION["login_id"])&&isset($_GET['logout'])&&$_GET['logout']==1){

unset($_SESSION["login_id"]);
unset($_SESSION["user_name"]);

}else{

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Ezy Voucher! | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
    <style>
        .full{
            overflow:hidden;
            height:auto;
            background:#000;
            magin:0px
            
        }
        
        body, .login-container, .full{
            height:100vh;
        }
        
        .right-side{
          background:#039BE5;
          text-align:center;
            display:block;
        }
        div.form{
            vertical-align:middle;
          display:table-cell;
            height:100vh;
            width:10%;
            margin:auto;
            padding:0px 50px;
        }
        .left-side{
          padding:0px;
            position:relative;
        }
        
        .mask{
          background:rgba(0,0,0,0.6);
            position:absolute;
            width:100%;
             height:100%;
            top:0;
            left:0;
        }
        
        .foot, .head{
         position:absolute;
         bottom:0px;
         left:0px;
         color:#fff;
         width:100%;
         text-align:center
        }
        
      .form-control, .btn{
        margin-bottom:4px;
        border-radius:0px;
        }
        .head{
         top:0px;
        }
        
        .btn-transparent{
         background-color:transparent;
            border:solid 3px #fff;
            color: #fff;
            margin-top:20px;
        }
        .btn-transparent:hover{
         background:#fff;
        }
        
    </style>

</head>
<body>
    <div class="login-container">
      <div class="left-side col-md-8 full">
        <iframe src="loginslider/loginslider.html" style="width:100%;min-height:100vh;overflow:hidden;border:none;padding:0;margin:0 auto;display:block;" marginheight="0" marginwidth="0"></iframe>
          
          <div class="mask">
             
          </div>
          <div class="head">
              <p style="margin-top:200px; font-size:2em"><img src="images/logo.png" width="60"/></p>
              <h1>Welcome to EzyVoucher</h1>
              <p style="font-size:1.3em; opacity:0.8" >It's an awesome app for your purchase and orders management</p>
<!--              <a class="btn btn-lg btn-transparent">Get your Account Now</a>-->
          </div>
          <div class="foot">
              <?php 
               $date = time();
               $yr = date("Y", $date);
              ?>
            <p>&copy;<?php echo $yr;?> Akorion Co. Ltd</p>
          </div>
      </div>
        
      <div class="right-side col-md-4 full">
        <div class="form">
		   <p id="error_msg" onclick="hideMe();" class="alert alert-danger hide" 
              style="font-size:10pt; color:#fff; text-align:left; padding:3px 10px;  background: #f24f07 !important; "><i class="fa fa-close"></i> Wrong username or password</p>
            <h2 style="font-size:1.4em; color:#fff; text-align:left">Login to your account</h2>
         
            <form autocomplete="off" method="post" action="./form_actions/get_tables.php"  class="form-signin" >
                <input type="hidden" name="token" value="login"/>			
                <input class="form-control" type="email" name="useremail" placeholder="username"/>
                <input class="form-control" type="password" name="password" placeholder="userpassword"/>
                <button type="submit" style="width:100px; margin:10px 0;" class="btn btn-default pull-left">LOGIN</button>
               <!-- <a style="margin-top:20px; display:inline-block; color:#fff; opacity:.6; cursor:pointer">I forgot my password</a>-->
           </form>
          </div>
      </div>
    </div>
	<script type="text/javascript">
          $(document).ready(function() {
          var success= getQueryVariable('sucess');
		  
		  
		  if(success==0&& hasClass("error_msg", "hide")){
		  removeClass("error_msg", "hide") ;
		  addClass("error_msg", "show");
		  }
		 
          });
	function hideMe(){
	
	 removeClass("error_msg", "show") ;
	 addClass("error_msg", "hide");
	}
		  
	function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
    } 
 
    }
	function hasClass(id, className) {
         var el = document.getElementById(id)
         if (el.classList)
         return el.classList.contains(className)
         else
         return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
       }

	function addClass(id, className) {
       var el = document.getElementById(id)
       if (el.classList)
       el.classList.add(className)
       else if (!hasClass(el, className)) el.className += " " + className
       }

      function removeClass(id, className) {
      var el = document.getElementById(id)
      if (el.classList)
      el.classList.remove(className)
      else if (hasClass(el, className)) {
      var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
      el.className=el.className.replace(reg, ' ')
     }
     }
	</script>
	
</body>
</html>