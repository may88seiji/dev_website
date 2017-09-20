<?php

use Sheis\Welcart\Extension\Helper;

global $si_member;

get_template_part('partial/head');?>

<div class="l-container page-mypage">
  <div class="l-billboard">
    <h1 class="heading_billboard">登録情報変更</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <div class="text_formDescription">
          ご確認いただき、変更内容が正しければページ下部の「NEXT」ボタンからお進みください。
        </div>

        <div class="l-form">
          <dl class="form-item">
            <dt class="heading_formTitle">お名前<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.name1') . ' ' . Helper::get_post('member.name2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">フリガナ<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.name3') . ' ' . Helper::get_post('member.name4'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">性別<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('custom_member.gender'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">生年月日<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('custom_member.birthday_y') . '年' . Helper::get_post('custom_member.birthday_m') . '月' . Helper::get_post('custom_member.birthday_d') . '日');?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.mailaddress1'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">パスワード<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm">********</p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">メールマガジン<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('custom_member.mail_magazine'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">郵便番号<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.zipcode'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">都道府県<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.pref'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">市区町村<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.address1'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">番地<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.address2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">マンション・ビル名</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.address3'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">ギフトの配送先<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm_s"><?php echo (int)Helper::get_post('delivery.delivery_flag') === 1 ? 'ギフトの配送先住所が異なる' : '登録情報の住所';?></p>
            </dd>
          </dl>

          <?php if ((int)Helper::get_post('delivery.delivery_flag') === 1):?><div class="form-subItems js-accordionBody">
            <dl class="form-item">
              <dt class="heading_formTitle">郵便番号<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('delivery.zipcode'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">都道府県<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('delivery.pref'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">市区町村<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('delivery.address1'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">番地<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('delivery.address2'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">マンション・ビル名<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('delivery.address3'));?></p>
              </dd>
            </dl>
          </div><?php endif;?>

          <dl class="form-item">
            <dt class="heading_formTitle">電話番号<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('member.tel'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">服のサイズ<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html(Helper::get_post('custom_member.size'));?></p>
            </dd>
          </dl>
        </div>

        <div class="pager_simple-wrap">
          <div class="pager_simple">
            <a href="javascript:void(0);" onclick="history.back();" class="button_back js-allow_unload">BACK</a>
            <form method="post" action="<?php echo home_url('members/profile/edit/');?>">
              <?php wp_nonce_field('profile-edit-form', '_profile_form_nonce');?>
              <input type="hidden" name="si_profile_action" value="save">
              <div class="button_next-wrap js-button_next-wrap">
                <input type="submit" class="button_next js-button_next" value="NEXT">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('partial/members-side');?>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li><a href="<?php echo home_url('members/');?>">マイページ</a></li>
      <li class="is-current">登録情報変更</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>