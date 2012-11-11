<?php
require "conf/config.php";
include "chk.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- Edit Profile </title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center"> 
    <td><h1>Edit profile</h1></td>
  </tr>
  <tr align="center" bgcolor="#EFEFEF"> 
    <td> 
      <?php
if (isset($submit))
{

 
  
  $db->query("update $user_t set u_pass='$u_pass', name='$name', sex='$sex', email='$email', state='$state', city='$city', tel='$tel',
            address='$address', 
			post='$post'
			where id=$login_id");
echo "<br><br>Your profile has been successfully modified!<br><br>";
echo "<input type=\"button\" value=\"return\" onClick=\"JavaScript:window.location.href='index.php'\" class=\"stbtm\"  name=\"button3\"><br><br>";
}
else
{
$db->query("select * from $user_t where id=$login_id");
$db->next_record();
?>
      <script language=javascript>


function check()
{
	
	if (document.formlogin.u_pass.value.length<4 || document.formlogin.u_pass.value.length > 16)
	{
		document.formlogin.u_pass.focus();
		window.alert("Password must be 4-16 characters!");
		return false;  
	}

	if (document.formlogin.u_pass.value!=document.formlogin.u_pass2.value)
	{
		document.formlogin.u_pass2.focus();
		window.alert("Passwords don't match!");
		return false;  
	}
 if (document.formlogin.email.value == "" || document.formlogin.email.value.length < 1)            //判断信箱是否为空
    {
	    alert("Please enter email!");
	    document.formlogin.email.select();
	    document.formlogin.email.focus();
	    return (false);
	}

	var checkOKeemail = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_@.";           //判断信箱中是否有非法字符
	var checkStreemail = document.formlogin.email.value;
	var allValideemail = true;
	for (i = 0;  i < checkStreemail.length;  i++)
	{
		ch = checkStreemail.charAt(i);
		for (j = 0;  j < checkOKeemail.length;  j++)
		if (ch == checkOKeemail.charAt(j))
			break;
		if (j == checkOKeemail.length)
		{
			allValideemail = false;
			break;
		}
	}

	if (document.formlogin.email.value.length < 6 || document.formlogin.email.value.length >60) //判断信箱长度是否合法
	{
		allValideemail = false;
	}

	if (!allValideemail)                                                   //判断信箱中是否有非法字符
	{
		alert("Your email is not valid, please check!");
		document.formlogin.email.select();
		document.formlogin.email.focus();
		return (false);
	}

	eemailvalue=document.formlogin.email.value;
    if(eemailvalue.length>0)
	{
        i=eemailvalue.indexOf("@");
        if(i==-1)
		{
			window.alert("There is even no @");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
        ii=eemailvalue.indexOf(".")
        if(ii==-1)
		{
			window.alert("There is even no .");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
    }

  if (document.formlogin.email.value.indexOf('@') == -1 || document.formlogin.email.value.indexOf('@') == 0 || document.formlogin.email.value.indexOf('@') == document.formlogin.email.value.length-1)
  {
      alert("The @ is not at the right position");
	  document.formlogin.email.select();
      document.formlogin.email.focus();
      return (false);
  }
	if (document.formlogin.name.value=="")
	{
		document.formlogin.name.focus();
		window.alert("username can't be blank, at most 20 characters ");
		return false;  
	}
	if (document.formlogin.sex.value==0)
	{
		document.formlogin.sex.focus();
		window.alert("Please choose your sex!");
		return false;  
	}
	if (document.formlogin.province.value=="")
	{
		document.formlogin.province.focus();
		window.alert("Please choose your state!");
		return false;  
	}
	if (document.formlogin.city.value=="")
	{
		document.formlogin.city.focus();
		window.alert("Please choose your city!");
		return false;  
	}
	if (document.formlogin.tel.value=="")
	{
		document.formlogin.tel.focus();
		window.alert("Please fill in the telephone number!");
		return false;  
	}
	if (document.formlogin.address.value=="")
	{
		document.formlogin.address.focus();
		window.alert("Please enter the address!");
		return false;  
	}
	if (document.formlogin.post.value.length<6 || isNaN(document.formlogin.post.value))
	{
		document.formlogin.post.focus();
		window.alert("Please enter the correct zip code!");
		return false;  
	}
}
</script>
      <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top><font color=#ffffcc 
                  face="Arial, Helvetica, sans-serif"><b><font class=p14 
                  color=#cc0000>Your detail Information：</font></b></font></th>
              </tr>
              <tr bgcolor=#cc0000> 
                <td colspan=4 height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <tr align="center"> 
          <td height="18"> 
            <form name="formlogin" method="post" onSubmit="return(check());">
              <table width="96%" border="1" bordercolorlight="#d2d2d2" cellpadding="0" cellspacing="0" bordercolordark="#ffffff">
                <tr align="center"> 
                  <td> 
                    <table width="70%" border="0">
                      <tr> 
                        <td colspan="2">&nbsp; </td>
                      </tr>
                      <tr> 
                        <td align="right" width="22%">New password：</td>
                        <td width="78%"> 
                          <input type="password" name="u_pass" class="think" maxlength="16" size="12">
                          <font color="#CC0000">*</font> </td>
                      </tr>
                      <tr> 
                        <td align="right" width="22%">Confirm password：</td>
                        <td width="78%"> 
                          <input type="password" name="u_pass2" class="think" maxlength="16" size="12">
                          <font color="#CC0000">*</font> </td>
                      </tr>
                      <tr> 
                        <td align="right" width="22%">Email：</td>
                        <td width="78%"> 
                          <input type="text" name="email" class="think" maxlength="60" size="30" value="<?php echo $db->f('email') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right" width="22%">Name：</td>
                        <td width="78%"> 
                          <input type="text" name="name" class="think" maxlength="20" size="12" value="<?php echo $db->f('name') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">Sex： </td>
                        <td width="78%"> 
                          <select name="sex">
                            <option value="0" <?php if($db->f('sex')==0)echo "selected='selected'" ?> >Please choose</option>
                            <option value="1" <?php if($db->f('sex')==1)echo "selected='selected'" ?> >male</option>
                            <option value="2" <?php if($db->f('sex')==2)echo "selected='selected'" ?> >female</option>
                          </select>
                          <font color="#CC0000">*</font></td>
                      </tr>
                     
                      
                      <tr> 
                        <td align="right" width="22%">Phone number： </td>
                        <td width="78%"> 
                          <input type="text" name="tel" class="think" maxlength="40" size="20" value="<?php echo $db->f('tel') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right" width="22%">Address： </td>
                        <td width="78%"> 
                          <input type="text" name="address" class="think" maxlength="100" size="40" value="<?php echo $db->f('address') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                     
                      
                      
                 <tr> 
                  <td width="22%" align="right">City： </td>
                  <td width="78%"> 
                    <input type="text" name="city" class="think" maxlength="100" size="40" value="<?php echo $db->f('city') ?>">
                    <font color="#CC0000">*</font></td>
                </tr>
                
                
                <tr> 
                  <td width="22%" align="right">State： </td>
                  <td width="78%">
                
                  <select name="state" >
	<option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AZ">AZ</option>
	<option value="AR">AR</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DE">DE</option>
	<option value="DC">DC</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="IA">IA</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="ME">ME</option>
	<option value="MD">MD</option>
	<option value="MA">MA</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MS">MS</option>
	<option value="MO">MO</option>
	<option value="MT">MT</option>
	<option value="NE">NE</option>
	<option value="NV">NV</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>
	<option value="NY">NY</option>
	<option value="NC">NC</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WV">WV</option>
	<option value="WI">WI</option>
	<option value="WY">WY</option>
</select><font color="#CC0000"> * </font>(Please reselect)
</td>
</tr>
                      
   <tr> 
       <td align="right" width="22%">Zip code： </td>
       <td width="78%"> 
       <input type="text" name="post" class="think" maxlength="6" size="8" value="<?php echo $db->f('post') ?>">
       <font color="#CC0000">*</font></td>
   </tr>                    
                      
                      
                      
                      
                      
                      
                      <tr align="center"> 
                        <td colspan="2" height="44"> 
                          <input type="submit" name="submit" value=" Save " class=stbtm2>
                          　　 
                          <input type="reset" name="Submit2" value=" Cancel " onClick="history.go(-1)" class=stbtm2>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <?php 
} 
?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
