<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Bermain Validasi Dengan jQuery</title>
	<!-- CSS -->
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<!-- JS -->
	<script type="text/javascript" src="../jslain/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#signupform").validate(
		{
			messages: {
				email: {
					required: "E-mail is required",
					email: "E-mail does not valid"
				}
			},
			errorPlacement: function(error, element) {
				error.appendTo(element.parent("td"));
			}
		});
	})
	</script>
	<script type="text/javascript" src="../jslain/jquery.validate.pack.js"></script>
	<!-- End -->
</head>
<body>
	
    
     <form id="contact-form" name="kategori-form" method="post" action="singup.php" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                <td width="15%"><label for="judul">Judul Kategori</label></td>
                <td width="60%"><input type="text" size="23" 	title="Please enter kategori at least 3 and max 15 characters!" class="required" name="kategori" id="kategori"/></td>
                <td width="25%" id="errOffset">&nbsp;</td>
                </tr>
                
              
                
                <tr>
                <td valign="top">&nbsp;</td>
                <td colspan="2"><input type="submit" name="input" id="input" value="Submit"  class="submitform"  onclick="submitform()" />
                <img id="loading" src="img/ajax-load.gif" width="16" height="16" alt="loading" /></td>
                </tr>
            </table>
</body>