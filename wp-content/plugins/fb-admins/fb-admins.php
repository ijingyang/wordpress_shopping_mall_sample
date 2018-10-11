<?php
/*
  Plugin Name: Fb Admins
  Plugin URI: http://www.prime-strategy.co.jp/
  Description: Facebookのfb:adminsパラメータを管理画面で設定できるようにします。
  Author: Prime Strategy Co.,Ltd.
  Version: 1.0
  Author URI: http://www.prime-strategy.co.jp/
*/

function add_fb_admins_menu() {
  add_options_page('Fb admins 設定', 'Fb admins', 'manage_options',
   'fb-admins.php', 'fb_admins_page');
}
add_action('admin_menu', 'add_fb_admins_menu');

function fb_admins_page() {
?>

<div class="wrap">
  <?php screen_icon(); ?>
  <h2>Fb admins</h2>
<?php
  if(isset($_POST['fb_admins'])) {
    check_admin_referer('fb_admins_action', 'fb_admin_noncs'); // nonceが有効かチェック
    $fb_admins = stripslashes($_POST['fb_admins']);

    if(is_numeric($fb_admins)) {
      update_option('fb_admins', $fb_admins); // FBadminのIDを保存する
      echo '<p>保存しました。</p>';
    } else {
      echo '<p style="color: #f00">数値で入力してください。</p>';
    }
  } else {
    $fb_admins = get_option('fb_admins');
    echo '<p>管理者IDを入力します。</p>';
  }
?>
  <form action="" method="post">
    <?php wp_nonce_field('fb_admins_action', 'fb_admin_noncs') ?> //nonceをセット
    <input type="text" name="fb_admins"
     value="<?php echo esc_attr($fb_admins); ?>" />
     <?php submit_button(); ?>
  </form>
</div>
<?php
}

function fb_admins(){
  echo esc_attr(get_option('fb_admins'));
}

?>
