<?php

$pid=$_GET['pid'];

   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('recipes.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

$query = "SELECT * FROM recipes WHERE pid = '$pid'";
$result = $db->query($query) or die("Error in query");
$t = $result->fetchArray(SQLITE3_ASSOC);
print count($t);
/*
if($rows>0){
  print "Entry Found<br>";
  return; //do not add it
}else{
  print "Entry Not Found<br>";
  return;
}
*/
   $sql =<<<EOF
      INSERT INTO recipes (pid,url,title,description,ingredients)
      VALUES ($pid,"www.google.com", "my cook book", "yum yum food", "garlic");
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
?>
