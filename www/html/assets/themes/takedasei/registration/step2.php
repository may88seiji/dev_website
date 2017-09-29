<?php

global $si_registration;

get_template_part('partial/head-registration');?>

<div class="l-container page-registration">
  <div class="l-content">
    <div class="l-main">
      <form method="post" action="<?php echo home_url('registration/step3/');?>">
        <?php wp_nonce_field('registration-form', '_registration_form_nonce');?>

        <section class="registration-wrap">
          <ol class="registration-status">
            <li class="is-active">お客さま<br />情報入力</li>
            <li class="is-active">お届け先<br />情報入力</li>
            <li>サイズ<br />選択</li>
            <li>登録内容<br />確認</li>
            <li>支払設定<br /><span>（外部サイト）</span></li>
            <li>登録完了</li>
          </ol>
        </section>

        <section class="registration-section">
          <div class="l-form js-unload_message">
            <div class="text_formDescription">
              <small><span>＊ は必須項目です。</span></small>
            </div>

            <dl class="form-item">
              <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
              <dd>
                <div class="form-item_2cal">
                  <input type="number" name="member[zipcode]" value="<?php echo esc_attr($si_registration->get_value('zipcode'));?>" placeholder="〒" />
                  <?php if ($message = $si_registration->get_error_message('zipcode')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </div>
                <div class="form-item_2cal">
                  <p class="button_fill_block js-buttonAddress">
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
                    <option value="">選択してください</option>
                    <option value="北海道"<?php if ($si_registration->get_value('pref') === '北海道') echo ' selected';?>>北海道</option>
                    <option value="青森県"<?php if ($si_registration->get_value('pref') === '青森県') echo ' selected';?>>青森県</option>
                    <option value="岩手県"<?php if ($si_registration->get_value('pref') === '岩手県') echo ' selected';?>>岩手県</option>
                    <option value="宮城県"<?php if ($si_registration->get_value('pref') === '宮城県') echo ' selected';?>>宮城県</option>
                    <option value="秋田県"<?php if ($si_registration->get_value('pref') === '秋田県') echo ' selected';?>>秋田県</option>
                    <option value="山形県"<?php if ($si_registration->get_value('pref') === '山形県') echo ' selected';?>>山形県</option>
                    <option value="福島県"<?php if ($si_registration->get_value('pref') === '福島県') echo ' selected';?>>福島県</option>
                    <option value="茨城県"<?php if ($si_registration->get_value('pref') === '茨城県') echo ' selected';?>>茨城県</option>
                    <option value="栃木県"<?php if ($si_registration->get_value('pref') === '栃木県') echo ' selected';?>>栃木県</option>
                    <option value="群馬県"<?php if ($si_registration->get_value('pref') === '群馬県') echo ' selected';?>>群馬県</option>
                    <option value="埼玉県"<?php if ($si_registration->get_value('pref') === '埼玉県') echo ' selected';?>>埼玉県</option>
                    <option value="千葉県"<?php if ($si_registration->get_value('pref') === '千葉県') echo ' selected';?>>千葉県</option>
                    <option value="東京都"<?php if ($si_registration->get_value('pref') === '東京都') echo ' selected';?>>東京都</option>
                    <option value="神奈川県"<?php if ($si_registration->get_value('pref') === '神奈川県') echo ' selected';?>>神奈川県</option>
                    <option value="新潟県"<?php if ($si_registration->get_value('pref') === '新潟県') echo ' selected';?>>新潟県</option>
                    <option value="富山県"<?php if ($si_registration->get_value('pref') === '富山県') echo ' selected';?>>富山県</option>
                    <option value="石川県"<?php if ($si_registration->get_value('pref') === '石川県') echo ' selected';?>>石川県</option>
                    <option value="福井県"<?php if ($si_registration->get_value('pref') === '福井県') echo ' selected';?>>福井県</option>
                    <option value="山梨県"<?php if ($si_registration->get_value('pref') === '山梨県') echo ' selected';?>>山梨県</option>
                    <option value="長野県"<?php if ($si_registration->get_value('pref') === '長野県') echo ' selected';?>>長野県</option>
                    <option value="岐阜県"<?php if ($si_registration->get_value('pref') === '岐阜県') echo ' selected';?>>岐阜県</option>
                    <option value="静岡県"<?php if ($si_registration->get_value('pref') === '静岡県') echo ' selected';?>>静岡県</option>
                    <option value="愛知県"<?php if ($si_registration->get_value('pref') === '愛知県') echo ' selected';?>>愛知県</option>
                    <option value="三重県"<?php if ($si_registration->get_value('pref') === '三重県') echo ' selected';?>>三重県</option>
                    <option value="滋賀県"<?php if ($si_registration->get_value('pref') === '滋賀県') echo ' selected';?>>滋賀県</option>
                    <option value="京都府"<?php if ($si_registration->get_value('pref') === '京都府') echo ' selected';?>>京都府</option>
                    <option value="大阪府"<?php if ($si_registration->get_value('pref') === '大阪府') echo ' selected';?>>大阪府</option>
                    <option value="兵庫県"<?php if ($si_registration->get_value('pref') === '兵庫県') echo ' selected';?>>兵庫県</option>
                    <option value="奈良県"<?php if ($si_registration->get_value('pref') === '奈良県') echo ' selected';?>>奈良県</option>
                    <option value="和歌山県"<?php if ($si_registration->get_value('pref') === '和歌山県') echo ' selected';?>>和歌山県</option>
                    <option value="鳥取県"<?php if ($si_registration->get_value('pref') === '鳥取県') echo ' selected';?>>鳥取県</option>
                    <option value="島根県"<?php if ($si_registration->get_value('pref') === '島根県') echo ' selected';?>>島根県</option>
                    <option value="岡山県"<?php if ($si_registration->get_value('pref') === '岡山県') echo ' selected';?>>岡山県</option>
                    <option value="広島県"<?php if ($si_registration->get_value('pref') === '広島県') echo ' selected';?>>広島県</option>
                    <option value="山口県"<?php if ($si_registration->get_value('pref') === '山口県') echo ' selected';?>>山口県</option>
                    <option value="徳島県"<?php if ($si_registration->get_value('pref') === '徳島県') echo ' selected';?>>徳島県</option>
                    <option value="香川県"<?php if ($si_registration->get_value('pref') === '香川県') echo ' selected';?>>香川県</option>
                    <option value="愛媛県"<?php if ($si_registration->get_value('pref') === '愛媛県') echo ' selected';?>>愛媛県</option>
                    <option value="高知県"<?php if ($si_registration->get_value('pref') === '高知県') echo ' selected';?>>高知県</option>
                    <option value="福岡県"<?php if ($si_registration->get_value('pref') === '福岡県') echo ' selected';?>>福岡県</option>
                    <option value="佐賀県"<?php if ($si_registration->get_value('pref') === '佐賀県') echo ' selected';?>>佐賀県</option>
                    <option value="長崎県"<?php if ($si_registration->get_value('pref') === '長崎県') echo ' selected';?>>長崎県</option>
                    <option value="熊本県"<?php if ($si_registration->get_value('pref') === '熊本県') echo ' selected';?>>熊本県</option>
                    <option value="大分県"<?php if ($si_registration->get_value('pref') === '大分県') echo ' selected';?>>大分県</option>
                    <option value="宮崎県"<?php if ($si_registration->get_value('pref') === '宮崎県') echo ' selected';?>>宮崎県</option>
                    <option value="鹿児島県"<?php if ($si_registration->get_value('pref') === '鹿児島県') echo ' selected';?>>鹿児島県</option>
                    <option value="沖縄県"<?php if ($si_registration->get_value('pref') === '沖縄県') echo ' selected';?>>沖縄県</option>
                  </select>
                </div>
                <?php if ($message = $si_registration->get_error_message('pref')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">市区町村<span>＊</span></dt>
              <dd>
                <input type="text" name="member[address1]" value="<?php echo esc_attr($si_registration->get_value('address1'));?>" placeholder="入力してください" />
                <?php if ($message = $si_registration->get_error_message('address1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">番地<span>＊</span></dt>
              <dd>
                <input type="text" name="member[address2]" value="<?php echo esc_attr($si_registration->get_value('address2'));?>" placeholder="入力してください" />
                <?php if ($message = $si_registration->get_error_message('address2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">マンション・ビル名 部屋番号</dt>
              <dd>
                <input type="text" name="member[address3]" value="<?php echo esc_attr($si_registration->get_value('address3'));?>" placeholder="入力してください" />
              </dd>
            </dl>

            <dl class="form-item">
              <dt class="heading_formTitle">ギフトの配送先</dt>
              <dd>
                <div class="form-item_check form-item-wrap">
                  <input type="hidden" name="delivery[delivery_flag]" value="0">
                  <input type="checkbox" name="delivery[delivery_flag]" value="1" class="js-checkToAccordion" data-target="js-accordionBody"<?php if ((int)$si_registration->get_delivery_value('delivery_flag') === 1) echo ' checked';?>><label>ギフトの配達先住所が異なる場合、チェックして別の住所を入力</label>
                </div>
              </dd>
            </dl>

            <div class="form-subItems js-accordionBody">
              <dl class="form-item">
                <dt class="heading_formTitle">郵便番号（ハイフンなし）<span>＊</span></dt>
                <dd>
                  <div class="form-item_2cal">
                    <input type="number" name="delivery[zipcode]" value="<?php echo esc_attr($si_registration->get_delivery_value('zipcode'));?>" placeholder="〒" />
                    <?php if ($message = $si_registration->get_error_message('delivery_zipcode')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
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
                      <option value="北海道"<?php if ($si_registration->get_delivery_value('pref') === '北海道') echo ' selected';?>>北海道</option>
                      <option value="青森県"<?php if ($si_registration->get_delivery_value('pref') === '青森県') echo ' selected';?>>青森県</option>
                      <option value="岩手県"<?php if ($si_registration->get_delivery_value('pref') === '岩手県') echo ' selected';?>>岩手県</option>
                      <option value="宮城県"<?php if ($si_registration->get_delivery_value('pref') === '宮城県') echo ' selected';?>>宮城県</option>
                      <option value="秋田県"<?php if ($si_registration->get_delivery_value('pref') === '秋田県') echo ' selected';?>>秋田県</option>
                      <option value="山形県"<?php if ($si_registration->get_delivery_value('pref') === '山形県') echo ' selected';?>>山形県</option>
                      <option value="福島県"<?php if ($si_registration->get_delivery_value('pref') === '福島県') echo ' selected';?>>福島県</option>
                      <option value="茨城県"<?php if ($si_registration->get_delivery_value('pref') === '茨城県') echo ' selected';?>>茨城県</option>
                      <option value="栃木県"<?php if ($si_registration->get_delivery_value('pref') === '栃木県') echo ' selected';?>>栃木県</option>
                      <option value="群馬県"<?php if ($si_registration->get_delivery_value('pref') === '群馬県') echo ' selected';?>>群馬県</option>
                      <option value="埼玉県"<?php if ($si_registration->get_delivery_value('pref') === '埼玉県') echo ' selected';?>>埼玉県</option>
                      <option value="千葉県"<?php if ($si_registration->get_delivery_value('pref') === '千葉県') echo ' selected';?>>千葉県</option>
                      <option value="東京都"<?php if ($si_registration->get_delivery_value('pref') === '東京都') echo ' selected';?>>東京都</option>
                      <option value="神奈川県"<?php if ($si_registration->get_delivery_value('pref') === '神奈川県') echo ' selected';?>>神奈川県</option>
                      <option value="新潟県"<?php if ($si_registration->get_delivery_value('pref') === '新潟県') echo ' selected';?>>新潟県</option>
                      <option value="富山県"<?php if ($si_registration->get_delivery_value('pref') === '富山県') echo ' selected';?>>富山県</option>
                      <option value="石川県"<?php if ($si_registration->get_delivery_value('pref') === '石川県') echo ' selected';?>>石川県</option>
                      <option value="福井県"<?php if ($si_registration->get_delivery_value('pref') === '福井県') echo ' selected';?>>福井県</option>
                      <option value="山梨県"<?php if ($si_registration->get_delivery_value('pref') === '山梨県') echo ' selected';?>>山梨県</option>
                      <option value="長野県"<?php if ($si_registration->get_delivery_value('pref') === '長野県') echo ' selected';?>>長野県</option>
                      <option value="岐阜県"<?php if ($si_registration->get_delivery_value('pref') === '岐阜県') echo ' selected';?>>岐阜県</option>
                      <option value="静岡県"<?php if ($si_registration->get_delivery_value('pref') === '静岡県') echo ' selected';?>>静岡県</option>
                      <option value="愛知県"<?php if ($si_registration->get_delivery_value('pref') === '愛知県') echo ' selected';?>>愛知県</option>
                      <option value="三重県"<?php if ($si_registration->get_delivery_value('pref') === '三重県') echo ' selected';?>>三重県</option>
                      <option value="滋賀県"<?php if ($si_registration->get_delivery_value('pref') === '滋賀県') echo ' selected';?>>滋賀県</option>
                      <option value="京都府"<?php if ($si_registration->get_delivery_value('pref') === '京都府') echo ' selected';?>>京都府</option>
                      <option value="大阪府"<?php if ($si_registration->get_delivery_value('pref') === '大阪府') echo ' selected';?>>大阪府</option>
                      <option value="兵庫県"<?php if ($si_registration->get_delivery_value('pref') === '兵庫県') echo ' selected';?>>兵庫県</option>
                      <option value="奈良県"<?php if ($si_registration->get_delivery_value('pref') === '奈良県') echo ' selected';?>>奈良県</option>
                      <option value="和歌山県"<?php if ($si_registration->get_delivery_value('pref') === '和歌山県') echo ' selected';?>>和歌山県</option>
                      <option value="鳥取県"<?php if ($si_registration->get_delivery_value('pref') === '鳥取県') echo ' selected';?>>鳥取県</option>
                      <option value="島根県"<?php if ($si_registration->get_delivery_value('pref') === '島根県') echo ' selected';?>>島根県</option>
                      <option value="岡山県"<?php if ($si_registration->get_delivery_value('pref') === '岡山県') echo ' selected';?>>岡山県</option>
                      <option value="広島県"<?php if ($si_registration->get_delivery_value('pref') === '広島県') echo ' selected';?>>広島県</option>
                      <option value="山口県"<?php if ($si_registration->get_delivery_value('pref') === '山口県') echo ' selected';?>>山口県</option>
                      <option value="徳島県"<?php if ($si_registration->get_delivery_value('pref') === '徳島県') echo ' selected';?>>徳島県</option>
                      <option value="香川県"<?php if ($si_registration->get_delivery_value('pref') === '香川県') echo ' selected';?>>香川県</option>
                      <option value="愛媛県"<?php if ($si_registration->get_delivery_value('pref') === '愛媛県') echo ' selected';?>>愛媛県</option>
                      <option value="高知県"<?php if ($si_registration->get_delivery_value('pref') === '高知県') echo ' selected';?>>高知県</option>
                      <option value="福岡県"<?php if ($si_registration->get_delivery_value('pref') === '福岡県') echo ' selected';?>>福岡県</option>
                      <option value="佐賀県"<?php if ($si_registration->get_delivery_value('pref') === '佐賀県') echo ' selected';?>>佐賀県</option>
                      <option value="長崎県"<?php if ($si_registration->get_delivery_value('pref') === '長崎県') echo ' selected';?>>長崎県</option>
                      <option value="熊本県"<?php if ($si_registration->get_delivery_value('pref') === '熊本県') echo ' selected';?>>熊本県</option>
                      <option value="大分県"<?php if ($si_registration->get_delivery_value('pref') === '大分県') echo ' selected';?>>大分県</option>
                      <option value="宮崎県"<?php if ($si_registration->get_delivery_value('pref') === '宮崎県') echo ' selected';?>>宮崎県</option>
                      <option value="鹿児島県"<?php if ($si_registration->get_delivery_value('pref') === '鹿児島県') echo ' selected';?>>鹿児島県</option>
                      <option value="沖縄県"<?php if ($si_registration->get_delivery_value('pref') === '沖縄県') echo ' selected';?>>沖縄県</option>
                    </select>
                  </div>
                  <?php if ($message = $si_registration->get_error_message('delivery_pref')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">市区町村<span>＊</span></dt>
                <dd>
                  <input type="text" name="delivery[address1]" value="<?php echo esc_attr($si_registration->get_delivery_value('address1'));?>" placeholder="入力してください" />
                  <?php if ($message = $si_registration->get_error_message('delivery_address1')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">番地<span>＊</span></dt>
                <dd>
                  <input type="text" name="delivery[address2]" value="<?php echo esc_attr($si_registration->get_delivery_value('address2'));?>" placeholder="入力してください" />
                  <?php if ($message = $si_registration->get_error_message('delivery_address2')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                </dd>
              </dl>

              <dl class="form-item">
                <dt class="heading_formTitle">マンション・ビル名 部屋番号</dt>
                <dd>
                  <input type="text" name="delivery[address3]" value="<?php echo esc_attr($si_registration->get_delivery_value('address3'));?>" placeholder="入力してください" />
                </dd>
              </dl>
            </div>

            <dl class="form-item">
              <dt class="heading_formTitle">電話番号（ハイフンなし）<span>＊</span></dt>
              <dd>
                <input type="tel" name="member[tel]" value="<?php echo esc_attr($si_registration->get_value('tel'));?>" placeholder="数字9桁〜11桁で入力" />
                <?php if ($message = $si_registration->get_error_message('tel')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>
          </div>
        </section>

        <div class="pager_simple-wrap">
          <div class="pager_simple">
            <a href="<?php echo wp_nonce_url(home_url('registration/step1/'), 'registration-form', '_nonce');?>" class="button_back" onClick="<?php echo ga_event_script('cv', 'step2-back');?>">BACK</a>
            <div class="button_next-wrap js-button_next-wrap">
              <input type="submit" class="button_next js-button_next" value="NEXT" onClick="<?php echo ga_event_script('cv', 'step2-next');?>">
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php get_template_part('partial/foot-registration');?>