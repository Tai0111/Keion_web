<?php
session_cache_expire(0);
session_cache_limiter('private_no_expire');
session_start();
//----------未入力チェック----------//
if (!empty($_POST) && empty($_SESSION['input_data'])) {

  //学籍番号の入力チェック
  if (empty($_POST['fix_num'])) {
    $error_message['fix_num'] = '<font color="red">!!入力されていません!!<br /></font>';
  }else {
    $fix_num = $_POST['fix_num'];
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

if (!empty($fix_num)) {

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
  $sql = "SELECT * FROM member WHERE num = '$fix_num' ";
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
  <meta charset="UTF-8">
  <!-- ファビコンの設定 -->
  <link rel="SHORTCUT ICON" href="keion.ico">

  <!-- 表示領域等の設定,ピンチインアウト禁止 -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

  <!-- ファビコン設定(軽音マーク) -->
  <link rel="SHORTCUT ICON" href="keion.ico">

  <!-- CSS読み込み -->
  <!-- ※デフォルトのスタイル（style.css） -->
  <link rel="stylesheet" href="change.css">
  <!-- ※スマートフォン用のスタイル（smart.css） -->
  <!--  <link rel="stylesheet" media="(max-width: 640px)" href="mobile.css"> -->

  <!-- javascript読み込み -->
  <script type="text/javascript" src="funk.js"></script>

  <!-- tittle設定 -->
  <title>部員要項入力フォーム</title>
</head>

<body>
  <!-- 本文 -->
  <div class="top">

    <h1 class="pc">H30 軽音楽部 部員要項入力フォーム</h1>
    <h1 class="mobile">H30 軽音楽部 <br> 部員要項入力フォーム</h1>

    <div class="coution">
      <p class="box">
        Chromeは正常に動作します<br>
        Safari,Firefoxは一部挙動がおかしいかもです...<br>
        IE,Edgeは確認取れていません(><)
      </p>
    </div>

  </div>

  <div class="errer">
    <!-- エラーメッセージの表示 -->
    <?php
    if( isset($error_message['con']) ){
      echo $error_message['con'];
    }
    if( isset($error_message['db_selected']) ){
      echo $error_message['db_selected'];
    }
    if( isset($error_message['spl']) ){
      echo $error_message['spl'];
    }
    if( isset($error_message['num_rows']) ){
      echo $error_message['num_rows'];
    }
    ?>
  </div>

  <!-- 指定した学籍番号の情報を表示 -->
  <form class="change_info" action="" method="post" autocomplete="off">
    <h2>学籍番号を入力してください</h2>
    <div class="errer">
      <?php
      if( isset($error_message['fix_num']) ){
        echo $error_message['fix_num'];
      }
      ?>
    </div>
    <input type="text" size="20" name="fix_num"  placeholder="学籍番号">
    &nbsp;
    <button type="submit" name="check">確認</button>
  </form>


  <!-- 以下登録情報の表示 -->

  <form action="form.php" method="post">
    <div class="tab">
      <table border="5">
        <tr>
          <th class="typ1">項目</th>
          <th class="typ2">登録情報</th>
        </tr>

        <tr>
          <td class="typ1">名前</td>
          <td class="typ2">
            <?php
            echo $name;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ふりがな</td>
          <td class="typ2">
            <?php
            echo $yomi;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学籍番号</td>
          <td class="typ2">
            <?php
            echo $num;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学部</td>
          <td class="typ2">
            <?php
            echo $faculty;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学科</td>
          <td class="typ2">
            <?php
            echo $dep;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">TEL</td>
          <td class="typ2">
            <?php
            echo $tel;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">現住所</td>
          <td class="typ2">
            <?php
            echo $loc;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">誕生日</td>
          <td class="typ2">
            <?php
            echo $birth;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">パート</td>
          <td class="typ2">
            <?php
            echo $part;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ライバル</td>
          <td class="typ2">
            <?php
            echo $rival;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">趣味</td>
          <td class="typ2">
            <?php
            echo $hobby;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">好きなタイプ</td>
          <td class="typ2">
            <?php
            echo $type;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">好きなアーティスト</td>
          <td class="typ2">
            <?php
            echo $artist;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">見た目</td>
          <td class="typ2">
            <?php
            echo $appearance;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">今年の目標</td>
          <td class="typ2">
            <?php
            echo $gorl;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ひとこと</td>
          <td class="typ2">
            <?php
            echo $comment;
            ?>
          </td>
        </tr>

      </table>
    </div>

    <p>&nbsp;</p>

    <div class="cen">
      <!-- hiddenでフォームをsend.phpへ受け渡し -->
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="yomi" value="<?php echo $yomi; ?>">
      <input type="hidden" name="num" value="<?php echo $num; ?>">
      <input type="hidden" name="faculty" value="<?php echo $faculty; ?>">
      <input type="hidden" name="dep" value="<?php echo $dep; ?>">
      <input type="hidden" name="tel" value="<?php echo $tel; ?>">
      <input type="hidden" name="loc" value="<?php echo $loc; ?>">
      <input type="hidden" name="part" value="<?php echo $part; ?>">
      <input type="hidden" name="rival" value="<?php echo $rival; ?>">
      <input type="hidden" name="hobby" value="<?php echo $hobby; ?>">
      <input type="hidden" name="type" value="<?php echo $type; ?>">
      <input type="hidden" name="artist" value="<?php echo $artist; ?>">
      <input type="hidden" name="appearance" value="<?php echo $appearance; ?>">
      <input type="hidden" name="gorl" value="<?php echo $gorl; ?>">
      <input type="hidden" name="comment" value="<?php echo $comment; ?>">

      <!-- 確定or戻るボタン -->
      <button class="reset" type="button" onClick="location.href='home.html'">戻る</button>
      &nbsp;
      <button class="Confirm" type="submit">更新</button>
    </div>
  </form>



</body>
</html>
