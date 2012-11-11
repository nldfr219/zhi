<?php
if(isset($id))
{
  require "conf/config.php";
  if($url)
  {
    $db->query("update $link_t set clicks=clicks + 1 where id=$id");
    Header("Location: $url");
  }
  else
  {
    $db->query("update $link_t set views=views + 1 where id='$id'");
    header("Content-type: image/jpeg,gif");
    $db->query("select image from $link_t where id='$id'");
    $db->next_record();
    echo $db->f('image');
  }
  return;
}

function getALink($link)
{
  global $db;
  $width =$db->f('width');
  if($width > 0) $width = "width=$width";
  $height = $db->f('height');
  if($height > 0) $height = "height=$height";
  return "<a href=\"link.php?id=".$db->f('id')."&url=".$db->f('url')."\" target=_blank><img src=link.php?id=".$db->f('id')." $width $height alt=\"" . $db->f('name') . "\" border=0></a>";
}

function getLink(&$count, $ids, &$id)
{
  global $db, $link_t;
  $db->query("select min(id) minID, max(id) maxID, count(id) maxCount from $link_t where visible=1");
  $db->next_record();
  $min = $db->f('minID');
  $max = $db->f('maxID');
  $maxCount = $db->f('maxCount');
  if(!$min || !$max) return ""; //可能没有记录
  if($count > $maxCount) $count = $maxCount;

  do
  {
    if($min == $max) $id = $min;
    else
    {
      do
      {
        srand((double)microtime()*1000000);
        $id = rand($min, $max);
      } while(in_array($id, $ids));
    }

    $db->query("select id,name,url,width,height from $link_t where id=$id and visible=1");
    $db->next_record();
    if($db->num_rows()) $result = getALink($link);
  } while(!$db->num_rows());
  return $result;
}

function showLinks($count = 5)
{
  $ids = array();
  $id = -1;
  for($i = 0; $i < $count; $i ++)
  {
    echo "<tr bgcolor='#ffffff'><td height=40 align=center>" . getLink($count, $ids, $id) . "</td></tr>\n";
    $ids[] = $id;
  }
}
?>