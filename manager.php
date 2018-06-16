<?php

  $hostname = "mysql1.php.xdomain.ne.jp";    //ホスト名
  $userid = "kanikama09_tai";    //データベースユーザ名
  $passwd = "wisdom0111";    //接続パスワード
  $dbname = "kanikama09_memberlist";    //データベース名
  $con=mysqli_connect($hostname,$userid,$passwd);    //db接続に必要な情報を変数に入れる
  if(!$con){
    echo "接続失敗<br />";
    exit;
  }
  //文字コード指定
  mysqli_set_charset($con, "utf8");

  //データベース選択
  $db_selected = mysqli_select_db($con, $dbname);
  if (!$db_selected){
    echo "db選択失敗<br />";
    exit;
  }

//全データダウンロードの場合の設定
if(isset($_POST['txt01'])){
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=member.txt");
  //入学年，名前を昇順にソートし取得
  $sql = "SELECT * FROM member ORDER BY admission ASC, yomi ASC";
}

//学年別
if(isset($_POST['txt02'])){
  header("Content-Type: application/octet-stream");
  $year = $_POST['year'];
  header("Content-Disposition: attachment; filename=member_of_$year.txt");
  //名前を昇順にソートし取得
  $sql = "SELECT * FROM member WHERE admission = '$year' ORDER BY yomi ASC";
}

  //クエリ
  $rs = mysqli_query($con, $sql);

  //値を取得
  while($row = mysqli_fetch_assoc($rs)){

    //本文出力
    print('名前 : ' . $row['sei'] . " " . $row['mei'] . "\n");
    print('ふりがな : ' . $row['sei_yomi'] . " " . $row['mei_yomi'] . "\n");
    print('学籍番号 : ' . $row['num'] . "\n");
    print('学部 : ' . $row['faculty'] . "\n");
    print('学科 : ' . $row['dep'] . "\n");
    print('TEL : ' . $row['tel'] . "\n");
    print('現住所 : ' . $row['loc'] . "\n");
    print('誕生日 : ' . $row['birth'] . "\n");
    print('パート : ' . $row['part'] . "\n");
    print('ライバル : ' . $row['rival'] . "\n");
    print('趣味 : ' . $row['hobby'] . "\n");
    print('好きなタイプ : ' . $row['type'] . "\n");
    print('好きなアーティスト : ' . $row['artist'] . "\n");
    print('見た目 : ' . $row['appearance'] . "\n");
    print('今年の目標 : ' . $row['gorl'] . "\n");
    print('ひとこと : ' . $row['comment'] . "\n");
    print("\n");
  }

//接続終了
mysqli_close($con);
?>
