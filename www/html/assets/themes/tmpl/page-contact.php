<?php
get_template_part('partial/head');?>
<div class="l-container page-contact">

  <?php if (!postman_is_confirmed()):?><div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">お問い合わせ</h1>
        <ul class="pageScroll">
          <li><a href="#section_01" class="js-allow_unload"><p>一般、Membersのお客さま</p></a></li>
          <li><a href="#section_02" class="js-allow_unload"><p>法人のお客さま</p></a></li>
          <li><a href="#section_03" class="js-allow_unload"><p>Girlfriendsへの参加をご希望の方</p></a></li>
        </ul>
      </section>

      <?php get_template_part('partial/contact-member');?>
      <?php get_template_part('partial/contact-company');?>

      <section class="contact-section" id="section_03">
        <div class="contact-section-inner">
          <h1 class="heading_tertiary">Girlfriendsへの参加をご希望の方</h1>
          <p class="text_letter">必ず「<a href="<?php echo home_url('/about/');?>" target="_blank" class="js-allow_unload">ABOUT</a>」をお読みのうえ、<br>「<a href="mailto:hello@sheishere.jp" class="js-allow_unload">hello@sheishere.jp</a>」までご連絡くださいませ。</p>
        </div>
      </section>

    </div>
  </div>

  <?php else:?>
    <div class="l-billboard">
      <h1 class="heading_billboard">お問い合わせ 確認</h1>
    </div>

    <div class="l-content">
      <div class="l-main">
        <section class="l-section">
          <h2 class="text_headingDescription"><?php if(isset($_POST['_section_member'])):?>一般、Membersのお客さま<?php elseif(isset($_POST['_section_company'])):?>法人のお客さま<?php endif;?></h2>
        </section>

        <section class="contact-section" id="">
          <form method="post">
            <?php wp_nonce_field('the-postman');?>
            <input type="hidden" name="_finished" value="1" />
            <input type="hidden" name="_finish_page" value="<?php echo home_url('/contact/completed'); ?>" />
            <input type="hidden" name="_type[]" value="send_<?php if(isset($_POST['_section_member'])):?>member<?php elseif(isset($_POST['_section_company'])):?>company<?php endif;?>" />
            <input type="hidden" name="_type[]" value="confirm_<?php if(isset($_POST['_section_member'])):?>member<?php elseif(isset($_POST['_section_company'])):?>company<?php endif;?>" />
            <input type="hidden" name="post_type" value="<?php the_postman('post_type')?>" />
            <input type="hidden" name="post_company" value="<?php the_postman('post_company')?>" />
            <input type="hidden" name="post_name" value="<?php the_postman('post_name')?>" />
            <input type="hidden" name="post_kana" value="<?php the_postman('post_kana')?>" />
            <input type="hidden" name="post_email" value="<?php the_postman('post_email')?>" />
            <input type="hidden" name="post_email_check" value="<?php the_postman('post_email_check')?>" />
            <input type="hidden" name="post_tel" value="<?php the_postman('post_tel')?>" />
            <input type="hidden" name="post_content" value="<?php the_postman('post_content')?>" />

            <div class="contact-section-inner">

              <div class="text_formDescription"><span>＊ は必須項目です。</span>
              </div>
              <div class="l-form js-unload_message">
                <dl class="form-item">
                  <dt class="heading_formTitle">お問い合わせの種類<span>＊</span></dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_type')?></p>
                  </dd>

                </dl>
                <?php if(get_postman('post_company')):?><dl class="form-item">
                  <dt class="heading_formTitle">貴社名</dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_company')?></p>
                  </dd>
                </dl><?php endif;?>
                <dl class="form-item">
                  <dt class="heading_formTitle">お名前<span>＊</span></dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_name')?></p>
                  </dd>
                </dl>
                <dl class="form-item">
                  <dt class="heading_formTitle">フリガナ</dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_kana')?></p>
                  </dd>
                </dl>
                <dl class="form-item">
                  <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_email')?></p>
                  </dd>
                </dl>


                <dl class="form-item">
                  <dt class="heading_formTitle">電話番号</dt>
                  <dd>
                    <p class="form-item-confirm"><?php the_postman('post_tel')?></p>
                  </dd>
                </dl>
                <?php /*<dl class="form-item">
                  <dt class="heading_formTitle">ご注文ID</dt>
                  <dd>
                    <p class="form-item-confirm">XXXX0000</p>
                  </dd>
                </dl>*/?>
                <dl class="form-item">
                  <dt class="heading_formTitle">内容<span>＊</span></dt>
                  <dd>
                    <p class="form-item-confirm_s">
                      <?php the_postman('post_content')?>
                    </p>
                  </dd>
                </dl>

                <dl class="form-item_confirm">
                  <dd>
                    <p class="text_formDescription">お問い合わせの前に、以下のご利用規約・プライバシーポリシーを必ずお読みください。</p>
                    <ul class="list_link">
                      <li><a href="<?php echo home_url('termsofservice');?>" target="_balnk">ご利用規約</a></li>
                      <li><a href="<?php echo home_url('privacypolicy');?>" target="_balnk">プライバシーポリシー</a></li>
                    </ul>
                    <div class="form-item_check form-item-wrap js-checkToNext">
                      <input type="checkbox"><label>ご利用規約、プライバシーポリシーに同意します</label>
                    </div>
                  </dd>
                </dl>

              </div>
            </div>


          <div class="pager_simple-wrap">
            <div class="pager_simple">
              <a onclick="history.back()" class="button_back js-allow_unload">BACK</a>
              <div class="button_next-wrap js-button_next-wrap is-disabled">
                <input type="submit" class="button_next is-disabled js-button_next" value="送信する"/>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div><?php endif;?>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">お問い合わせ<?php if(postman_is_confirmed()):?>確認<?php endif;?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>