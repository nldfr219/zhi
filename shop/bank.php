<?php
require "conf/config.php";
include "chk.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- check out</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td bgcolor="#FFFFFF"> 
      <?php
    
if (empty($basket_items))
{
 echo "<center><br><br><img src='images/emptcart.gif'>";
 echo  "<br><input  name='continue shopping' onClick=\"window.location.href='index.php';\" type=button value='continue shopping'>";
 echo "</center><br>";
}
else
{
?>
      <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center"><h1>Check Out</h1></td>
        </tr>
        <tr> 
          <td> 
            <table cellpadding=0 cellspacing=0 width=630>
              <tbody> 
              <tr> 
                <td align=left width="80%"><b><font class=p14 color=#cc0000>Cart
                </font></b></td>
              </tr>
              <tr bgcolor=#cc0000> 
                <td height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <tr> 
          <td> 
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr> 
                <td bgcolor="#e4e4e4"><font color=#000000 
      size=2>product name</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4">retail</td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>membership</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>quantity</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>subtotal</font></td>
              </tr>
              <?php
$price_all=0;
for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
{
            $amount=$basket_amount[$basket_counter];;
			$db->query("select name,price_m,price from $goods_t where id=$basket_id[$basket_counter]");
            $db->next_record();
			$price_all=$price_all+$db->f('price')*$amount;
?>
              <tr> 
                <td><b> 
                  <?php echo stripslashes($db->f('name')); ?>
                  </b></td>
                <td width="15%" align="center"><font color=#000000 
      size=2><strike>$<?php echo $db->f('price_m'); ?></strike> </font> </td>
                <td width="15%" align="center"><b><font 
      color=#cc0000>$<?php echo $db->f('price'); ?></font></b></td>
                <td width="15%" align="center"> 
                  <?php echo $basket_amount[$basket_counter] ?>
                </td>
                <td width="15%" align="center"> 
                  <?php echo $db->f('price')*$amount; ?>
                </td>
              </tr>
              <?php 
}
$price_all_format=sprintf("%01.2f",$price_all); 
?>
              <tr> 
                <td colspan="5" width="100%" height="1" background="images/speaking_bg.gif"></td>
              </tr>
              <tr> 
                <td colspan="5">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp; </td>
                <td> 
                  <input  name=changeOK1 onClick="JavaScript:window.location.href='buycar.php';" type=button value="adjust products">
                </td>
                <td>&nbsp;</td>
                <td colspan="2"> 
                  <?php echo "total:<b><font color=red>$$price_all_format</font></b>";?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <p align="center"><h1>Shipping and billing information</h1> 
      </p>
      <table width="630" cellspacing="0" cellpadding="0" align="center" border="1" bordercolorlight="#d2d2d2" bordercolordark="#FFFFFF">
        <tr align="center"> 
          <td> 
            <table cellpadding=0 cellspacing=0 width=630 align="center">
              <tbody> 
              <tr> 
                <td align=left width="80%"><b><font class=p14 color=#cc0000>Your shipping information</font><font class=p14><span class="p9">:
                  <script language=javascript>

function check()
{
	if (document.formlogin.name.value=="")
	{
		document.formlogin.name.focus();
		window.alert("Please enter your name!");
		return false;  
	}
	if (document.formlogin.sex.value==0)
	{
		document.formlogin.sex.focus();
		window.alert("Please choose your sex!");
		return false;  
	}
 if (document.formlogin.email.value == "" || document.formlogin.email.value.length < 1)            //判断信箱是否为空
    {
	    alert("Please enter your email!");
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
		alert("Your email address is not valid!");
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
      alert("The position of @ is not correct");
	  document.formlogin.email.select();
      document.formlogin.email.focus();
      return (false);
  }
	if (document.formlogin.state.value=="")
	{
		document.formlogin.state.focus();
		window.alert("Please choose your state!");
		return false;  
	}
	if (document.formlogin.city.value=="")
	{
		document.formlogin.city.focus();
		window.alert("Please enter your city!");
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
		window.alert("Please enter your address!");
		return false;  
	}
	if (document.formlogin.post.value.length<5 || isNaN(document.formlogin.post.value))
	{
		document.formlogin.post.focus();
		window.alert("Please enter the correct zip code!");
		return false;  
	}
return confirm("    Are you sure your information is correct ?\r\n\r\n The information can't be modified after submission!");
}
</script>
                  </span></font></b></td>
              </tr>
              <tr> 
                <td height=2 valign=top bgcolor="#cc0000"></td>
              </tr>
              </tbody> 
            </table>
            <?php
$db->query("select * from $requests_t where user_id=$login_id order by id DESC");
$db->next_record();
$num=$db->num_rows();
?>
            <script language="JavaScript">
function old_user()
{
document.formlogin.name.value="<?php echo  $db->f('name') ?>";
document.formlogin.sex.value=<?php echo ($db->f('sex')) ? $db->f('sex') : "0" ?>;
document.formlogin.email.value="<?php echo  $db->f('email') ?>";
lth=document.formlogin.province.length;
	for (i=0;i<=lth;i++)
		document.formlogin.province.remove(0);
	var oOption = document.createElement("OPTION");
	oOption.text="Please choose your state!";
        document.formlogin.province.add(oOption);
       	oOption.selected=0;	
	oOption.empty;
	for (i=1;i<=prvcnt;i++)
	{   
			var oOption = document.createElement("OPTION");
			oOption.text=prvarr[i].name;
			oOption.value=prvarr[i].id+","+prvarr[i].name;
			document.formlogin.province.add(oOption);
	         	if (prvarr[i].name=="<?php echo $db->f('province') ?>")
	         	{ oOption.selected=1;
		   	  //oOption.empty;
		   	}
		   	
	}
ctychg(document.formlogin.province.value,"<?php echo $db->f('city') ?>");
document.formlogin.tel.value="<?php echo $db->f('tel') ?>";
document.formlogin.address.value="<?php echo  $db->f('address') ?>";
document.formlogin.post.value="<?php echo $db->f('post') ?>";
set_sele_pay(<?php echo intval($db->f('pay')) ?>);
document.formlogin.attrib.value="";
document.formlogin.name.focus();
}
function set_sele_pay(pay)
{
  for(i=0;i<formlogin.pay.length;i++)
   if (formlogin.pay[i].value==pay) formlogin.pay[i].checked=true;
}
</script>
            <?php
$db->query("select * from $user_t where id=$login_id");
$db->next_record();
?>
            <script language="JavaScript">
function my_info()
{
document.formlogin.name.value="<?php echo  $db->f('name') ?>";
document.formlogin.sex.value=<?php if ($db->f('sex')) echo $db->f('sex'); else "0"; ?>;
document.formlogin.email.value="<?php echo  $db->f('email') ?>";
lth=document.formlogin.province.length;
	for (i=0;i<=lth;i++)
		document.formlogin.province.remove(0);
	var oOption = document.createElement("OPTION");
	oOption.text="Please choose your state";
        document.formlogin.province.add(oOption);
       	oOption.selected=0;	
	oOption.empty;
	for (i=1;i<=prvcnt;i++)
	{   
			var oOption = document.createElement("OPTION");
			oOption.text=prvarr[i].name;
			oOption.value=prvarr[i].id+","+prvarr[i].name;
			document.formlogin.province.add(oOption);
	         	if (prvarr[i].name=="<?php echo $db->f('province') ?>")
	         	{ oOption.selected=1;
		   	  //oOption.empty;
		   	}
		   	
	}
ctychg(document.formlogin.province.value,"<?php echo $db->f('city') ?>");
document.formlogin.tel.value="<?php echo $db->f('tel') ?>";
document.formlogin.address.value="<?php echo  $db->f('address') ?>";
document.formlogin.post.value="<?php echo $db->f('post') ?>";
document.formlogin.pay[0].checked=true;
document.formlogin.attrib.value="";
document.formlogin.name.focus();
}
function new_user()
{
document.formlogin.name.value="";
document.formlogin.sex.value=0;
document.formlogin.email.value="";
lth=document.formlogin.province.length;
	for (i=0;i<=lth;i++)
		document.formlogin.province.remove(0);
	var oOption = document.createElement("OPTION");
	oOption.text="Please choose your state";
        document.formlogin.province.add(oOption);
       	oOption.selected=1;	
	oOption.empty;
	for (i=1;i<=prvcnt;i++)
	{   
			var oOption = document.createElement("OPTION");
			oOption.text=prvarr[i].name;
			oOption.value=prvarr[i].id+","+prvarr[i].name;
			document.formlogin.province.add(oOption);
	         	oOption.selected=0;
			oOption.empty;
	}
ctychg(document.formlogin.city.value,0);
document.formlogin.tel.value="";
document.formlogin.address.value="";
document.formlogin.post.value="";
document.formlogin.pay[0].checked=true;
document.formlogin.attrib.value="";
document.formlogin.name.focus();
}
function checkName()
{
	var args=checkName.arguments
	var strWord;
	var s;
	var lStringLength;
	var i;
	var bReturn;
		
	if ( args.length > 0)
	{
		strWord = args[0];
		lStringLength = strWord.length;
		if (lStringLength>0)
		{
			for (i=0;i<lStringLength;i++)
			{
				s = strWord.charCodeAt(i);
				bReturn = true;
				if(s<255)	
					bReturn = false;
				
				if (!bReturn)
				{
					alert('Please enter your real name!');
					return false;
				}
					
			}
		}
	}
	return true;
}
</script>
            <form name="formlogin" method="post" action="payment.php" onSubmit=return(check());>
              <table width="100%" border="0">
                <tr> 
                  <td width="14%" align="center" height="18">Name:</td>
                  <td width="86%" height="18"> 
                    <input type="text" name="name" class="think" maxlength="20" size="12" >
                    <font color="#CC0000">*</font> </td>
                </tr>
               
                <tr> 
                  <td width="14%" align="center">Sex:</td>
                  <td width="86%"> 
                    <select name="sex">
                      <option value="0" selected>Please choose</option>
                      <option value="1">male</option>
                      <option value="2">female</option>
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td width="14%" align="center">E-mail:</td>
                  <td width="86%"> 
                    <input type="text" name="email" class="think" maxlength="60" size="30">
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
                  <td width="22%" align="right">City: </td>
                  <td width="78%"> 
                    <input type="text" name="city" class="think" maxlength="100" size="40">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="14%" align="center">Phone number:</td>
                  <td width="86%"> 
                    <input type="text" name="tel" class="think" maxlength="40" size="20">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="14%" align="center">Address:</td>
                  <td width="86%"> 
                    <input type="text" name="address" class="think" maxlength="100" size="40">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td width="14%" align="center">zip code:</td>
                  <td width="86%"> 
                    <input type="text" name="post" class="think" maxlength="6" size="8">
                    <font color="#CC0000">*</font></td>
                </tr>
                <tr> 
                  <td colspan="2"><b>Payment information: </b></td>
                </tr>
               <tr>
               <td><img src="images/credit.gif"></td><td>Credit or Debit cards<br>Enter your card information:<br>Card number:
               <input type="text" name="cardnumber">
               <br>
               Name on the card:
               <input type="text" name="nameoncard">
               <br>
               Expire date:
               <select name="month">
               <option value=01>01</option>
               <option value=02>02</option>
               <option value=03>03</option>
               <option value=04>04</option>
               <option value=05>05</option>
               <option value=06>06</option>
               <option value=07>07</option>
               <option value=08>08</option>
               <option value=09>09</option>
               <option value=10>10</option>
               <option value=11>11</option>
               <option value=12>12</option>
              
               </select>
               
                <select name="year">
               <option value=2012>2012</option>
               <option value=2013>2013</option>
               <option value=2014>2014</option>
               <option value=2015>2015</option>
               <option value=2016>2016</option>
               <option value=2017>2017</option>
               <option value=2018>2018</option>
               <option value=2019>2019</option>
               <option value=2020>2020</option>
               <option value=2021>2021</option>
               <option value=2022>2022</option>
               <option value=2023>2023</option>
                <option value=2024>2024</option>
               <option value=2025>2025</option>
               <option value=2026>2026</option>
               <option value=2027>2027</option>
               <option value=2028>2028</option>
               <option value=2029>2029</option>
               <option value=2030>2030</option>
               <option value=2031>2031</option>
               <option value=2032>2032</option>
               <option value=2033>2033</option>
               <option value=2034>2034</option>
               <option value=2035>2035</option>
              
               </select>
               
               
               
               </td>
               </tr>
               <tr>
              
               </tr>
			
				
                
                <tr> 
                  <td width="14%">&nbsp;</td>
                  <td width="86%">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2"> 
                    <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr> 
                        <th colspan="4" bgcolor="#FFFFFF" height="22" valign="top"> 
                          
                        </th>
                      </tr>
                      <tr bgcolor="#CC0000"> 
                        <td colspan="4" height="2" valign="top"> </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td colspan="2"> 
                    <li>If you have problem please call:<?php echo $sitetel ?></td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"> 
                    
                  </td>
                </tr>
                <tr align="center"> 
                  <td colspan="2" height="34"> 
                    <input type="submit" name="Submit" value=" submit "  class=stbtm2>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <?php } ?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
