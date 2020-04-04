<?php
// sesson_start();
require 'header.php';
require 'function/validation.php';

// クロスサイトスクリプティング対策のサニタイズ：表示時に使用
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

// 画面遷移の判定
$pageFlag = 0;
$error = validatation_item($_POST);

// Flag1 確認画面
if (!empty($_POST['btn_confirm']) && empty($error)) {
  $pageFlag = 1;
}

// Flag1 完了画面
if (!empty($_POST['btn_submit'])) {
  $pageFlag = 2;
}

?>

<!-- 確認画面 -->
<?php if ($pageFlag === 1) : ?>
<div>
  <form action="item_input.php" method="POST">
    <ul>
      <li class="item-li">
      <p>商品マスタ登録</p>
      </li>
      <li class="item-li">
        <label for="category">カテゴリ</label>
        <?php if($_POST['category'] === 'tea_bag'){ echo 'TB';}
          elseif($_POST['category'] === 'leaf_tea'){ echo 'リーフ';}
          elseif($_POST['category'] === 'barley_tea'){ echo '麦茶';}
          elseif($_POST['category'] === 'health_tea'){ echo '健康茶';}
          elseif($_POST['category'] === 'powder_tea'){ echo '粉末茶';}
          elseif($_POST['category'] === 'other'){ echo 'その他';}
        ?>
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
      <!-- <a href="item_input.php?action=rewrite">&laquo;&nbsp;修正</a> -->
      <input type="submit" name="back" class="btn" value="戻る">
      <input  type="submit" name="btn_submit" class="btn btn-submit" value="登録">
      <input type="hidden" name="category" value="<?php echo h($_POST['category']); ?>">
      <input type="hidden" name="item_name" value="<?php echo h($_POST['item_name']); ?>">
      <input type="hidden" name="jan" value="<?php echo h($_POST['jan']); ?>">
      <input type="hidden" name="standard" value="<?php echo h($_POST['standard']); ?>">
      <input type="hidden" name="number_contained" value="<?php echo h($_POST['number_contained']); ?>">
      <input type="hidden" name="regular_price" value="<?php echo h($_POST['regular_price']); ?>">
      <input type="hidden" name="expiration_date" value="<?php echo h($_POST['expiration_date']); ?>">
      <input type="hidden" name="size" value="<?php echo h($_POST['size']); ?>">
    </ul>

  </form>
</div>
<?php endif; ?>


<!-- 完了画面 -->
<?php if ($pageFlag === 2) : ?>
  <!-- <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?> -->

  <?php
  $sql = 'INSERT INTO Sales_result SET item_name=?,  )';

  // $item_name = $_POST['item_name'];

  ?>

  <p>商品登録が完了しました。</p>
  
  <a href="index.php">ホームに戻る</a>

  <!-- トークンの削除 -->
  <!-- <?php unset($_SESSION['csrfToken']); ?> -->

  <?php endif; ?>
<?php endif; ?>



<!-- 登録画面 -->
<?php if ($pageFlag === 0) : ?>

  <!-- エラーがあればエラーメッセージを表示 -->
  <?php if (!empty($_POST['btn_confirm']) && !empty($error)) :?>
    <ul>
      <?php foreach ($error as $value) :?>
      <li class="error"><?php echo $value ; ?></li>
      <?php endforeach ;?>
    </ul>
  <?php endif ;?>

<div>
  <form action="item_input.php" method="POST">
    <ul>
      <li class="item-li">
      <p>商品マスタ登録</p>
      </li>
      <li class="item-li">
        <label for="category">カテゴリ</label>
        <select name="category" id="category">
          <option value="">選択してください</option>
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
        <input type="text" name="item_name" id="item_name" value="<?php if(!empty($_POST['item_name']) ){ echo $_POST['item_name']; } ?>">
      </li>
      <li class="item-li">
        <label for="jan">JAN:</label>
        <input type="text" name="jan" id="jan" placeholder="4903148000000" value="<?php if(!empty($_POST['jan']) ){ echo $_POST['jan']; } ?>">
      </li>
      <li class="item-li">
        <label for="standard">規格:</label>
        <input type="text" name="standard" id="standard" placeholder="5gx50p" value="<?php if(!empty($_POST['standard']) ){ echo $_POST['standard']; } ?>">
      </li>
      <li class="item-li">
        <label for="number_contained">入数:</label>
        <input type="text" name="number_contained" id="number_contained" placeholder="20" value="<?php if(!empty($_POST['number_contained']) ){ echo $_POST['number_contained']; } ?>">
      </li>
      <li class="item-li">
        <label for="regular_price">定価:</label>
        <input type="text" name="regular_price" id="regular_price" placeholder="500" value="<?php if(!empty($_POST['regular_price']) ){ echo $_POST['regular_price']; } ?>">
      </li>
      <li class="item-li">
        <label for="expiration_date">賞味期限:</label>
        <input type="text" name="expiration_date" id="expiration_date" placeholder="300" value="<?php if(!empty($_POST['expiration_date']) ){ echo $_POST['expiration_date']; } ?>">
      </li>
      <li class="item-li">
        <label for="size">商品サイズ:</label>
        <input type="text" name="size" id="size" placeholder="190*280*30" value="<?php if(!empty($_POST['size']) ){ echo $_POST['size']; } ?>">
      </li>
    
      <input type="submit" name="btn_confirm" class="btn btn-submit" value="登録">
    </ul>
  </form>
</div>
<?php endif; ?>