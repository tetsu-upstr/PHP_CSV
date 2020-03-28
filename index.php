<?php 
require 'connect.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Sales</title>
</head>
<body>

<?php

$sql = "SELECT * FROM item ";

$result = $pdo->prepare($sql);
$result->execute();

?>

<table class="item-table">
  <tr>
    <th>品名</th>
    <th>JAN</th>
  
    <?php
    foreach($result as $row) {
      echo '<tr>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['jan'] .'</td>';
      echo '</tr>';
    }
    ?>

</table>

</body>
</html>