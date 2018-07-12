<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE HTML>
<html lang="ja" dir="ltr">
<head>

  <!-- 文字コード指定-->
  <meta charset="utf-8">

  <!-- 表示領域等の設定,ピンチインアウト禁止 -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

  <!-- ファビコンの設定 -->
  <link rel="SHORTCUT ICON" href="keion.ico">

  <!-- CSS読み込み -->
  <link href="send.css" rel="stylesheet" type="text/css">

  <!-- javascript読み込み -->
  <script type="text/javascript" src="funk.js"></script>

  <!-- tittle設定  -->
  <title>部員要項入力フォーム</title>

</head>
<body>

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

  <div class="php">
    <?php

    //************************
    //mysqlデータベースに追加
    //************************
    $hostname = "mysql1.php.xdomain.ne.jp";    //ホスト名
    $userid = "kanikama09_tai";    //データベースユーザ名
    $passwd = "wisdom0111";    //接続パスワード
    $dbname = "kanikama09_memberlist";    //データベース名
    $con=mysqli_connect($hostname,$userid,$passwd);    //db接続に必要な情報を変数に入れる
    if(!$con){
      echo "接続失敗<br />";
      exit;
    }

    //データベース選択
    $db_selected = mysqli_select_db($con, $dbname);
    if (!$db_selected){
      echo "db選択失敗<br />";
      exit;
    }

    //mysqlの文字コード設定
    mysqli_set_charset($con, 'utf8');

    //フォームを変数に格納
    $sei = $_POST['name1'];
    $mei = $_POST['name2'];
    $sei_yomi = $_POST['yomi1'];
    $mei_yomi = $_POST['yomi2'];
    $num = $_POST['num'];
    $faculty = $_POST['faculty'];
    $dep = $_POST['dep'];
    $tel = $_POST['tel1'] ."-" .$_POST['tel2'] ."-" .$_POST['tel3'];
    $loc = $_POST['loc1'] .$_POST['loc2'];
    $birth = $_POST['month'] ."/" .$_POST['day'];
    $part = $_POST['part'];
    $rival = $_POST['rival'];
    $hobby = $_POST['hobby'];
    $type = $_POST['type'];
    $artist = $_POST['artist'];
    $appearance = $_POST['appearance'];
    $gorl = $_POST['gorl'];
    $comment = $_POST['comment'];
    $time = date('Y-m-d H:i:s'); //現在時刻

    //学籍番号から入学年を取得
    $admission = "20" . substr($num, 1, 2);
    if (substr($num, 0, 1) == 'M') {
      $admission -= 4;
    }

    //重複チェック
    $count = "SELECT * FROM member WHERE num = '$num' ";
    $rs = mysqli_query($con, $count);
    $rows = mysqli_num_rows($rs);

    //rows=0なら重複なし
    if($rows == 0){
      //実行するクエリを変数に入れる
      $sql = 'INSERT INTO member (
        admission,
        sei,
        mei,
        sei_yomi,
        mei_yomi,
        num,
        faculty,
        dep,
        tel,
        loc,
        birth,
        part,
        rival,
        hobby,
        type,
        artist,
        appearance,
        gorl,
        comment,
        uploaded
      ) VALUES (
        "'.$admission.'",
        "'.$sei.'",
        "'.$mei.'",
        "'.$sei_yomi.'",
        "'.$mei_yomi.'",
        "'.$num.'",
        "'.$faculty.'",
        "'.$dep.'",
        "'.$tel.'",
        "'.$loc.'",
        "'.$birth.'",
        "'.$part.'",
        "'.$rival.'",
        "'.$hobby.'",
        "'.$type.'",
        "'.$artist.'",
        "'.$appearance.'",
        "'.$gorl.'",
        "'.$comment.'",
        "'.$time.'"
      )';
      if (!$sql) {
        echo ('データ登録失敗<br />');
        exit;
      }

      //クエリを実行して、フォームから入力されたデータをデータベースに挿入
      $result_reg = mysqli_query($con, $sql);
      if(!$result_reg){
        echo ('SQL失敗<br />');
        exit;
      }

      //データベース接続を切断
      mysqli_close($con);
      echo '<br />';
      echo '<FONT COLOR="rgb(233, 249, 53)", SIZE="22px"> 登録完了! </FONT>';

    }else{
      //重複があった場合更新するか確認
      echo '<script type="text/javascript">MoveCheck()</script>';

      //更新する場合以下を続行

      // UPDATE文を変数に格納
      $sql = "UPDATE member SET
      admission = '" . $admission . "' ,
      sei = '" . $sei . "' ,
      mei = '" . $mei . "' ,
      sei_yomi = '" . $sei_yomi . "' ,
      mei_yomi = '" . $mei_yomi . "' ,
      faculty = '" . $faculty . "' ,
      dep = '" . $dep . "' ,
      tel = '" . $tel . "' ,
      loc = '" . $loc . "' ,
      birth = '" . $birth . "' ,
      part = '" . $part . "' ,
      rival = '" . $rival . "' ,
      hobby = '" . $hobby . "' ,
      type = '" . $type . "' ,
      artist = '" . $artist . "' ,
      appearance = '" . $appearance . "' ,
      gorl = '" . $gorl . "' ,
      comment = '" . $comment . "' ,
      uploaded = '" . $time . "'
      WHERE num = '" . $num . "'";

      //クエリの実行
      $res = mysqli_query($con, $sql);
      if (!$res) {
        echo 'UPDATEクエリが失敗しました。';
      }

      //データベース接続を切断
      mysqli_close($con);
      echo '<br />';
      echo '<FONT COLOR="rgb(233, 249, 53)", SIZE="22px"> 更新完了! </FONT>';
    }
    ?>
  </div>

  <p>5秒後にホーム画面へ戻ります</p>

  <script type="text/javascript">
  <!--
  setTimeout("jumpPage()",5*1000)
  //-->
</script>
</body>
</html>
