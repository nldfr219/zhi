<script language="JavaScript">
function CheckAll(form,flag)
{
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name.substring(0,6) == 'delete')
       e.checked = flag;
    }
}
</script>