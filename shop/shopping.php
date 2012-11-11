<?php
session_start();

if (isset($id2))
{
if ($scj)
{
$f=1;
$scsp=split("&&",$scj);
for($j=0;$j<count($scsp);$j++)
   if ($scsp[$j]==$id2) $f=0;
if ($f)
  setcookie("scj",$scj."&&".$id2,time()+60*60*24*365); 
}
else
  setcookie("scj",$id2,time()+60*60*24*7); 
echo '<meta http-equiv="refresh" content="0;URL=shopping.php">';
}

if (isset($_GET['id']))
    {
         if (isset($_SESSION['basket_items']))  
              require("addto_basket.php"); 
         else  
              require("new_basket.php") ;
    }
require("display.php");
?>