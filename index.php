<?php
require_once('core/config/index.php');

$Files = new Files();

// 投稿された場合の処理
if ($_POST['submit']) {
  $Files->write(h($_POST['post']));
  $Files->clear_tmp();
}

?>
<?php include('meta.php');?>

<script type="text/javascript">
$(function() {
  // textarea の値を書き込む
  read_tmp();
  // ログエリアの高さをウィンドウに合わせる
  fit_height();
  // ログファイルを取得する
  read_log();
  // 定期処理
  setInterval(function(){
		save_tmp();
	},3000); // 3秒毎
});

// ログエリアの高さをウィンドウに合わせる
function fit_height() {
  var window_h = $(window).height();
  var logarea_h = window_h - $('header').height() - $('#textarea').height() - $('footer').height();
  $('#logarea').height(logarea_h);
}
// ログファイルを取得する
function read_log() {
  $.ajax({
    url: "core/controll_log.php",
    type: "post",
    data: {
      command: "read_log",
    },
    success : function(data) {
      show_log(data);
    },
  })
}
// ログを表示する
function show_log(data) {
  data_array = data.split("\n");
  for(var i = 0; i < data_array.length; i++) {
    $('#logarea .log').append(data_array[i] + '<br>');
  }
  // スクロールを一番下に持っていく
  $('#logarea .log').animate({scrollTop: $('#logarea .log')[0].scrollHeight}, 'fast');
  return;
}
// textareaを一時保存する
function save_tmp() {
  // テキストエリアを取得する
  var text = $('#textarea textarea').val();
  console.log(text);

  $.ajax({
    url: "core/controll_log.php",
    type: "post",
    data: {
      command: "save_tmp",
      text: text,
    },
    success : function(data) {
      //show_tmp(data);
    },
  })
}
// textareaを取得する
function read_tmp() {
  $.ajax({
    url: "core/controll_log.php",
    type: "post",
    data: {
      command: "read_tmp",
    },
    success : function(data) {
      show_tmp(data);
    },
  })
}
// textareaを表示する
function show_tmp(data) {
  data_array = data.split("\n");
  var txt = "";
  for(var i = 0; i < data_array.length; i++) {
    txt = txt + data_array[i] + "\n";
  }
  $('#textarea textarea').val(txt);
}
</script>

  <header>
  </header>

  <div class="wrap">

    <article id="textarea">

      <form action="" method="post" class="textform">
        <textarea name="post"></textarea>
        <input type="submit" name="submit" value="投稿">
      </form>

    </article>

    <article id="logarea">
      <div class="log">

      </div>
    </article>

  </div>

  <footer role="contentinfo">

    <p>Copyright &copy; <time datetime="2018">2018</time></p>

  </footer>

</body>
</html>
