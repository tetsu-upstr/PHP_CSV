<?php
require 'connect.php';

/* HTML特殊文字をエスケープする関数 */
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// パラメータを正しい構造で受け取った時のみ実行
if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {

    try {

        /* ファイルアップロードエラーチェック */
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                // エラー無し
                break;
            case UPLOAD_ERR_NO_FILE:
                // ファイル未選択
                throw new RuntimeException('File is not selected');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                // 許可サイズを超過
                throw new RuntimeException('File is too large');
            default:
                throw new RuntimeException('Unknown error');
        }

        $tmp_name = $_FILES['upfile']['tmp_name'];
        $detect_order = 'ASCII,JIS,UTF-8,CP51932,SJIS-win';
        // setlocale(LC_ALL, 'ja_JP.UTF-8');

        /* 文字コードを変換してファイルを置換 */
        $buffer = file_get_contents($tmp_name);
        if (!$encoding = mb_detect_encoding($buffer, $detect_order, true)) {
            // 文字コードの自動判定に失敗
            unset($buffer);
            throw new RuntimeException('Character set detection failed');
        }
        file_put_contents($tmp_name, mb_convert_encoding($buffer, 'UTF-8', $encoding));
        unset($buffer);

        $stmt = $pdo->prepare('INSERT INTO sales_result(item_name, jan, month, amount, unit_price, store) VALUES (?, ?, ?, ?, ?, ?)');

        /* トランザクション処理 */
        $pdo->beginTransaction();
        try {
            $fp = fopen($tmp_name, 'r');
            while ($row = fgetcsv($fp)) {
                if ($row === array(NULL)) {
                    continue;
                }
                if (count($row) !== 6) {
                    // カラム数が異なる無効なフォーマット
                    throw new RuntimeException('Invalid column detected');
                }
                $executed = $stmt->execute($row);
            }
            if (!feof($fp)) {
                // ファイルポインタが終端に達していなければエラー
                throw new RuntimeException('CSV parsing error');
            }
            fclose($fp);
						$pdo->commit();
						
        } catch (Exception $e) {
            fclose($fp);
            $pdo->rollBack();
            throw $e;
        }

        /* 結果メッセージをセット */
        if (isset($executed)) {
            // 1回以上実行された
            $msg = array('green', 'Import successful');
        } else {
            // 1回も実行されなかった
            $msg = array('black', 'There were nothing to import');
        }

    } catch (Exception $e) {

        /* エラーメッセージをセット */
        $msg = array('red', $e->getMessage());

    }

}

// XHTMLとしてブラウザに認識させる
// (IE8以下はサポート対象外)
header('Content-Type: application/xhtml+xml; charset=utf-8');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CSV to MySQL importation test</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	<!-- CSS -->
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header>
  <p><i class="fas fa-tachometer-alt"></i><a href="index.php"> Sales dashboard</a> </p>
</header>

	<?php if (isset($msg)): ?>
		<fieldset>
			<legend>Result</legend>
			<span style="color:<?=h($msg[0])?>;"><?=h($msg[1])?></span>
		</fieldset>
	<?php endif; ?>
		<form enctype="multipart/form-data" method="POST" action="">
			<fieldset>
				<legend>Select File</legend>
				CSV形式のみ対応: <input type="file" name="upfile" /><br />
				<input type="submit" value="アップロード" />
			</fieldset>
		</form>
</body>
</html>