<?php

global $si_registration;
get_template_part('partial/head-registration');?>

<div class="l-container page-registration">
  <div class="l-content">
    <div class="l-main">
      <form method="post" action="<?php echo home_url('registration/step2/');?>">
        <?php wp_nonce_field('registration-form', '_registration_form_nonce');?>

        <section class="registration-wrap">
          <ol class="registration-status">
            <li class="is-active">お客さま<br />情報入力</li>
            <li>お届け先<br />情報入力</li>
            <li>サイズ<br />選択</li>
            <li>登録内容<br />確認</li>
            <li>支払設定<br /><span>（外部サイト）</span></li>
            <li>登録完了</li>
          </ol>
        </section>

        <section class="registration-section">
          <div class="l-form js-unload_message">
            <div class="text_formDescription">
              自動継続月額3,500円（税・送料込）のMembersに加入します。<br />
              <small>※今お申込みいただくと、11月下旬に「未来からきた女性」のギフトをお届けします。<br />
              ※お支払い方法はクレジットカードのみです。<br />
              ※登録月は解約を行うことができませんが、翌月2日からいつでも解約いただけます<br />（9月にご登録された方は、例外として11月2日から解約いただけます）。<br />
              <span>＊ は必須項目です。</span></small>
            </div>

            <dl class="form-item">
              <dt class="heading_formTitle">お名前<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="text" name="member[name1]" value="<?php echo esc_attr($si_registration->get_value('name1'));?>" placeholder="姓" />
                  <?php if ($message = $si_registration->get_error_message('name1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <input type="text" name="member[name2]" value="<?php echo esc_attr($si_registration->get_value('name2'));?>" placeholder="名" />
                  <?php if ($message = $si_registration->get_error_message('name2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">フリガナ<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="text" name="member[name3]" value="<?php echo esc_attr($si_registration->get_value('name3'));?>" placeholder="セイ" />
                  <?php if ($message = $si_registration->get_error_message('name3')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <input type="text" name="member[name4]" value="<?php echo esc_attr($si_registration->get_value('name4'));?>" placeholder="メイ" />
                  <?php if ($message = $si_registration->get_error_message('name4')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">性別<span>＊</span></dt>
              <dd>
                <div class="form-item-wrap">
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="男性"<?php if ($si_registration->get_value('gender') === '男性') echo ' checked';?> /><label>男性</label></div>
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="女性"<?php if ($si_registration->get_value('gender') === '女性') echo ' checked';?> /><label>女性</label></div>
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="その他"<?php if ($si_registration->get_value('gender') === 'その他') echo ' checked';?> /><label>その他</label></div>
                </div>
                <?php if ($message = $si_registration->get_error_message('gender')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">生年月日<span>＊</span></dt>
              <dd>
                <div class="form-item-inline">
                  <input type="number" name="custom_member[birthday_y]" value="<?php echo esc_attr($si_registration->get_value('birthday_y'));?>" placeholder="xxxx" class="input_s" /><span>年</span>
                  <input type="number" name="custom_member[birthday_m]" value="<?php echo esc_attr($si_registration->get_value('birthday_m'));?>" placeholder="xx" class="input_ss" /><span>月</span>
                  <input type="number" name="custom_member[birthday_d]" value="<?php echo esc_attr($si_registration->get_value('birthday_d'));?>" placeholder="xx" class="input_ss" /><span>日</span>
                </div>
                <?php if ($message = $si_registration->get_error_message('birthday')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
              <dd>
                <input type="email" name="member[mailaddress1]" value="<?php echo esc_attr($si_registration->get_value('mailaddress1'));?>" placeholder="入力してください" />
                <?php if ($message = $si_registration->get_error_message('mailaddress1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールアドレス(確認)<span>＊</span></dt>
              <dd>
                <input type="email" name="member[mailaddress2]" value="<?php echo esc_attr($si_registration->get_value('mailaddress2'));?>" placeholder="確認のため再入力" />
                <?php if ($message = $si_registration->get_error_message('mailaddress2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">パスワード<span>＊</span></dt>
              <dd>
                <input type="password" name="member[password1]" placeholder="英数字6文字以上で入力" />
                <?php if ($message = $si_registration->get_error_message('password1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">パスワード(確認)<span>＊</span></dt>
              <dd>
                <input type="password" name="member[password2]" placeholder="英数字6文字以上で入力" />
                <?php if ($message = $si_registration->get_error_message('password2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールマガジン<span>＊</span></dt>
              <dd>
                <div class="form-item-wrap">
                  <div class="form-item_2cal form-item_radio"><input type="radio" name="custom_member[mail_magazine]" value="希望する"<?php if ($si_registration->get_value('mail_magazine') === '希望する') echo ' checked';?> /><label>希望する</label></div>
                  <div class="form-item_2cal form-item_radio"><input type="radio" name="custom_member[mail_magazine]" value="希望しない"<?php if ($si_registration->get_value('genmail_magazineder') === '希望しない') echo ' checked';?> /><label>希望しない</label></div>
                </div>
                <?php if ($message = $si_registration->get_error_message('mail_magazine')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
              <dd class="text_formNote">※イベントの優待についてはメールマガジンで情報をお届けします。ご希望の方は必ず「希望する」にチェックしてください。</dd>
            </dl>
          </div>
        </section>

        <div class="pager_simple-wrap">
          <div class="pager_simple">
            <div class="button_next-wrap js-button_next-wrap">
              <input type="submit" class="button_next js-button_next" value="NEXT" onClick="<?php echo ga_event_script('cv', 'step1-next');?>">
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php get_template_part('partial/foot-registration');?>
