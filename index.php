<?php
require_once('core/config/index.php');

$Files = new Files();

// 投稿された場合の処理
if ($_POST['submit']) {
  $Files->write(h($_POST['post']));
}

?>
<?php include('meta.php');?>

<script type="text/javascript">
$(function() {
  // テキストエリアの高さを100%にする
  var window_h = $(window).height();
  var logarea_h = window_h - $('header').height() - $('#textarea').height() - $('footer').height();
  $('#logarea').height(logarea_h);

  load_log();
});

// ログファイルを取得する
function load_log() {
  $.ajax({
    //url: "logs/mindlog-20180726.log",
    url: "core/readlog.php",
    type: "get",
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
