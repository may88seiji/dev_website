<?php

global $si_member;

get_template_part('partial/head');?>

<div class="l-container page-mypage">
  <div class="l-billboard">
    <h1 class="heading_billboard">登録情報</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <div class="text_formDescription">
          登録情報を変更する場合は、ページ下部のボタンからお進みください。
        </div>
        <div class="l-form">
          <dl class="form-item">
            <dt class="heading_formTitle">お名前</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('name1') . ' ' . $si_member->get_member_data('name2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">フリガナ</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('name3') . ' ' . $si_member->get_member_data('name4'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">性別</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('gender'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">生年月日</dt>
            <dd>
              <?php $birthday = $si_member->get_member_data('birthday');?>
              <p class="form-item-confirm"><?php echo esc_html((int)substr($birthday, 0, 4) . '年' . (int)substr($birthday, 4, 2) . '月' . (int)substr($birthday, 6, 2) . '日');?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">メールアドレス</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('mailaddress1'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">パスワード</dt>
            <dd>
              <p class="form-item-confirm">********</p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">メールマガジン</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('mail_magazine'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">郵便番号</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('zipcode'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">都道府県</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('pref'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">市区町村</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('address1'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">番地</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('address2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">マンション・ビル名 部屋番号</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('address3'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">ギフトの配送先</dt>
            <dd>
              <p class="form-item-confirm_s"><?php echo (int)$si_member->get_member_data('delivery_flag') === 1 ? 'ギフトの配送先住所が異なる' : '登録情報の住所';?></p>
            </dd>
          </dl>

          <?php if ((int)$si_member->get_member_data('delivery_flag') === 1):?><div class="form-subItems js-accordionBody">

            <dl class="form-item">
              <dt class="heading_formTitle">郵便番号</dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('delivery_zipcode'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">都道府県</dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('delivery_pref'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">市区町村</dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('delivery_address1'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">番地</dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('delivery_address2'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">マンション・ビル名 部屋番号</dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('delivery_address3'));?></p>
              </dd>
            </dl>

          </div><?php endif;?>

          <dl class="form-item">
            <dt class="heading_formTitle">電話番号</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('tel'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">服のサイズ</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_member->get_member_data('size'));?></p>
            </dd>
          </dl>

        </div>

        <div class="mypage-buttons">
          <div class="mypage-buttons-2col">
            <p class="button_fill"><a href="<?php echo home_url('members/profile/edit/');?>">上記の情報を修正する</a></p>
            <?php /*<p class="button_fill"><a href="" target="_blank">カード情報を変更する（外部サイト）</a></p>*/?>
            <?php Sheis\Welcart\Extension\cardinfo_button();?>
          </div>
          <?php if(is_cancelable()):?><p class="button_text"><a href="<?php echo home_url('members/cancel/');?>">解約をご希望の方</a></p>

          <?php else:?><div class="mypage-aboutCancellation">
            <h2 class="heading_quaternary">解約をご希望の方</h2>
            <p class="text_letter">※解約は登録した次の月の2日から行なうことが可能です<br />
              （9月にご登録された方は、例外として11月2日から解約いただけます）。<br />
              詳しくは、<a href="<?php echo home_url('/faq/');?>">よくあるご質問</a>をご覧ください。</p>
          </div><?php endif;?>

          <p class="button_fill"><a href="<?php echo home_url('members/');?>">マイページトップに戻る</a></p>
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
      <li class="is-current">登録情報</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>