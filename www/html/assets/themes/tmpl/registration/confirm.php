<?php

global $si_registration;

usces_get_confirm_rows('return');

get_template_part('partial/head-registration');?>

<div class="l-container page-registration">
  <div class="l-content">
    <div class="l-main">
      <section class="registration-wrap">
        <ol class="registration-status">
          <li class="is-active">お客さま<br />情報入力</li>
          <li class="is-active">お届け先<br />情報入力</li>
          <li class="is-active">サイズ<br />選択</li>
          <li class="is-active">登録内容<br />確認</li>
          <li>支払設定<br /><span>（外部サイト）</span></li>
          <li>登録完了</li>
        </ol>
      </section>
      <section class="registration-section">
        <div class="text_formDescription">
          登録内容をご確認の上、クレジットカードお支払い設定画面（外部サイト）へお進みください。<br />
          <span>＊ は必須項目です。</span>
        </div>
        <div class="l-form">
          <dl class="form-item">
            <dt class="heading_formTitle">お名前<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('name1') . ' ' . $si_registration->get_value('name2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">フリガナ<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('name3') . ' ' . $si_registration->get_value('name4'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">性別<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('gender'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">生年月日<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('birthday_y') . '年' . $si_registration->get_value('birthday_m') . '月' . $si_registration->get_value('birthday_d') . '日');?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('mailaddress1'));?></p>
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
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('mail_magazine'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('zipcode'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">都道府県<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('pref'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">市区町村<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('address1'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">番地<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('address2'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">マンション・ビル名 部屋番号</dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('address3'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">ギフトの配送先<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm_s"><?php echo (int)$si_registration->get_delivery_value('delivery_flag') === 1 ? 'ギフトの配送先住所が異なる' : 'お客様情報に入力いただいた住所';?></p>
            </dd>
          </dl>

          <?php if ((int)$si_registration->get_delivery_value('delivery_flag') === 1):?><div class="form-subItems js-accordionBody">
            <dl class="form-item">
              <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_registration->get_delivery_value('zipcode'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">都道府県<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_registration->get_delivery_value('pref'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">市区町村<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_registration->get_delivery_value('address1'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">番地<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_registration->get_delivery_value('address2'));?></p>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">マンション・ビル名 部屋番号<span>＊</span></dt>
              <dd>
                <p class="form-item-confirm"><?php echo esc_html($si_registration->get_delivery_value('address3'));?></p>
              </dd>
            </dl>
          </div><?php endif;?>

          <dl class="form-item">
            <dt class="heading_formTitle">電話番号<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('tel'));?></p>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">服のサイズ<span>＊</span></dt>
            <dd>
              <p class="form-item-confirm"><?php echo esc_html($si_registration->get_value('size'));?></p>
            </dd>
          </dl>

          <dl class="form-item_confirm">
            <dd>
              <p class="text_formDescription">ご登録の前に、以下のご利用規約・プライバシーポリシーを必ずお読みください。</p>
              <ul class="list_link">
                <li><a href="<?php echo home_url('termsofservice');?>" target="_balnk" class="js-allow_unload">ご利用規約</a></li>
                <li><a href="<?php echo home_url('privacypolicy');?>" target="_balnk" class="js-allow_unload">プライバシーポリシー</a></li>
              </ul>
              <div class="form-item_check form-item-wrap js-checkToNext">
                <input type="checkbox"><label>ご利用規約、プライバシーポリシー<br class="pc-hide" />に同意します</label>
              </div>
              <p class="text_formDescription"><span>※上記規約・ガイドラインに同意の上、NEXTボタンを押すとクレジットカードお支払設定画面（外部サイト）へ進みます。設定が終了し、完了画面が表示されるまでMembers登録は完了されませんのでご注意ください。</span></p>
            </dd>
          </dl>
        </div>
      </section>

      <div class="pager_simple-wrap">
        <div class="pager_simple">
          <a href="<?php echo wp_nonce_url(home_url('registration/step3/'), 'registration-form', '_nonce');?>" class="button_back js-allow_unload" onClick="<?php echo ga_event_script('cv', 'confirm-back');?>">BACK</a>
          <?php Sheis\Welcart\Extension\purchase_button();?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php get_template_part('partial/foot-registration');?>