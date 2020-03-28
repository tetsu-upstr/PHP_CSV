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

// 商品リスト
// $sql = "SELECT * FROM item ";
// $result = $pdo->prepare($sql);
// $result->execute();

// 売上実績
$sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count  FROM sales_result GROUP BY DATE_FORMAT(month, '%Y年%m月')";
$sales_result = $pdo->prepare($sql);
$sales_result->execute();

?>

<button class="btn"><a href="input.php">商品登録</a></button>

<table class="item-table">
  <tr>
    <th>品名</th>
    <th>販売月</th>
    <th>数量</th>
  
    <?php
    foreach($sales_result as $row) {
      echo '<tr>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['sale_month'] .'</td>';
      echo '<td>' . $row['count'] .'</td>';
      echo '</tr>';
    }
    ?>

</table>


<!-- <table class="item-table">
  <tr>
    <th>品名</th>
    <th>JAN</th>
    <th>規格</th>
  
    <?php
    foreach($result as $row) {
      echo '<tr>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['jan'] .'</td>';
      echo '<td>' . $row['standard'] .'</td>';
      echo '</tr>';
    }
    ?>

</table> -->

</body>
</html>