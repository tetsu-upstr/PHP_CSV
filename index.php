<?php
require 'header.php';
require 'function/search.php';
?>

<body>
<div class="container">
  <table class="function-table">
  <thead>
    <tr>
      <th>検索</th>
      <th>集計期間</th>
      <th colspan="3"></th>
    </tr>
  </thead>
  <tbody>
    <form action="index.php" method="POST">
      <td>
        <input type="text" name="name" placeholder="品名">
        <input type="text" name="store" placeholder="店名">
      </td>
      <td>
        <input type="date" name="start">〜<input type="date" name="end">
        <input type="submit" name="search" class="btn" value="検索">
      </td>
      <td>
        <button class="btn"><a href="item_input.php">商品登録</a></button>
      </td>
      <td>
        <button class="btn cp_tooltip"><a href="csv.php">取り込み</a>
        <span class="cp_tooltiptext">CSVファイルを読み込みます</span></i></button>
      </td>
      <td>
        <button class="btn"><a href="#">POP</a></button>
      </td>
    </form>
  </tbody>
  </table>
</div>

<div class="container">
  <caption class="table-title">販売実績</caption>
  <table class="item-table">
    <tr>
      <th>品名</th>
      <th>販売月</th>
      <th>数量</th>
      <th>単価</th>
      <th>売上金額 <a href="">▲</a> <a href="">▼</a></th>
      <th>店舗</th>
    
      <?php
      if(isset($_POST['search'])) {
        foreach($result as $row) {
          echo '<tr>';
          echo '<td>' . $row['item_name'] .'</td>';
          echo '<td>' . $row['sale_month'] .'</td>';
          echo '<td>' . $row['amount'] .'</td>';
          echo '<td>' . $row['unit_price'] .'</td>';
          echo '<td>' . $row['proceeds'] .'</td>';
          echo '<td>' . $row['store'] .'</td>';
          echo '</tr>';
        }
      }
      ?>
  
  </table>
</div>

<?php
  // 商品リストの呼び出しSQL
  $sql = "SELECT * FROM item";
  $result = $pdo->query($sql);
  $result->execute();
?>

<div class="container">
  <caption class="table-title">商品リスト</caption>
  <table class="item-table" id="items">
    <thead>
      <tr>
        <th></th>
        <th class="sort" data-sort="category">カテゴリ</th>
        <th class="sort" data-sort="name">品名</th>
        <th class="sort" data-sort="jan">JAN</th>
        <th>規格</th>
        <th>入数</th>
        <th>定価</th>
        <th>賞味期限</th>
        <th>商品サイズ（幅*高*奥）</th>
      </tr>
    </thead>
    <tbody class="list">
      <?php
      foreach($result as $row) {
        echo '<tr><form action="index.php" method="POST">';
        echo '<td><input class="check" type="checkbox" name="check"></td>';
        echo '</form>';
        echo '<td class="category">' . $row['category'] .'</td>';
        echo '<td class="name">' . $row['item_name'] .'</td>';
        echo '<td class="jan">' . $row['jan'] .'</td>';
        echo '<td>' . $row['standard'] .'</td>';
        echo '<td>' . $row['number_contained'] .'</td>';
        echo '<td>' . $row['regular_price'] . '円' .'</td>';
        echo '<td>' . $row['expiration_date'] . '日' .'</td>';
        echo '<td>' . $row['size'] .'mm' . '</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <button class="btn"><a href="">商品マスタ編集</a></button>
</div>

<script>

// テーブルの並び替え
var options = {
  valueNames: [ 'category', 'name', 'jan' ]
};

var userList = new List('items', options);
userList.sort( 'category', {order : 'desc' });
userList.sort( 'jan', {order : 'desc' });

</script>
</body>
</html>