<!DOCTYPE HTML>
<html lang="ja" dir="ltr">
<head>
  <!-- 文字コード指定 -->
  <meta charset="utf-8">

  <!-- ファビコン設定(軽音マーク) -->
  <link rel="SHORTCUT ICON" href="keion.ico">

  <!-- 表示領域等の設定,ピンチインアウト禁止 -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

  <!-- javascript読み込み -->
  <script type="text/javascript" src="funk.js"></script>

  <!-- CSS読み込み -->
  <link rel="stylesheet" href="check.css">

  <!-- tittle設定 -->
  <title>部員要項入力フォーム</title>

</head>

<!-- 本文 -->
<body>

  <h1 class="t1">登録情報確認</h1>

  <p class="com">
    <b>
      以下の情報で登録を行います．<br>
      よろしければ確定ボタンをクリックしてください．
    </b>
  </p>

  <form action="send.php" method="post">
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
            $name = $_POST['Last'] ." " .$_POST['First'];
            echo $name;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ふりがな</td>
          <td class="typ2">
            <?php
            $yomi = $_POST['Last_yomi'] ." " .$_POST['First_yomi'];
            echo $yomi;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学籍番号</td>
          <td class="typ2">
            <?php
            $num = $_POST['inputNum'];
            echo $num;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学部</td>
          <td class="typ2">
            <?php
            $faculty = $_POST['Faculty'];
            echo $faculty;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">学科</td>
          <td class="typ2">
            <?php
            $dep = $_POST['Dep'];
            echo $dep;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">TEL</td>
          <td class="typ2">
            <?php
            $tel = $_POST['Tel1'] ."-" .$_POST['Tel2'] ."-" .$_POST['Tel3'];
            //番号のどれか１つでもかけていたら表示しない
            if (!empty($_POST['Tel1']) && !empty($_POST['Tel2']) && !empty($_POST['Tel3'])) {
              echo $tel;
            }
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">現住所</td>
          <td class="typ2">
            <?php
            $loc = $_POST['Location1'] .$_POST['Location2'];
            echo $loc;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">誕生日</td>
          <td class="typ2">
            <?php
            $birth = $_POST['Month'] ."/" .$_POST['Day'];
            //月日のどちらかがかけていたら表示しない
            if (!empty($_POST['Month']) && !empty($_POST['Day'])) {
              echo $birth;
            }
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">パート</td>
          <td class="typ2">
            <?php
            if (isset($_POST['Part']) && is_array($_POST['Part'])) {
              $array = $_POST['Part'];
              array_push($array, $_POST['other_part']);
              $array = implode(",", $array);
              $part = rtrim($array,",");
              echo $part;
            }
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ライバル</td>
          <td class="typ2">
            <?php
            $rival = $_POST['Rival'];
            echo $rival;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">趣味</td>
          <td class="typ2">
            <?php
            $hobby = $_POST['Hobby'];
            echo $hobby;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">好きなタイプ</td>
          <td class="typ2">
            <?php
            $type = $_POST['Type'];
            echo $type;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">好きなアーティスト</td>
          <td class="typ2">
            <?php
            $artist = $_POST['Artist'];
            echo $artist;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">見た目</td>
          <td class="typ2">
            <?php
            $appearance = $_POST['Appearance'];
            echo $appearance;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">今年の目標</td>
          <td class="typ2">
            <?php
            $gorl = $_POST['Gorl'];
            echo $gorl;
            ?>
          </td>
        </tr>

        <tr>
          <td class="typ1">ひとこと</td>
          <td class="typ2">
            <?php
            $comment = $_POST['Comment'];
            echo $comment;
            ?>
          </td>
        </tr>

      </table>
    </div>

    <p>&nbsp;</p>

    <div class="cen">
      <!-- hiddenでフォームをsend.phpへ受け渡し -->
      <input type="hidden" name="name1" value="<?php echo $_POST['Last']; ?>">
      <input type="hidden" name="name2" value="<?php echo $_POST['First']; ?>">
      <input type="hidden" name="yomi1" value="<?php echo $_POST['Last_yomi']; ?>">
      <input type="hidden" name="yomi2" value="<?php echo $_POST['First_yomi']; ?>">
      <input type="hidden" name="num" value="<?php echo $_POST['inputNum']; ?>">
      <input type="hidden" name="faculty" value="<?php echo $_POST['Faculty']; ?>">
      <input type="hidden" name="dep" value="<?php echo $_POST['Dep']; ?>">
      <input type="hidden" name="tel1" value="<?php echo $_POST['Tel1']; ?>">
      <input type="hidden" name="tel2" value="<?php echo $_POST['Tel2']; ?>">
      <input type="hidden" name="tel3" value="<?php echo $_POST['Tel3']; ?>">
      <input type="hidden" name="loc1" value="<?php echo $_POST['Location1']; ?>">
      <input type="hidden" name="loc2" value="<?php echo $_POST['Location2']; ?>">
      <input type="hidden" name="month" value="<?php echo $_POST['Month']; ?>">
      <input type="hidden" name="day" value="<?php echo $_POST['Day']; ?>">
      <input type="hidden" name="part" value="<?php echo $_POST['Part']; ?>">
      <input type="hidden" name="other" value="<?php echo $_POST['other']; ?>">
      <input type="hidden" name="rival" value="<?php echo $rival; ?>">
      <input type="hidden" name="hobby" value="<?php echo $hobby; ?>">
      <input type="hidden" name="type" value="<?php echo $type; ?>">
      <input type="hidden" name="artist" value="<?php echo $artist; ?>">
      <input type="hidden" name="appearance" value="<?php echo $appearance; ?>">
      <input type="hidden" name="gorl" value="<?php echo $gorl; ?>">
      <input type="hidden" name="comment" value="<?php echo $comment; ?>">

      <!-- 確定or戻るボタン -->
      <button class="reset" type="button" onclick="history.back()">戻る</button>
      &nbsp;
      <input class="Confirm" text-align="center" type="submit" value="確定">
    </div>
  </form>
</body>
</html>
