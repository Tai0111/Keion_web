<?php
session_start();
session_cache_expire(0);
session_cache_limiter('private_no_expire');
//----------未入力チェック----------//
if (!empty($_POST) && empty($_SESSION['input_data'])) {

  //名前チェック
  if (empty($_POST['Last']) || empty($_POST['First'])) {
    $error_message['last_name'] = '<font color="red">*名前を入力して下さい<br /></font>';
  }

  //ふりがなチェック
  if (empty($_POST['First_yomi']) || empty($_POST['Last_yomi'])) {
    $error_message['first_name'] = '<font color="red">*ふりがなを入力して下さい<br /></font>';
  }

  //学籍番号チェック
  if (empty($_POST['inputNum'])) {
    $error_message['num'] = '<font color="red">*学籍番号を入力して下さい<br /></font>';
  }

  //学部チェック
  if (empty($_POST['Faculty'])) {
    $error_message['fac'] = '<font color="red">*学部を入力して下さい<br /></font>';
  }

  //学科チェック
  if (empty($_POST['Dep'])) {
    $error_message['dep'] = '<font color="red">*学科を入力して下さい<br /></font>';
  }

  //エラー内容チェック -- エラーがなければcheck.phpへリダイレクト
  if (empty($error_message)) {
    $_SESSION['input_data'] = $_POST;
    header('HTTP/1.1 307 Temporary Redirect');  //locationにPOSTを持たせる
    header('Location: check.php');
    exit();
  }
} elseif (!empty($_SESSION['input_data'])) {
  $_POST = $_SESSION['input_data'];
}

session_destroy();

?>



