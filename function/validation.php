<?php

function validatation($data) {

  $error = [];

  // 商品登録
  if(isset($_POST['category']) == 'select') {
    $error[] = 'カテゴリを選択してください。';
  }


  // ユーザー登録
  if (empty($data['your_name']) || 20 < mb_strlen($data['your_name'])) {
    $error[] = '「氏名」は20文字以内で入力してください。';
  }

  // メールアドレスかどうかの判定
  if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = '「メールアドレス」は正しい形式で入力してください。';
  }

  // URLが空でなければ正しいかどうかの判定
  if (!empty($data['url'])) {
    if (!filter_var($data['url'], FILTER_VALIDATE_URL)) {
      $error[] = '「ホームページ」は正しい形式で入力してください。';
    }
  }

  // emptyだと0でも通ってしまう
  if (!isset($data['gender'])) {
    $error[] = '「性別」は必ず入力してください。';
  }

  if (empty($data['age']) || 6 < $data['age']) {
    $error[] = '「年齢」は必ず入力してください。';
  }

  if (empty($data['contact']) || 200 < mb_strlen($data['contact'])) {
    $error[] = '「お問い合わせ」は200文字以内で入力してください。';
  }

  if ($data['caution'] !== '1') {
    $error[] = '「注意事項」をご確認ください。';
  }

  return $error;
}