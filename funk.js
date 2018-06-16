var perNum, perFac, perDep, perFirst, perLast;
//var perPart;
//現在日時の表示
function Time(){
  //Tbl = new Array("日","月","火","水","木","金","土");
  timeD = new Date();

  Year = timeD.getFullYear();
  Month = timeD.getMonth() + 1;
  Day = timeD.getDate();
  //Points = timeD.getDay();
  Hours = ( '00' + timeD.getHours() ).slice(-2);
  Minutes = ( '00' + timeD.getMinutes()).slice(-2);

  Mess1 = Year + "/" + Month + "/" + Day;
  //Mess2 = "(" + Tbl[Points] + ")";
  Mess3 = Hours + ":" + Minutes;
  Mess = Mess1 + " " + Mess3;
  //document.write( Mess );
  document.getElementById("DayDate").innerHTML = Mess;
}

//Home画面用背景フェード
myColor = new Array(
  "000000","101010","202020","303030",
  "404040","505050","606060","707070",
  "808080","909090","A0A0A0","B0B0B0",
  "C0C0C0","D0D0D0","E0E0E0","FFFFFF"
);

myCnt = 0;
function myFade(){
  if (myCnt != 16){
    document.bgColor = "#" + myColor[myCnt];
    myTime = ( myCnt==0 || myCnt==15 ) ? 1000 : 50;
    myCnt++;
    setTimeout( "myFade()", myTime );
  }else{
    location.href = "home.html";
  }
}

//学部が選択された場合起動,学部ごとの学科を表示
function select_dip()
{
  var item1 = document.forms.Info.Faculty; //変数select1を宣言
  var item2 = document.forms.Info.Dep; //変数select2を宣言

  item2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要

  if (item1.options[item1.selectedIndex].value == "地域学部")
  {
    item2.options[0] = new Option("地域創造コース");
    item2.options[1] = new Option("人間形成コース");
    item2.options[2] = new Option("国際地域文化コース");
  }
  else if (item1.options[item1.selectedIndex].value == "工学部")
  {
    item2.options[0] = new Option("機械物理系学科");
    item2.options[1] = new Option("電気情報系学科");
    item2.options[2] = new Option("化学バイオ系学科");
    item2.options[3] = new Option("社会システム土木系学科");
  }
  else if (item1.options[item1.selectedIndex].value == "農学部")
  {
    item2.options[0] = new Option("生命環境農学科");
    item2.options[1] = new Option("共同獣医学科");
  }
  else if (item1.options[item1.selectedIndex].value == "医学部")
  {
    item2.options[0] = new Option("生命科学科");
    item2.options[1] = new Option("保険学科(看護学専攻)");
    item2.options[2] = new Option("保険学科(検査技術科学専攻)");
  }
  else if (item1.options[item1.selectedIndex].value == "持続性社会創生科学研究科")
  {
    item2.options[0] = new Option("地域学専攻");
    item2.options[1] = new Option("工学専攻");
    item2.options[2] = new Option("農学専攻");
  }else{
    item2.options[0] = new Option(" -- ");
  }
}

//全角入力防止関数
function checkForm($this)
{
    var str=$this.value;
    while(str.match(/[^A-Z^a-z\d\-]/))
    {
        str=str.replace(/[^A-Z^a-z\d\-]/,"");
    }
    $this.value=str;
}

//携帯の入力フォーム自動移動
function nextfeild(str) {
  if (str.value.length >= str.maxLength) {
    for (var i = 0, elm = str.form.elements; i < elm.length; i++) {
      if (elm[i] == str) {
        (elm[i + 1] || elm[0]).focus();
        break;
      }
    }
  }
  return (str);
}

//ページ自動遷移(send.php)
function jumpPage() {
  location.href = 'home.html';
}

//設定重複防止アラート(send.php)
function MoveCheck() {
  if(confirm("この学籍番号はすでに登録されています.\n登録情報を更新しますか?")){
    //更新する場合スルーする
  }else{
    //更新しない場合ホーム画面に移動
    setTimeout("jumpPage()",0*1000);
    alert("登録を中止しました．\nホーム画面に移動します．");
  }
}

//管理者ページアクセスパスワード
function Enter(){
     myPassWord=prompt("パスワードを入力してください","");
     if ( myPassWord == String.fromCharCode(107,101,105,111,110) ){
         location.href = String.fromCharCode(109,97,110,97,103,101,114)+".html";
     }else if (myPassWord == null) {

     }else{
         alert( "パスワードが違います!" );
     }
}
