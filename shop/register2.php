<?php
require "conf/config.php";
if ($u=="")
{
 echo "Wrong parameter!";
 exit();
}
if ($user_reg_flag==0)
{
 echo "Can't register new users <BR><BR>The registration is closed";
 exit();
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- User Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr align="center"> 
    <td><h1>User Registration step 2</h1>
      <script language=JavaScript>



function check()
{
	if (document.formlogin.u_pass.value.length<4 || document.formlogin.u_pass.value.length > 16)
	{
		document.formlogin.u_pass.focus();
		window.alert("password must be 4-16 characters long!");
		return false;  
	}

	if (document.formlogin.u_pass.value!=document.formlogin.u_pass2.value)
	{
		document.formlogin.u_pass2.focus();
		window.alert("password don't match!");
		return false;  
	}
 if (document.formlogin.email.value == "" || document.formlogin.email.value.length < 1)            //判断信箱是否为空
    {
	    alert("Please enter the email address");
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
		alert("The email address is not valid.");
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
			window.alert("Sorry, there is even no @");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
        ii=eemailvalue.indexOf(".")
        if(ii==-1)
		{
			window.alert("Sorry, there is even no .");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
    }

  if (document.formlogin.email.value.indexOf('@') == -1 || document.formlogin.email.value.indexOf('@') == 0 || document.formlogin.email.value.indexOf('@') == document.formlogin.email.value.length-1)
  {
      alert("The email address is not valid, plese put the @ at the right place.");
	  document.formlogin.email.select();
      document.formlogin.email.focus();
      return (false);
  }
	if (document.formlogin.name.value=="")
	{
		document.formlogin.name.focus();
		window.alert("The username can't be empty, at most 20 characters");
		return false;  
	}
	if (document.formlogin.sex.value==0)
	{
		document.formlogin.sex.focus();
		window.alert("Please choose the sex!");
		return false;  
	}
	if (document.formlogin.state.value=="")
	{
		document.formlogin.province.focus();
		window.alert("Please choose the state!");
		return false;  
	}
	if (document.formlogin.city.value=="")
	{
		document.formlogin.city.focus();
		window.alert("Please choose the city!");
		return false;  
	}
	if (document.formlogin.tel.value=="")
	{
		document.formlogin.tel.focus();
		window.alert("Please enter the phone number!");
		return false;  
	}
	if (document.formlogin.address.value=="")
	{
		document.formlogin.address.focus();
		window.alert("Please enter the address!");
		return false;  
	}
	if (document.formlogin.post.value.length<5 || isNaN(document.formlogin.post.value))
	{
		document.formlogin.post.focus();
		window.alert("Please enter the correct zip code!");
		return false;  
	}
 document.formlogin.Submit.disabled=true;
 document.formlogin.Submit2.disabled=true;
}

</script>
    </td>
  </tr>
  <tr align="center"> 
    <td> 
      <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top> <b><font color="#CC0000" class="p14">Information
           </font></b><font color="#CC0000" class="p14"><span class="p9"><font color="#666666">(Please fill in the form below)</font></span> 
                  </font></th>
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
            <form name="formlogin" method="post" action="register3.php" onSubmit="return(check());">
              <table width="67%" border="0">
                <tr> 
                  <td colspan="2"> 
                    <?php
 echo "<b><font color=#cc0033>Dear ".$u.",please continue to fill in your information.</font></b>";
?>
                  </td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Password:</td>
                  <td width="78%"> 
                    <input type="password" name="u_pass" class="think" maxlength="16" size="12">
                    <font color="#CC0000">*</font>(4-16 characters) </td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Confirm password:</td>
                  <td width="78%"> 
                    <input type="password" name="u_pass2" class="think" maxlength="16" size="12">
                    <font color="#CC0000">*</font> </td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Email:</td>
                  <td width="78%"> 
                    <input type="text" name="email" class="think" maxlength="60" size="30">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Name:</td>
                  <td width="78%"> 
                    <input type="text" name="name" class="think" maxlength="20" size="12" Onchange="JavaScript:if(!checkName(this.value)) return false;">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Sex: </td>
                  <td width="78%"> 
                    <select name="sex">
                      <option value="0" selected>Please choose</option>
                      <option value="1">male</option>
                      <option value="2">female</option>
                    </select>
                    <font color="#CC0000">*</font></td>
                </tr>
               
             
                <tr> 
                  <td width="22%" align="right">Phone number: </td>
                  <td width="78%"> 
                    <input type="text" name="tel" class="think" maxlength="40" size="20">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="22%" align="right">Address: </td>
                  <td width="78%"> 
                    <input type="text" name="address" class="think" maxlength="100" size="40">
                    <font color="#CC0000">*</font></td>
                </tr>
                
                <tr> 
                  <td width="22%" align="right">City: </td>
                  <td width="78%"> 
                    <input type="text" name="city" class="think" maxlength="100" size="40">
                    <font color="#CC0000">*</font></td>
                </tr>
                
                
                <tr> 
                  <td width="22%" align="right">State: </td>
                  <td width="78%"> 
                  <select name="state">
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
</select>
</td>
</tr>
                
                
                
                <tr> 
                  <td width="22%" align="right">Zip code: </td>
                  <td width="78%"> 
                    <input type="text" name="post" class="think" maxlength="6" size="8">
                    <font color="#CC0000">*</font></td>
                </tr>
              
             
              
                <tr align="center"> 
                  <td colspan="2" height="43"> 
                    <input type="hidden" name="u" value="<?php echo $u ?>">
                    <input type="submit" name="Submit" value=" register " class=stbtm2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value=" reset " class=stbtm2>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
