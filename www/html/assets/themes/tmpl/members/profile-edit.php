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
        <form method="post" action="<?php echo home_url('members/profile/edit/');?>">
          <?php wp_nonce_field('profile-edit-form', '_profile_form_nonce');?>
          <input type="hidden" name="si_profile_action" value="confirm">

          <div class="text_formDescription">
            登録内容を変更の上、ページ下部のボタンから確認画面へお進みください。<br />
            <span>＊ は必須項目です。</span>
          </div>

          <div class="l-form js-unload_message">
            <dl class="form-item">
              <dt class="heading_formTitle">お名前<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="text" name="member[name1]" value="<?php echo esc_attr(Helper::get_post('member.name1', $si_member->get_member_data('name1')));?>" placeholder="姓" />
                  <?php if ($message = $si_member->get_error_message('name1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <input type="text" name="member[name2]" value="<?php echo esc_attr(Helper::get_post('member.name2', $si_member->get_member_data('name2')));?>" placeholder="名" />
                  <?php if ($message = $si_member->get_error_message('name2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">フリガナ<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="text" name="member[name3]" value="<?php echo esc_attr(Helper::get_post('member.name3', $si_member->get_member_data('name3')));?>" placeholder="セイ" />
                  <?php if ($message = $si_member->get_error_message('name3')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <input type="text" name="member[name4]" value="<?php echo esc_attr(Helper::get_post('member.name4', $si_member->get_member_data('name4')));?>" placeholder="メイ" />
                  <?php if ($message = $si_member->get_error_message('name4')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">性別<span>＊</span></dt>
              <dd>
                <div class="form-item-wrap">
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="男性"<?php if (Helper::get_post('custom_member.gender', $si_member->get_member_data('gender')) === '男性') echo ' checked';?> /><label>男性</label></div>
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="女性"<?php if (Helper::get_post('custom_member.gender', $si_member->get_member_data('gender')) === '女性') echo ' checked';?> /><label>女性</label></div>
                  <div class="form-item_3cal form-item_radio"><input type="radio" name="custom_member[gender]" value="その他"<?php if (Helper::get_post('custom_member.gender', $si_member->get_member_data('gender')) === 'その他') echo ' checked';?> /><label>その他</label></div>
                </div>
                <?php if ($message = $si_member->get_error_message('gender')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">生年月日<span>＊</span></dt>
              <dd>
                <div class="form-item-inline">
                  <input type="number" name="custom_member[birthday_y]" value="<?php echo esc_attr(Helper::get_post('custom_member.birthday_y', substr($si_member->get_member_data('birthday'), 0, 4)));?>" placeholder="xxxx" class="input_s" /><span>年</span>
                  <input type="number" name="custom_member[birthday_m]" value="<?php echo esc_attr(Helper::get_post('custom_member.birthday_m', (int)substr($si_member->get_member_data('birthday'), 4, 2)));?>" placeholder="xx" class="input_ss" /><span>月</span>
                  <input type="number" name="custom_member[birthday_d]" value="<?php echo esc_attr(Helper::get_post('custom_member.birthday_d', (int)substr($si_member->get_member_data('birthday'), 6, 2)));?>" placeholder="xx" class="input_ss" /><span>日</span>
                </div>
                <?php if ($message = $si_member->get_error_message('birthday')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
              <dd>
                <input type="hidden" name="member[old_mailaddress]" value="<?php echo esc_attr($si_member->get_member_data('mailaddress1'));?>" />
                <input type="email" name="member[mailaddress1]" value="<?php echo esc_attr(Helper::get_post('member.mailaddress1', $si_member->get_member_data('mailaddress1')));?>" placeholder="入力してください" />
                <?php if ($message = $si_member->get_error_message('mailaddress1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールアドレス(確認)<span>＊</span></dt>
              <dd>
                <input type="email" name="member[mailaddress2]" value="<?php echo esc_attr(Helper::get_post('member.mailaddress2'));?>" placeholder="確認のため再入力" />
                <?php if ($message = $si_member->get_error_message('mailaddress2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">パスワード<span>＊</span><small>パスワードを変更する場合のみ入力</small></dt>
              <dd>
                <input type="password" name="member[password1]" placeholder="英数字6文字以上で入力" />
                <?php if ($message = $si_member->get_error_message('password1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">パスワード(確認)<span>＊</span><small>パスワードを変更する場合のみ入力</small></dt>
              <dd>
                <input type="password" name="member[password2]" placeholder="英数字6文字以上で入力" />
                <?php if ($message = $si_member->get_error_message('password2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">メールマガジン<span>＊</span></dt>
              <dd>
                <div class="form-item-wrap">
                  <div class="form-item_2cal form-item_radio"><input type="radio" name="custom_member[mail_magazine]" value="希望する"<?php if (Helper::get_post('custom_member.mail_magazine', $si_member->get_member_data('mail_magazine')) === '希望する') echo ' checked';?> /><label>希望する</label></div>
                  <div class="form-item_2cal form-item_radio"><input type="radio" name="custom_member[mail_magazine]" value="希望しない"<?php if (Helper::get_post('custom_member.mail_magazine', $si_member->get_member_data('mail_magazine')) === '希望しない') echo ' checked';?> /><label>希望しない</label></div>
                </div>
                <?php if ($message = $si_member->get_error_message('mail_magazine')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="number" name="member[zipcode]" value="<?php echo esc_attr(Helper::get_post('member.zipcode', $si_member->get_member_data('zipcode')));?>" placeholder="〒" />
                  <?php if ($message = $si_member->get_error_message('zipcode')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <p class="button_fill_block">
                    <input type="button" value="自動住所入力" onclick="AjaxZip3.zip2addr('member[zipcode]', '', 'member[pref]', 'member[address1]');" />
                  </p>
                </div>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">都道府県<span>＊</span></dt>
              <dd>
                <div class="form-item_select js-form-select" data-select="member[pref]">
                  <p>選択してください</p>
                  <select name="member[pref]">
                    <option value="" selected>選択してください</option>
                    <option value="北海道"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '北海道') echo ' selected';?>>北海道</option>
                    <option value="青森県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '青森県') echo ' selected';?>>青森県</option>
                    <option value="岩手県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '岩手県') echo ' selected';?>>岩手県</option>
                    <option value="宮城県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '宮城県') echo ' selected';?>>宮城県</option>
                    <option value="秋田県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '秋田県') echo ' selected';?>>秋田県</option>
                    <option value="山形県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '山形県') echo ' selected';?>>山形県</option>
                    <option value="福島県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '福島県') echo ' selected';?>>福島県</option>
                    <option value="茨城県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '茨城県') echo ' selected';?>>茨城県</option>
                    <option value="栃木県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '栃木県') echo ' selected';?>>栃木県</option>
                    <option value="群馬県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '群馬県') echo ' selected';?>>群馬県</option>
                    <option value="埼玉県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '埼玉県') echo ' selected';?>>埼玉県</option>
                    <option value="千葉県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '千葉県') echo ' selected';?>>千葉県</option>
                    <option value="東京都"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '東京都') echo ' selected';?>>東京都</option>
                    <option value="神奈川県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref') )=== '神奈川県') echo ' selected';?>>神奈川県</option>
                    <option value="新潟県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '新潟県') echo ' selected';?>>新潟県</option>
                    <option value="富山県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '富山県') echo ' selected';?>>富山県</option>
                    <option value="石川県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '石川県') echo ' selected';?>>石川県</option>
                    <option value="福井県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '福井県') echo ' selected';?>>福井県</option>
                    <option value="山梨県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '山梨県') echo ' selected';?>>山梨県</option>
                    <option value="長野県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '長野県') echo ' selected';?>>長野県</option>
                    <option value="岐阜県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '岐阜県') echo ' selected';?>>岐阜県</option>
                    <option value="静岡県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '静岡県') echo ' selected';?>>静岡県</option>
                    <option value="愛知県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '愛知県') echo ' selected';?>>愛知県</option>
                    <option value="三重県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '三重県') echo ' selected';?>>三重県</option>
                    <option value="滋賀県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '滋賀県') echo ' selected';?>>滋賀県</option>
                    <option value="京都府"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '京都府') echo ' selected';?>>京都府</option>
                    <option value="大阪府"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '大阪府') echo ' selected';?>>大阪府</option>
                    <option value="兵庫県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '兵庫県') echo ' selected';?>>兵庫県</option>
                    <option value="奈良県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '奈良県') echo ' selected';?>>奈良県</option>
                    <option value="和歌山県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref') )=== '和歌山県') echo ' selected';?>>和歌山県</option>
                    <option value="鳥取県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '鳥取県') echo ' selected';?>>鳥取県</option>
                    <option value="島根県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '島根県') echo ' selected';?>>島根県</option>
                    <option value="岡山県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '岡山県') echo ' selected';?>>岡山県</option>
                    <option value="広島県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '広島県') echo ' selected';?>>広島県</option>
                    <option value="山口県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '山口県') echo ' selected';?>>山口県</option>
                    <option value="徳島県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '徳島県') echo ' selected';?>>徳島県</option>
                    <option value="香川県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '香川県') echo ' selected';?>>香川県</option>
                    <option value="愛媛県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '愛媛県') echo ' selected';?>>愛媛県</option>
                    <option value="高知県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '高知県') echo ' selected';?>>高知県</option>
                    <option value="福岡県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '福岡県') echo ' selected';?>>福岡県</option>
                    <option value="佐賀県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '佐賀県') echo ' selected';?>>佐賀県</option>
                    <option value="長崎県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '長崎県') echo ' selected';?>>長崎県</option>
                    <option value="熊本県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '熊本県') echo ' selected';?>>熊本県</option>
                    <option value="大分県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '大分県') echo ' selected';?>>大分県</option>
                    <option value="宮崎県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '宮崎県') echo ' selected';?>>宮崎県</option>
                    <option value="鹿児島県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref') )=== '鹿児島県') echo ' selected';?>>鹿児島県</option>
                    <option value="沖縄県"<?php if (Helper::get_post('member.pref', $si_member->get_member_data('pref')) === '沖縄県') echo ' selected';?>>沖縄県</option>
                  </select>
                </div>
                <?php if ($message = $si_member->get_error_message('pref')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">市区町村<span>＊</span></dt>
              <dd>
                <input type="text" name="member[address1]" value="<?php echo esc_attr(Helper::get_post('member.address1', $si_member->get_member_data('address1')));?>" placeholder="入力してください" />
                <?php if ($message = $si_member->get_error_message('address1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">番地<span>＊</span></dt>
              <dd>
                <input type="text" name="member[address2]" value="<?php echo esc_attr(Helper::get_post('member.address2', $si_member->get_member_data('address2')));?>" placeholder="入力してください" />
                <?php if ($message = $si_member->get_error_message('address2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">マンション・ビル名</dt>
              <dd>
                <input type="text" name="member[address3]" value="<?php echo esc_attr(Helper::get_post('member.address3', $si_member->get_member_data('address3')));?>" placeholder="入力してください" />
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">ギフトの配送先<span>＊</span></dt>
              <dd>
                <div class="form-item_check form-item-wrap">
                  <input type="hidden" name="delivery[delivery_flag]" value="0">
                  <input type="checkbox" name="delivery[delivery_flag]" value="1" class="js-checkToAccordion" data-target="js-accordionBody"<?php if ((int)Helper::get_post('delivery.delivery_flag', $si_member->get_member_data('delivery_flag')) === 1) echo ' checked';?>><label>ギフトの配達先住所が異なる場合、チェックして別の住所を入力</label>
                </div>
              </dd>
            </dl>

            <div class="form-subItems js-accordionBody">
              <dl class="form-item">
                <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
                <dd>
                  <div class="form-item_2cal">
                    <input type="number" name="delivery[zipcode]" value="<?php echo esc_attr(Helper::get_post('delivery.zipcode', $si_member->get_member_data('delivery_zipcode')));?>" placeholder="〒" />
                    <?php if ($message = $si_member->get_error_message('delivery_zipcode')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                  </div>
                  <div class="form-item_2cal">
                    <p class="button_fill_block">
                      <input type="button" value="自動住所入力" onclick="AjaxZip3.zip2addr('delivery[zipcode]', '', 'delivery[pref]', 'delivery[address1]');" />
                    </p>
                  </div>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">都道府県<span>＊</span></dt>
                <dd>
                  <div class="form-item_select js-form-select" data-select="delivery[pref]">
                    <p>選択してください</p>
                    <select name="delivery[pref]">
                      <option value="" selected>選択してください</option>
                      <option value="北海道"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '北海道') echo ' selected';?>>北海道</option>
                      <option value="青森県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '青森県') echo ' selected';?>>青森県</option>
                      <option value="岩手県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '岩手県') echo ' selected';?>>岩手県</option>
                      <option value="宮城県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '宮城県') echo ' selected';?>>宮城県</option>
                      <option value="秋田県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '秋田県') echo ' selected';?>>秋田県</option>
                      <option value="山形県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '山形県') echo ' selected';?>>山形県</option>
                      <option value="福島県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '福島県') echo ' selected';?>>福島県</option>
                      <option value="茨城県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '茨城県') echo ' selected';?>>茨城県</option>
                      <option value="栃木県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '栃木県') echo ' selected';?>>栃木県</option>
                      <option value="群馬県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '群馬県') echo ' selected';?>>群馬県</option>
                      <option value="埼玉県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '埼玉県') echo ' selected';?>>埼玉県</option>
                      <option value="千葉県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '千葉県') echo ' selected';?>>千葉県</option>
                      <option value="東京都"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '東京都') echo ' selected';?>>東京都</option>
                      <option value="神奈川県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref') )=== '神奈川県') echo ' selected';?>>神奈川県</option>
                      <option value="新潟県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '新潟県') echo ' selected';?>>新潟県</option>
                      <option value="富山県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '富山県') echo ' selected';?>>富山県</option>
                      <option value="石川県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '石川県') echo ' selected';?>>石川県</option>
                      <option value="福井県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '福井県') echo ' selected';?>>福井県</option>
                      <option value="山梨県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '山梨県') echo ' selected';?>>山梨県</option>
                      <option value="長野県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '長野県') echo ' selected';?>>長野県</option>
                      <option value="岐阜県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '岐阜県') echo ' selected';?>>岐阜県</option>
                      <option value="静岡県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '静岡県') echo ' selected';?>>静岡県</option>
                      <option value="愛知県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '愛知県') echo ' selected';?>>愛知県</option>
                      <option value="三重県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '三重県') echo ' selected';?>>三重県</option>
                      <option value="滋賀県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '滋賀県') echo ' selected';?>>滋賀県</option>
                      <option value="京都府"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '京都府') echo ' selected';?>>京都府</option>
                      <option value="大阪府"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '大阪府') echo ' selected';?>>大阪府</option>
                      <option value="兵庫県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '兵庫県') echo ' selected';?>>兵庫県</option>
                      <option value="奈良県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '奈良県') echo ' selected';?>>奈良県</option>
                      <option value="和歌山県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref') )=== '和歌山県') echo ' selected';?>>和歌山県</option>
                      <option value="鳥取県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '鳥取県') echo ' selected';?>>鳥取県</option>
                      <option value="島根県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '島根県') echo ' selected';?>>島根県</option>
                      <option value="岡山県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '岡山県') echo ' selected';?>>岡山県</option>
                      <option value="広島県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '広島県') echo ' selected';?>>広島県</option>
                      <option value="山口県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '山口県') echo ' selected';?>>山口県</option>
                      <option value="徳島県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '徳島県') echo ' selected';?>>徳島県</option>
                      <option value="香川県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '香川県') echo ' selected';?>>香川県</option>
                      <option value="愛媛県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '愛媛県') echo ' selected';?>>愛媛県</option>
                      <option value="高知県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '高知県') echo ' selected';?>>高知県</option>
                      <option value="福岡県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '福岡県') echo ' selected';?>>福岡県</option>
                      <option value="佐賀県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '佐賀県') echo ' selected';?>>佐賀県</option>
                      <option value="長崎県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '長崎県') echo ' selected';?>>長崎県</option>
                      <option value="熊本県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '熊本県') echo ' selected';?>>熊本県</option>
                      <option value="大分県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '大分県') echo ' selected';?>>大分県</option>
                      <option value="宮崎県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '宮崎県') echo ' selected';?>>宮崎県</option>
                      <option value="鹿児島県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref') )=== '鹿児島県') echo ' selected';?>>鹿児島県</option>
                      <option value="沖縄県"<?php if (Helper::get_post('delivery.pref', $si_member->get_member_data('delivery_pref')) === '沖縄県') echo ' selected';?>>沖縄県</option>
                    </select>
                  </div>
                  <?php if ($message = $si_member->get_error_message('delivery_pref')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">市区町村<span>＊</span></dt>
                <dd>
                  <input type="text" name="delivery[address1]" value="<?php echo esc_attr(Helper::get_post('delivery.address1', $si_member->get_member_data('delivery_address1')));?>" placeholder="入力してください" />
                  <?php if ($message = $si_member->get_error_message('delivery_address1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">番地<span>＊</span></dt>
                <dd>
                  <input type="text" name="delivery[address2]" value="<?php echo esc_attr(Helper::get_post('delivery.address2', $si_member->get_member_data('delivery_address2')));?>" placeholder="入力してください" />
                  <?php if ($message = $si_member->get_error_message('address2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">マンション・ビル名</dt>
                <dd>
                  <input type="text" name="delivery[address3]" value="<?php echo esc_attr(Helper::get_post('delivery.address3', $si_member->get_member_data('delivery_address3')));?>" placeholder="入力してください" />
                </dd>
              </dl>

            </div>

            <dl class="form-item">
              <dt class="heading_formTitle">電話番号（ハイフンなし）<span>＊</span></dt>
              <dd>
                <input type="tel" name="member[tel]" value="<?php echo esc_attr(Helper::get_post('member.tel', $si_member->get_member_data('tel')));?>" placeholder="数字9桁〜11桁で入力" />
                <?php if ($message = $si_member->get_error_message('tel')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">服のサイズ<span>＊</span></dt>
              <dd class="text_formNote mb20">She isでは、インナーウェアなどもお届けします。あなたは普段、どのサイズの服を買うことが多いですか？<br /></dd>
              <dd>
                <div class="form-item-wrap js-radioToNext">
                  <div class="form-item_3cal form-item_radio_l"><input type="radio"  name="custom_member[size]" value="S"<?php if (Helper::get_post('custom_member.size', $si_member->get_member_data('size') === 'S')) echo ' checked';?> /><label>S</label></div>
                  <div class="form-item_3cal form-item_radio_l"><input type="radio"  name="custom_member[size]" value="M"<?php if (Helper::get_post('custom_member.size', $si_member->get_member_data('size') === 'M')) echo ' checked';?> /><label>M</label></div>
                  <div class="form-item_3cal form-item_radio_l"><input type="radio"  name="custom_member[size]" value="L"<?php if (Helper::get_post('custom_member.size', $si_member->get_member_data('size') === 'L')) echo ' checked';?> /><label>L</label></div>
                </div>
                <?php if ($message = $si_member->get_error_message('size')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item_reference">
              <dt class="heading_formTitle">対応サイズ（ヌード寸法／単位：CM）</dt>
              <dd>
                <table class="table_simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>S</th>
                      <th>M</th>
                      <th>L</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>バスト</th>
                      <td>75〜83</td>
                      <td>81〜89</td>
                      <td>87〜95</td>
                    </tr>
                    <tr>
                      <th>ウエスト</th>
                      <td>59〜67</td>
                      <td>65〜73</td>
                      <td>71〜79</td>
                    </tr>
                    <tr>
                      <th>ヒップ</th>
                      <td>84〜92</td>
                      <td>90〜98</td>
                      <td>96〜104</td>
                    </tr>
                  </tbody>
                </table>
              </dd>
              <dd class="text_formNoteImportant">※対応サイズはあくまで目安です。デザインによって異なる場合がありますので、あらかじめご了承ください。</dd>
            </dl>
          </div>

          <div class="pager_simple-wrap">
            <div class="pager_simple">
              <a href="<?php echo home_url('members/profile/');?>" class="button_back">BACK</a>
              <div class="button_next-wrap js-button_next-wrap ">
                <input type="submit" class="button_next js-button_next" value="確認する">
              </div>
            </div>
          </div>
        </form>
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