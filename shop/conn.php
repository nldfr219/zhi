  <?php
          $connection= mysql_connect("localhost","root","135792468Mz") or die("A connection to the Server could not be established !");
          echo "Root user login in MySQL server  @ localhost successful.";
		  $result=mysql_select_db("testdb");
		  $queryresult1=mysql_query("select * from users");
		  while($row1=mysql_fetch_array($queryresult1)){
		  echo $row1['username']."+".$row1['fname']."+".$row1['lname']."<br>";}
  ?>
