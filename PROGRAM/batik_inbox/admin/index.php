<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Batik Inbox</title>
<link rel="shortcut icon" href="../image/bg,%20header%20dll/inbox_logo.png" />
<link rel="stylesheet" type="text/css" href="../css/default_admin.css" >
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#loginform").validate();
})
</script>

<style TYPE="text/css" > 
    <!--
	* { margin: 0; padding: 0; }
	body {font-family: Verdana, Arial; font-size: 12px; line-height: 18px; }
	a { text-decoration: none; }
	.container{margin: 20px auto; width: 542px; margin-top:200px;}
	h3 { margin-bottom: 15px; font-size: 22px; text-shadow: 2px 2px 2px #ccc; }
	
	#loginform {
	width: 500px;
	padding: 20px;
	background: #f2f2f2;
	overflow:auto;
	
	border: 1px solid #cccccc;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	
	-moz-box-shadow: 2px 2px 2px #cccccc;
	-webkit-box-shadow: 2px 2px 2px #cccccc;
	box-shadow: 2px 2px 2px #cccccc;
	}
	
	.field{margin-bottom:7px;}
	
	label {
	font-family: Arial, Verdana; 
	text-shadow: 2px 2px 2px #ccc;
	display: block; 
	float: left; 
	font-weight: bold; 
	margin-right:10px; 
	text-align: right; 
	width: 120px; 
	line-height: 25px; 
	font-size: 15px; 
	}
	
	.input{
	font-family: Arial, Verdana; 
	font-size: 15px; 
	padding: 5px; 
	border: 1px solid #b9bdc1; 
	width: 300px; 
	color: #3d3d3d;	
	}
	
	.input:focus{
	background-color:#dcffb0;	
	}
	
	.textarea {
	height:150px;	
	}
	
	.hint{
	display:none;
	}
	
	.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 455px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}
	
	.button{
	float: right;
	margin:10px 70px 10px 0;
	font-weight: bold;
	line-height: 1;
	padding: 6px 10px;
	cursor:pointer;   
	color: #fff;
	
	text-align: center;
	text-shadow: 0 -1px 1px #849c66;
	
	/* Background gradient */
	background: #b2da1d;
	background: -moz-linear-gradient(top, #b2da1d 0%, #569800 100%);
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#b2da1d), to(#569800));
	
	/* Border style */
  	border: 1px solid #738858;  
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
  
	/* Box shadow */
	-moz-box-shadow: inset 0 1px 0 0 #cee4b0;
	-webkit-box-shadow: inset 0 1px 0 0 #cee4b0;
	box-shadow: inset 0 1px 0 0 #cee4b0;	
	}
	
	.button:hover {
	background: #74cd00;
    cursor: pointer;
	}
    -->
   </style>  
   
</head>
<body>

<div class="jarakAntarContent"></div>
<div class="container">
<form id="loginform" class="rounded" method="post" action="cek_login.php">
<h3>Login Admin</h3>

<div class="field">
	<label for="name">Username :</label>
  	<input type="text" class="input" name="username" id="username"/>
	<p class="hint">Masukkan username anda</p>
</div>

<div class="field">
	<label for="password">Password :</label>
  	<input type="password" class="input" name="password" id="password" />
	<p class="hint">Masukkan password anda</p>
</div>

<input type="submit" name="submit"  class="button" value="Login" style="font-size: 13px; " />
</form>
<br />
</div>

</body>
</html>
