<table width="750"  border="0"  align="center" cellspacing="0">
  <tr> 
    <td align="right" colspan="3" bgcolor="#E1ECff"> <a href="index.php" >Homepage</a> 
      | <a href="register1.php">Register</a> | <a href="login.php">Login</a> | <a href="modify.php">Edit Profile</a> 
      | <a href="logout.php">Logout</a> 
    
      &nbsp; </td>
  </tr>

  <tr> 
    <td bgcolor="#ffffff" id="clock">&nbsp; </td>
    <td align="right" bgcolor="#ffffff" colspan="2"><a href="buycar.php"><img src="images/gwc.gif" width="72" height="19" border="0"></a> 
      &nbsp;&nbsp; 
      &nbsp;&nbsp;<a href="bank.php"><img src="images/syt.gif" width="72" height="21" border="0"></a> 
      &nbsp;&nbsp;<a href="dingdang.php"><img src="images/cy.gif" width="84" height="21" border="0"></a>&nbsp;</td>
  </tr>
</table>
<table width="750" border="1" cellpadding="3" cellspacing="1" bgcolor="#000000" bordercolor="#FFFFFF" align="center">
  <tr>
    <td bgcolor="#FEFADA"> 
      <table width="750" align="center" bgcolor="#FEFADA" cellspacing="0" cellpadding="0">
        <form name="formsearch" method="post" action="index_s.php" onSubmit="return chk();">
          <tr> 
            <td><center>&nbsp;&nbsp;<a href="index.php" class="title"><font color=blue>All</font></a> &nbsp;&nbsp;&nbsp;&nbsp;<br> 
              <?php
  $db->query("select * from $class_t where up_id=0");
  $tmp1="";
  while($db->next_record())
   {
    echo "<a href='index.php?up_id=".$db->f('id')."' class='title'>".$db->f('name')."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
    $tmp1.="<option value=\"".$db->f('id')."\">".$db->f('name')."</option>";
	}	
  ?>
  </center>
            </td>
            
              <script language=JavaScript>
function chk()
{
if(document.formsearch.key.value=="")
{
   window.alert("Please enter the keywords!");
   document.formsearch.key.focus();
   return false; 
}
}   
</script>
             
           
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>

