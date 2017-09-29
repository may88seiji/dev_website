<?php get_template_part('partial/head-registration');?>

<div class="l-container page-registration">
  <div class="l-content">
    <div class="l-main">

      <section class="registration-wrap">
        <ol class="registration-status">
          <li class="is-active">お客さま<br />情報入力</li>
          <li class="is-active">お届け先<br />情報入力</li>
          <li class="is-active">サイズ<br />選択</li>
          <li class="is-active">登録内容<br />確認</li>
          <li class="is-active">支払設定<br /><span>（外部サイト）</span></li>
          <li class="is-active">登録完了</li>
        </ol>
      </section>

      <section class="registration-section_complete">
        <h1 class="heading_page_ja">登録が完了しました</h1>
        <div class="text_formDescription">
          <p>
            Membersへのご登録、ありがとうございました！<br />
            ご登録いただいたメールアドレスに<br />
            メールをお送りいたしましたので、<br class="pc-hide" />ご確認ください。
          </p>
          <p>ギフトの到着もお楽しみに。</p>
          <p>"She is" yours! あなたの場所になりますように。</p>
        </div>
      </section>

      <div class="pager_simple-wrap">
        <div class="pager_simple">
          <a href="<?php echo home_url('members/');?>" class="button_next">MY PAGE</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_template_part('partial/foot-registration');?>