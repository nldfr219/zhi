<?php
function showAd()
{
  global $db, $ad_t;
  $db->query("select count(id) count from $ad_t where visible=1");
  $db->next_record();
  $count = $db->f('count');
  srand((double)microtime()*1000000);
  if($count <= 1)
    $start = 0;
  else
    $start = rand(0, $count - 1);
  $db->query("select id,code from $ad_t where visible=1
    order by id desc limit $start,1");
  $db->next_record();
  echo stripslashes($db->f('code'));
  $db->query("update $ad_t set views=views+1 where id=".$db->f('id'));
}
showAd();
/*if($show)
{
  require_once("./shared.php");
  showAd();
}
else if($url)
{
  require("./shared.php");
  $url = substr($QUERY_STRING, 4); //url=...
  redir($url);
  $url = addslashes($url);
  $qry->query("update qzad set clicks=clicks+1 where code like '%$url%'");
}
*/
/* µ÷ÓÃ´úÂë
<iframe src="/ad.php?show=1" width="468" height="60" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="NO"></iframe>
*/
?>