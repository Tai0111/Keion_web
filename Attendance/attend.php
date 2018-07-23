<?php
session_cache_expire(0);
session_cache_limiter('private_no_expire');
session_start();
//----------未入力チェック----------//
if (!empty($_POST) && empty($_SESSION['input_data'])) {

  //学籍番号の入力チェック
  if (empty($_POST['attend_num'])) {
    $error_message['attend_num'] = '<font color="red">!!入力されていません!!<br /></font>';
  }else {
    $attend_num = $_POST['attend_num'];
  }

  //エラー内容チェック -- エラーがなければcheck.phpへリダイレクト
  if (empty($error_message)) {
    $_SESSION['input_data'] = $_POST;
  }
} elseif (!empty($_SESSION['input_data'])) {
  $_POST = $_SESSION['input_data'];
}
session_destroy();
?>

<!-- mysqlからデータを取得 -->
<?php
if (!empty($attend_num)) {
  $hostname = "mysql1.php.xdomain.ne.jp";    //ホスト名
  $userid = "kanikama09_tai";    //データベースユーザ名
  $passwd = "wisdom0111";    //接続パスワード
  $dbname = "kanikama09_memberlist";    //データベース名
  $con=mysqli_connect($hostname,$userid,$passwd);    //db接続に必要な情報を変数に入れる
  if(!$con){
    $error_message['con'] = '<font color="red">!!データベースとの接続に失敗しました!!<br /></font>';
  }

  //データベース選択
  $db_selected = mysqli_select_db($con, $dbname);
  if (!$db_selected){
    $error_message['db_selected'] = '<font color="red">!!データベースに指定のテーブルが見つかりませんでした!!<br /></font>';
  }

  //mysqlの文字コード設定
  mysqli_set_charset($con, 'utf8');

  // SELECT文を変数に格納
  $sql = "SELECT * FROM member WHERE num = '$attend_num' ";
  if (!$sql){
    $error_message['sql'] = '<font color="red">!!データの取得に失敗しました!!<br /></font>';
  }

  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $con->query($sql);

  $num_rows = mysqli_num_rows($stmt);
  if ($num_rows == 0) {
    $error_message['num_rows'] = '<font color="red">!!学籍番号が登録されていません!!<br /></font>';
  }

  // foreach文で配列の中身を一行ずつ出力
  foreach ($stmt as $row) {

    //データベースのフィールドを変数に格納
    $sei = $row['sei'];
    $mei = $row['mei'];
    $name = $sei . " " . $mei;
    $sei_yomi = $row['sei_yomi'];
    $mei_yomi = $row['mei_yomi'];
    $yomi = $sei_yomi . " " . $mei_yomi;
    $num = $row['num'];
    $faculty = $row['faculty'];
    $dep = $row['dep'];
    $tel = $row['tel'];
    $loc = $row['loc'];
    $birth = $row['birth'];
    $part = $row['part'];
    $rival = $row['rival'];
    $hobby = $row['hobby'];
    $type = $row['type'];
    $artist = $row['artist'];
    $appearance = $row['appearance'];
    $gorl = $row['gorl'];
    $comment = $row['comment'];
  }
  $time = date('Y-m-d H:i:s'); //現在時刻
}
?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
<head>
  <!-- 文字コード指定 -->
  <meta charset="UTF-8">
  <!-- 表示領域等の設定,ピンチインアウト禁止 -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <!-- ファビコン設定(軽音マーク) -->
  <link rel="SHORTCUT ICON" href="keion.ico">
  <!-- CSS読み込み -->
  <!-- ※デフォルトのスタイル（style.css） -->
  <link rel="stylesheet" href="attend.css">

  <!-- javascript読み込み -->
  <script type="text/javascript" src="funk.js"></script>

  <title>出欠管理ページ</title>
</head>
<body>
  <!-- ページ上部　-->
  <div class="top">
    <h1 class="pc">軽音楽部 打上げ出欠確認フォーム</h1>
    <h1 class="mobile">軽音楽部 <br> 打上げ出欠確認フォーム</h1>
    <div class="coution">
      <p class="box">
        Chromeは正常に動作します<br>
        Safari,Firefoxは一部挙動がおかしいかもです...<br>
        IE,Edgeは確認取れていません(><)
      </p>
    </div>
  </div>

  <form class="attend" action="" method="post" autocomplete="off">
    <h2>学籍番号を入力してください</h2>
    <div class="errer">
      <?php
      if( isset($error_message['attend_num']) ){
        echo $error_message['attend_num'];
      }
      ?>
    </div>
    <input type="text" size="20" name="attend_num"  placeholder="学籍番号">
    <br>
    <div class="cp_ipradio">
      <input type="radio" name="attngance"　value="1" id="a_rb1" />
      <label for="a_rb1">出席</label>
      <input type="radio" name="attngance"　value="0" id="a_rb2" />
      <label for="a_rb2">欠席</label>
    </div>
    <div class="btn"> <button type="submit" class="cp_btn">送信</button> </div>
  </form>

</body>
</html>
