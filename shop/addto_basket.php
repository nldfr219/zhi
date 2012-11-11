<?php
$ff=0; 

for($count=0;$count<$_SESSION['basket_items'];$count++)
        {
          if ($_SESSION['basket_id'][$count]==$_GET['id'])
                                  
                {
                  $ff=1;
                  
                  $basket_position=$count;
                  
                }
         }
          if ($ff==1)
               {
                  
                  $_SESSION['basket_amount'][$basket_position]++;
              }
          else
               {
               
     		  $_SESSION['basket_amount'][$_SESSION['basket_items']]=1;
     		  $_SESSION['basket_id'][$_SESSION['basket_items']]=$_GET['id'];
     		  $_SESSION['basket_items']++;
               }
              
?>