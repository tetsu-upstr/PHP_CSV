<?php
require 'header.php';
require 'validation.php';

// クロスサイトスクリプティング対策のサニタイズ：表示時に使用
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

?>


<!-- 登録画面 -->
<div>
  <form action="item_confirm.php" method="POST">
    <ul>
      <li class="item-li">
      <p>商品マスタ登録</p>
      </li>
      <li class="item-li">
        <label for="category">カテゴリ</label>
        <select name="category">
          <option value="select">選択</option>
          <option value="tea_bag">TB</option>
          <option value="leaf_tea">リーフ</option>
          <option value="barley_tea">麦茶</option>
          <option value="health_tea">健康茶</option>
          <option value="powder_tea">粉末茶</option>
          <option value="other">その他</option>
        </select>
      </li>
      <li class="item-li">
        <label for="item_name">品名:</label>
        <input type="text" name="item_name" id="item_name">
      </li>
      <li class="item-li">
        <label for="jan">JAN:</label>
        <input type="text" name="jan" id="jan" placeholder="4903148000000">
      </li>
      <li class="item-li">
        <label for="standard">規格:</label>
        <input type="text" name="standard" id="standard" placeholder="5gx50p">
      </li>
      <li class="item-li">
        <label for="number_contained">入数:</label>
        <input type="text" name="number_contained" id="number_contained" placeholder="20">
      </li>
      <li class="item-li">
        <label for="regular_price">定価:</label>
        <input type="text" name="regular_price" id="regular_price" placeholder="500">
      </li>
      <li class="item-li">
        <label for="expiration_date">賞味期限:</label>
        <input type="text" name="expiration_date" id="expiration_date" placeholder="300">
      </li>
      <li class="item-li">
        <label for="size">商品サイズ:</label>
        <input type="text" name="size" id="size" placeholder="190*280*30">
      </li>
    
      <input  type="submit" name="product_registration" class="btn btn-register" value="登録">
    </ul>
  </form>
</div>


<!-- 確認画面 -->
<div>
  <form action="item_confirm.php" method="POST">
    <ul>
      <li class="item-li">
      <p>商品マスタ登録</p>
      </li>
      <li class="item-li">
        <label for="category">カテゴリ</label>
        <?php echo h($_POST['category']); ?>
      </li>
      <li class="item-li">
        <label for="item_name">品名:</label>
        <?php echo h($_POST['item_name']); ?>
      </li>
      <li class="item-li">
        <label for="jan">JAN:</label>
        <?php echo h($_POST['jan']); ?>
      </li>
      <li class="item-li">
        <label for="standard">規格:</label>
        <?php echo h($_POST['standard']); ?>
      </li>
      <li class="item-li">
        <label for="number_contained">入数:</label>
        <?php echo h($_POST['number_contained']); ?>
      </li>
      <li class="item-li">
        <label for="regular_price">定価:</label>
        <?php echo h($_POST['regular_price']); ?>
      </li>
      <li class="item-li">
        <label for="expiration_date">賞味期限:</label>
        <?php echo h($_POST['expiration_date']); ?>
      </li>
      <li class="item-li">
        <label for="size">商品サイズ:</label>
        <?php echo h($_POST['size']); ?>
      </li>
      <p>上記の情報で正しければ、登録ボタンを押して確定してください。</p>
      <a href="item_input.php?action=rewrite">&laquo;&nbsp;修正</a>
      <input  type="submit" name="product_registration" class="btn btn-register" value="登録">
    </ul>
  </form>
</div>