<?php 
require 'connect.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">
  <title>Sales</title>
</head>
<body>

<?php

// 検索

$sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count FROM sales_result";

if($_POST['start'] == "" && $_POST['end'] == "") {
  $sql .= " GROUP BY DATE_FORMAT(month, '%Y年%m月')";
} else {
  $start = $_POST['start'];
  $end = $_POST['end'];
  $sql .= " WHERE month BETWEEN '$start' AND '$end' GROUP BY DATE_FORMAT(month, '%Y年%m月')";
}

$sales_result = $pdo->prepare($sql);
$sales_result->execute();

?>

<div>
  <table>
    <tr><td>商品検索</td>
    <form action="index.php" method="POST">
      <td><input type="text" name="name"></input></td>
      <td><input type="submit" name="search" class="btn"></td></tr>  
    </form>
  </table>
  
</div>

<div>
  <p>集計期間</p>
  <form action="index.php" method="POST">
    開始<input type="date" name="start">
    終了<input type="date" name="end">
       <input type="submit" name="check" class="btn">
  </form>
</div>

<button class="btn"><a href="input.php">商品登録</a></button>

<p><i class="fas fa-money-check"></i> 販売実績</p>
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

<?php


// 商品リスト
$sql = "SELECT * FROM item ";
$result = $pdo->prepare($sql);
$result->execute();

?>

<p><i class="fas fa-save"></i> 商品リスト</p>
<table class="item-table">
  <tr>
    <th>品名</th>
    <th>JAN</th>
    <th>規格</th>
    <th>入数</th>
    <th>定価</th>
    <th>賞味期限</th>
    <th>商品サイズ（幅*高*奥）</th>
  
    <?php
    foreach($result as $row) {
      echo '<tr>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['jan'] .'</td>';
      echo '<td>' . $row['standard'] .'</td>';
      echo '<td>' . $row['number_contained'] .'</td>';
      echo '<td>' . $row['regular_price'] . '円' .'</td>';
      echo '<td>' . $row['expiration_date'] . '日' .'</td>';
      echo '<td>' . $row['size'] .'mm' . '</td>';
      echo '</tr>';
    }
    ?>

</table>

</body>
</html>