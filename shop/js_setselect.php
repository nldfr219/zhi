<script language="JavaScript">
function setSelect(formName, selectName, value)
{
  var options = document.forms[formName].elements[selectName].options;
  for(i = 0; i < options.length; i ++)
    if(options[i].value == value)
    {
      options.selectedIndex = i;
      break;
    }
}
</script>
