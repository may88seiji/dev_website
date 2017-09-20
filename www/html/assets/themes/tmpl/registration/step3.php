<?php

global $si_registration;

get_template_part('partial/head-registration');?>

<div class="l-container page-registration">
  <div class="l-content">
    <div class="l-main">
      <form method="post" action="<?php echo home_url('registration/confirm/');?>">
        <?php wp_nonce_field('registration-form', '_registration_form_nonce');?>
        <input type="hidden" name="offer[payment_name]" value="クレジットカード決済">

        <section class="registration-wrap">
          <ol class="registration-status">
            <li class="is-active">お客さま<br />情報入力</li>
            <li class="is-active">お届け先<br />情報入力</li>
            <li class="is-active">サイズ<br />選択</li>
            <li>登録内容<br />確認</li>
            <li>支払設定<br /><span>（外部サイト）</span></li>
            <li>登録完了</li>
          </ol>
        </section>

        <section class="registration-section">
          <div class="l-form js-unload_message">
            <div class="text_formDescription">
              She isでは、オリジナルプロダクトとしてインナーウェアなどもお届けします。あなたは普段、どのサイズの服を買うことが多いですか？<br />
              <small><span>＊ は必須項目です。</span></small>
            </div>

            <dl class="form-item">
              <dt class="heading_formTitle">服のサイズ<span>＊</span></dt>
              <dd>
                <div class="form-item-wrap js-radioToNext">
                  <div class="form-item_3cal form-item_radio_l"><input type="radio" name="custom_member[size]" value="S"<?php if ($si_registration->get_value('size') === 'S') echo ' checked';?> /><label>S</label></div>
                  <div class="form-item_3cal form-item_radio_l"><input type="radio" name="custom_member[size]" value="M"<?php if ($si_registration->get_value('size') === 'M') echo ' checked';?> /><label>M</label></div>
                  <div class="form-item_3cal form-item_radio_l"><input type="radio" name="custom_member[size]" value="L"<?php if ($si_registration->get_value('size') === 'L') echo ' checked';?> /><label>L</label></div>
                </div>
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
        </section>

        <div class="pager_simple-wrap">
          <div class="pager_simple">
            <a href="<?php echo wp_nonce_url(home_url('registration/step2/'), 'registration-form', '_nonce');?>" class="button_back" onClick="<?php echo ga_event_script('cv', 'step3-back');?>">BACK</a>
            <div class="button_next-wrap js-button_next-wrap is-disabled">
              <input type="submit" class="button_next is-disabled js-button_next" value="確認する" onClick="<?php echo ga_event_script('cv', 'step3-next');?>">
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php get_template_part('partial/foot-registration');?>