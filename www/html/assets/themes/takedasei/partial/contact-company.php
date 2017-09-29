<section class="contact-section" id="section_02">
  <form method="post" action="#section_02">
    <?php wp_nonce_field('the-postman');?>
    <input type="hidden" name="_status" value="confirm" />
    <input type="hidden" name="_section_company" value="1" />

    <div class="contact-section-inner">
      <h1 class="heading_tertiary">法人のお客さま</h1>
      <div class="text_formDescription">タイアップコンテンツやバナー広告、イベントやギフトでのコラボレーションなどについて、お気軽にお問い合わせくださいませ。媒体資料のご案内をいたします。</div>
      <div class="text_formDescription"><span>＊ は必須項目です。</span></div>
      <div class="l-form js-unload_message">
        <dl class="form-item">
          <dt class="heading_formTitle">お問い合わせの種類<span>＊</span></dt>
          <dd>

            <div class="form-item_select js-form-select">
              <p>選択してください</p>
              <select name="post_type"><?php $field = 'post_type'; ?>
                <option value=""<?php if(!get_postman($field)):?> selected<?php endif;?>>選択してください</option>
                <?php foreach(get_question_choices($field. '_company') as $value):?>
                <option value="<?php echo $value?>"<?php if(switch_selected_form($field, $value, '')) echo ' selected';?>><?php echo $value?></option>
                <?php endforeach;?>
              </select>
            </div>
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_type')):?><p class="text-formError">必須項目です</p><?php endif;?>


          </dd>
          <p class="text_formNote">※ファイルの添付をご希望の際は、直接<a href="mailto:hello@sheishere.jp" class="js-allow_unload">メール</a>にてお送り下さい。</p>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">貴社名</dt>
          <dd>
            <input type="text" name="post_company" value="<?php the_postman('post_company')?>" placeholder="入力してください" />
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">お名前<span>＊</span></dt>
          <dd>
            <input type="text" name="post_name" value="<?php the_postman('post_name')?>" placeholder="入力してください" />
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_name')):?><p class="text-formError"><?php echo postman_get_message('post_name', false);?></p><?php endif;?>
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">フリガナ<span>＊</span></dt>
          <dd>
            <input type="text" name="post_kana" value="<?php the_postman('post_kana')?>" placeholder="入力してください" />
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_kana')):?><p class="text-formError"><?php echo postman_get_message('post_kana', false);?></p><?php endif;?>
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
          <dd>
            <input type="email" name="post_email" value="<?php the_postman('post_email')?>" placeholder="入力してください" />
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_email')):?><p class="text-formError"><?php echo postman_get_message('post_email', false);?></p><?php endif;?>
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">メールアドレス(確認)<span>＊</span></dt>
          <dd>
            <input type="email" name="post_email_check" value="<?php the_postman('post_email_check')?>" placeholder="確認のため再入力" />
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_email_check')):?><p class="text-formError"><?php echo postman_get_message('post_email_check', false);?></p><?php endif;?>
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">電話番号</dt>
          <dd>
            <input type="tel" name="post_tel" value="<?php the_postman('post_tel')?>" placeholder="入力してください" />
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_tel')):?><p class="text-formError"><?php echo postman_get_message('post_tel', false);?></p><?php endif;?>
          </dd>
        </dl>
        <dl class="form-item">
          <dt class="heading_formTitle">内容<span>＊</span></dt>
          <dd>
            <div class="form-item-wrap">
              <textarea name="post_content" class="form-item_textarea" placeholder="入力してください"><?php the_postman('post_content')?></textarea>
            </div>
            <?php if(isset($_POST['_section_company']) && postman_is_error('post_content')):?><p class="text-formError"><?php echo postman_get_message('post_content', false);?></p><?php endif;?>
          </dd>
        </dl>
      </div>
    </div>

    <div class="pager_simple-wrap">
      <div class="pager_simple">
        <div class="button_next-wrap">
          <input type="submit" class="button_next" value="確認する"/>
        </div>
      </div>
    </div>
  </form>
</section>