<!DOCTYPE HTML>
<html lang="ja" dir="ltr">
<head>

  <!-- 文字コード指定 -->
  <meta charset="UTF-8">

  <!-- 表示領域等の設定,ピンチインアウト禁止 -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

  <!-- ファビコン設定(軽音マーク) -->
  <link rel="SHORTCUT ICON" href="keion.ico">

  <!-- CSS読み込み -->
  <!-- ※デフォルトのスタイル（style.css） -->
  <link rel="stylesheet" href="form.css">

  <!-- javascript読み込み -->
  <script type="text/javascript" src="funk.js"></script>

  <!-- タイトル設定 -->
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


  <div class="main">

    <p class="errer">
      <b>以下の項目を入力してください</b>(*は必須) <br>
      <!-- 以下のphpは未入力箇所があった場合に起動 -->
      <?php
      if( isset($error_message['last_name']) ){
        echo $error_message['last_name'];
      }
      if( isset($error_message['first_name']) ){
        echo $error_message['first_name'];
      }
      if( isset($error_message['num']) ){
        echo $error_message['num'];
      }
      if( isset($error_message['fac']) ){
        echo $error_message['fac'];
      }
      if( isset($error_message['dep']) ){
        echo $error_message['dep'];
      }
      ?>
    </p>

    <!-- 情報入力開始 -->
    <form name="Info" action="" method="post" autocomplete="off">

      <table>


        <!-- 名前フォーム -->
        <tr>
          <th class="item"> 名前(*) : </th>
          <th class="cont">
            <!-- < ?= は < ?php echo ~ の略 -->
            <input class="fname" type="text" size="10" name="Last" value="<?= $_POST['Last'] ?>" placeholder="軽音"> &nbsp;
            <input class="fname" type="text" size="10" name="First" value="<?= $_POST['First'] ?>" placeholder="太郎">
          </th>
        </tr>

        <!-- ふりがなフォーム -->
        <tr>
          <th class="item"> ふりがな(*) : </th>
          <th class="cont">
            <input class="fname" type="text" size="10" name="Last_yomi" value="<?= $_POST['Last_yomi'] ?>" placeholder="けいおん"> &nbsp;
            <input class="fname" type="text" size="10" name="First_yomi" value="<?= $_POST['First_yomi'] ?>" placeholder="たろう">
          </th>
        </tr>

        <!-- 学籍番号フォーム -->
        <tr>
          <th class="item"> 学籍番号(*) : </th>
          <th class="cont">
            <input class="fnum" type="text" size="20" name="inputNum" value="<?= $_POST['inputNum'] ?>" placeholder="半角で入力してください" onInput="checkForm(this)">
          </th>
        </tr>

        <!-- 学部フォーム -->
        <tr>
          <th class="item"> 学部(*) : </th>
          <th class="cont">
            <select name="Faculty" onChange="select_dip()">
              <option value="">--</option>
              <?php ( $_POST["Faculty"] == "地域学部" ) ? $val1 = "selected" : $val1 = "" ; ?>
              <option value="地域学部" <?= $val1?> >地域学部</option>
              <?php ( $_POST["Faculty"] == "工学部" ) ? $val1 = "selected" : $val1 = "" ; ?>
              <option value="工学部" <?= $val1?> >工学部</option>
              <?php ( $_POST["Faculty"] == "農学部" ) ? $val1 = "selected" : $val1 = "" ; ?>
              <option value="農学部" <?= $val1?> >農学部</option>
              <?php ( $_POST["Faculty"] == "医学部" ) ? $val1 = "selected" : $val1 = "" ; ?>
              <option value="医学部" <?= $val1?> >医学部</option>
              <?php ( $_POST["Faculty"] == "持続性社会創生科学研究科" ) ? $val1 = "selected" : $val1 = "" ; ?>
              <option value="持続性社会創生科学研究科" <?= $val1?> >持続性社会創生科学研究科</option>
            </select>
          </th>
        </tr>

        <!-- 学科フォーム -->
        <tr>
          <th class="item"> 学科(*) : </th>
          <th class="cont">
            <select name="Dep">
              <option value="">--</option>
              <?php ( $_POST["Dep"] == "地域創造コース" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="地域創造コース" <?= $val2?>>地域創造コース</option>
              <?php ( $_POST["Dep"] == "人間形成コース" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="人間形成コース" <?= $val2?>>人間形成コース</option>
              <?php ( $_POST["Dep"] == "国際地域文化コース" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="国際地域文化コース" <?= $val2?>>国際地域文化コース</option>

              <?php ( $_POST["Dep"] == "機械物理系学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="機械物理系学科" <?= $val2?>>機械物理系学科</option>
              <?php ( $_POST["Dep"] == "電気情報系学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="電気情報系学科" <?= $val2?>>電気情報系学科</option>
              <?php ( $_POST["Dep"] == "化学バイオ系学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="化学バイオ系学科" <?= $val2?>>化学バイオ系学科</option>
              <?php ( $_POST["Dep"] == "社会システム土木系学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="社会システム土木系学科" <?= $val2?>>社会システム土木系学科</option>

              <?php ( $_POST["Dep"] == "生命環境農学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="生命環境農学科" <?= $val2?>>生命環境農学科</option>
              <?php ( $_POST["Dep"] == "共同獣医学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="共同獣医学科" <?= $val2?>>共同獣医学科</option>

              <?php ( $_POST["Dep"] == "生命科学科" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="生命科学科" <?= $val2?>>生命科学科</option>
              <?php ( $_POST["Dep"] == "保険学科(看護学専攻)" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="保険学科(看護学専攻)" <?= $val2?>>保険学科(看護)</option>
              <?php ( $_POST["Dep"] == "保険学科(検査技術科学専攻)" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="保険学科(検査技術科学専攻)" <?= $val2?>>保険学科(検査)</option>

              <?php ( $_POST["Dep"] == "地域学専攻" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="地域学専攻" <?= $val2?>>地域学専攻</option>
              <?php ( $_POST["Dep"] == "工学専攻" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="工学専攻" <?= $val2?>>工学専攻</option>
              <?php ( $_POST["Dep"] == "農学専攻" ) ? $val2 = "selected" : $val2 = "" ; ?>
              <option value="農学専攻" <?= $val2?>>農学専攻</option>
            </select>
          </th>
        </tr>

        <!-- 電話番号フォーム -->
        <tr>
          <th class="item"> TEL : </th>
          <th class="cont">
            <input class="ftel" type="tel" size="3" maxlength="3" name="Tel1" value="<?= $_POST['Tel1'] ?>" placeholder="090" onkeyup="nextfeild(this)">
            -
            <input class="ftel" type="tel" size="4" maxlength="4" name="Tel2" value="<?= $_POST['Tel2'] ?>" placeholder="××××" onkeyup="nextfeild(this)">
            -
            <input class="ftel" type="tel" size="4" maxlength="4" name="Tel3" value="<?= $_POST['Tel3'] ?>" placeholder="××××" onkeyup="nextfeild(this)">
          </th>
        </tr>

        <!-- 住所フォーム -->
        <tr>
          <th class="item" rowSpan=2> 現住所 : </th>
          <th class="cont">
            <input class="flocational" type="text" size="40" name="Location1" value="<?= $_POST['Location1'] ?>" placeholder="市区町村">
          </th>
        </tr>
        <tr>
          <th class="cont">
            <input class="flocational" type="text" size="40" name="Location2" value="<?= $_POST['Location2'] ?>" placeholder="アパート名">
          </th>
        </tr>

        <!-- 誕生日フォーム -->
        <tr>
          <th class="item"> 誕生日 : </th>
          <th class="cont">
            <select name="Month">
              <option value="">--</option>
              <?php ( $_POST["Month"] == "01" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="01" <?= $val_mon?>>01</option>
              <?php ( $_POST["Month"] == "02" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="02" <?= $val_mon?>>02</option>
              <?php ( $_POST["Month"] == "03" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="03" <?= $val_mon?>>03</option>
              <?php ( $_POST["Month"] == "04" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="04" <?= $val_mon?>>04</option>
              <?php ( $_POST["Month"] == "05" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="05" <?= $val_mon?>>05</option>
              <?php ( $_POST["Month"] == "06" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="06" <?= $val_mon?>>06</option>
              <?php ( $_POST["Month"] == "07" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="07"<?= $val_mon?>>07</option>
              <?php ( $_POST["Month"] == "08" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="08" <?= $val_mon?>>08</option>
              <?php ( $_POST["Month"] == "09" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="09" <?= $val_mon?>>09</option>
              <?php ( $_POST["Month"] == "10" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="10" <?= $val_mon?>>10</option>
              <?php ( $_POST["Month"] == "11" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="11" <?= $val_mon?>>11</option>
              <?php ( $_POST["Month"] == "12" ) ? $val_mon = "selected" : $val_mon = "" ; ?>
              <option value="12" <?= $val_mon?>>12</option>
            </select>
            /
            <select name="Day">
              <option value="">--</option>
              <?php ( $_POST["Day"] == "01" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="01" <?= $val_day?>>01</option>
              <?php ( $_POST["Day"] == "02" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="02" <?= $val_day?>>02</option>
              <?php ( $_POST["Day"] == "03" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="03" <?= $val_day?>>03</option>
              <?php ( $_POST["Day"] == "04" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="04" <?= $val_day?>>04</option>
              <?php ( $_POST["Day"] == "05" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="05" <?= $val_day?>>05</option>
              <?php ( $_POST["Day"] == "06" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="06" <?= $val_day?>>06</option>
              <?php ( $_POST["Day"] == "07" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="07" <?= $val_day?>>07</option>
              <?php ( $_POST["Day"] == "08" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="08" <?= $val_day?>>08</option>
              <?php ( $_POST["Day"] == "09" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="09" <?= $val_day?>>09</option>
              <?php ( $_POST["Day"] == "10" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="10" <?= $val_day?>>10</option>
              <?php ( $_POST["Day"] == "11" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="11" <?= $val_day?>>11</option>
              <?php ( $_POST["Day"] == "12" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="12" <?= $val_day?>>12</option>
              <?php ( $_POST["Day"] == "13" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="13" <?= $val_day?>>13</option>
              <?php ( $_POST["Day"] == "14" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="14" <?= $val_day?>>14</option>
              <?php ( $_POST["Day"] == "15" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="15" <?= $val_day?>>15</option>
              <?php ( $_POST["Day"] == "16" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="16" <?= $val_day?>>16</option>
              <?php ( $_POST["Day"] == "17" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="17" <?= $val_day?>>17</option>
              <?php ( $_POST["Day"] == "18" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="18" <?= $val_day?>>18</option>
              <?php ( $_POST["Day"] == "19" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="19" <?= $val_day?>>19</option>
              <?php ( $_POST["Day"] == "20" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="20" <?= $val_day?>>20</option>
              <?php ( $_POST["Day"] == "21" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="21" <?= $val_day?>>21</option>
              <?php ( $_POST["Day"] == "22" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="22" <?= $val_day?>>22</option>
              <?php ( $_POST["Day"] == "23" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="23" <?= $val_day?>>23</option>
              <?php ( $_POST["Day"] == "24" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="24" <?= $val_day?>>24</option>
              <?php ( $_POST["Day"] == "25" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="25" <?= $val_day?>>25</option>
              <?php ( $_POST["Day"] == "26" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="26" <?= $val_day?>>26</option>
              <?php ( $_POST["Day"] == "27" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="27" <?= $val_day?>>27</option>
              <?php ( $_POST["Day"] == "28" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="28" <?= $val_day?>>28</option>
              <?php ( $_POST["Day"] == "29" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="29" <?= $val_day?>>29</option>
              <?php ( $_POST["Day"] == "30" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="30" <?= $val_day?>>30</option>
              <?php ( $_POST["Day"] == "31" ) ? $val_day = "selected" : $val_day = "" ; ?>
              <option value="31" <?= $val_day?>>31</option>
            </select>

          </th>
        </tr>

        <!-- pc用  -->
        <tr class="pc">
          <th class="item_part"> パート : </th>
          <th class="cont">
            <div id="par">
              <?php ( $_POST["Part"][0] == "ボーカル" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="vo" type="checkbox" name="Part[]" value="ボーカル" <?= $val_part?>><label for="vo">ボーカル</label>

              <?php ( $_POST["Part"][1] == "ギター" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="gt" type="checkbox" name="Part[]" value="ギター" <?= $val_part?>><label for="gt">ギター</label>

              <?php ( $_POST["Part"][2] == "ベース" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="ba" type="checkbox" name="Part[]" value="ベース" <?= $val_part?>><label for="ba">ベース</label>

              <br>

              <?php ( $_POST["Part"][3] == "ドラム" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="drm" type="checkbox" name="Part[]" value="ドラム" <?= $val_part?>><label for="drm">ドラム</label>

              <?php ( $_POST["Part"][4] == "キーボード" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="key" type="checkbox" name="Part[]" value="キーボード" <?= $val_part?>><label for="key">キーボード</label>

              <?php ( $_POST["Part"][5] == "シンセサイザー" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="synth" type="checkbox" name="Part[]" value="シンセサイザー" <?= $val_part?>><label for="synth">シンセサイザー</label>
              <br>
              ( その他 : <input class="fother" type="text" size="35" name="Part[]" value="<?= $_POST['Part'][6] ?>" placeholder="なんか書いとけ"> )
            </div>
          </th>
        </tr>

        <!-- スマホ用 -->
        <tr class="mobile">
          <th class="item_part"> パート : </th>
          <th class="cont">
            <div id="par">
              <?php ( $_POST["Part"][0] == "ボーカル" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="vo" type="checkbox" name="Part[]" value="ボーカル" <?= $val_part?>><label for="vo">ボーカル</label>

              <?php ( $_POST["Part"][1] == "ギター" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="gt" type="checkbox" name="Part[]" value="ギター" <?= $val_part?>><label for="gt">ギター</label>

              <?php ( $_POST["Part"][2] == "ベース" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="ba" type="checkbox" name="Part[]" value="ベース" <?= $val_part?>><label for="ba">ベース</label>

              <?php ( $_POST["Part"][3] == "ドラム" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="drm" type="checkbox" name="Part[]" value="ドラム" <?= $val_part?>><label for="drm">ドラム</label>

              <?php ( $_POST["Part"][4] == "キーボード" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="key" type="checkbox" name="Part[]" value="キーボード" <?= $val_part?>><label for="key">キーボード</label>

              <?php ( $_POST["Part"][5] == "シンセサイザー" ) ? $val_part = "checked" : $val_part = "" ; ?>
              <input id="synth" type="checkbox" name="Part[]" value="シンセサイザー" <?= $val_part?>><label for="synth">シンセサイザー</label>
              <br>
              ( その他 : <input class="fother" type="text" size="35" name="Part[]" value="<?= $_POST['Part'] ?>" placeholder="なんか書いとけ"> )
            </div>
          </th>
        </tr>

        <tr>
          <th class="item"> ライバル : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Rival"><?= $_POST['Rival'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> 趣味 : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Hobby"><?= $_POST['Hobby'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> 好きなタイプ : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Type"><?= $_POST['Type'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> 好きなアーティスト : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Artist"><?= $_POST['Artist'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> 見た目 : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Appearance"><?= $_POST['Appearance'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> 今年の目標 : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Gorl"><?= $_POST['Gorl'] ?></textarea>
          </th>
        </tr>

        <tr>
          <th class="item"> ひとこと : </th>
          <th class="cont">
            <textarea rows="3" cols="40" name="Comment"><?= $_POST['Comment'] ?></textarea>
          </th>
        </tr>

      </table>
      <br>
      <input class="square_btn" type="submit" value="確認">

    </form>
  </div>

</body>
</html>
