<?php

add_action('admin_print_footer_scripts', function()
{
?>
<script>
jQuery(function($) {
  $("input[name='allcheck']").click(function () {
    if( $(this).attr("checked") ){
      $("input[name*='listcheck']").attr({checked: true});
    }else{
      $("input[name*='listcheck']").attr({checked: false});
    }
  });

  $('.js-send-reregistration-mail').on('click', function() {
    if ($('input[name*="listcheck"]:checked').length === 0) {
      alert('データが選択されていません');
      return false;
    }
  });
});
</script>
<?php
});

?>
<div class="wrap">
  <div class="usces_admin">
    <h1>Welcart Management 非継続課金会員リスト</h1>
    <p class="version_info"></p>
    <?php usces_admin_action_status();?>

    <form action="<?php menu_page_url('si_non_continue');?>" method="post" name="tablesearch" id="form_tablesearch">
      <?php wp_nonce_field('send_reregistration_mail', 'si_action_nonce'); ?>

      <div id="datatable">
        <div class="usces_tablenav usces_tablenav_top">
          <ul class="clearfix">
            <li class="rowsnum"><?php echo $total;?>件</li>
            <?php if ($total > 0):?><li><input type="submit" class="button button-primary js-send-reregistration-mail" value="再登録案内メール送信"></li><?php endif;?>
          </ul>
          <div class="refresh"><a href="<?php echo menu_page_url('si_non_continue', false);?>&refresh"><span class="dashicons dashicons-update"></span>最新の情報に更新</a></div>
        </div>
        <table id="mainDataTable" class="new-table order-new-table">
          <thead>
            <tr>
              <th><input name="allcheck" type="checkbox" value=""></th>
              <th>会員No</th>
              <th>姓</th>
              <th>名</th>
              <th>Eメール</th>
              <th>登録日</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($results):
              foreach ($results as $r):?><tr>
              <td class="center"><input name="listcheck[]" type="checkbox" value="<?php echo esc_attr($r->ID);?>"></td>
              <td><a href="<?php echo admin_url('admin.php?page=usces_memberlist&member_action=edit&member_id=' . $r->ID);?>"><?php echo esc_html($r->ID);?></a></td>
              <td><?php echo esc_html($r->mem_name1);?></td>
              <td><?php echo esc_html($r->mem_name2);?></td>
              <td><?php echo esc_html($r->mem_email);?></td>
              <td><?php echo esc_html($r->mem_registered);?></td>
            </tr><?php endforeach;
            endif;?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>
