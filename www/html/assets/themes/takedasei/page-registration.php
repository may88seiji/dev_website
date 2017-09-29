<?php get_template_part('partial/head');?>

<div class="l-container page-registration">
  <div class="l-billboard">
    <h1 class="heading_billboard">MEMBERS 新規登録</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <p class="text_section_description">"She is"は参加型のコミュニティです。<br class="sp-hide"/>毎月3,500円でご登録いただいた有料Membersの方には日々を祝福するギフトをお届けしたり、<br class="sp-hide"/>イベントの優待や限定の記事、メールマガジンの交流など"She is"とのかかわりあいが増えてゆきます。<br class="sp-hide"/>私たちと"She is"をつくってみませんか？</p>
        <?php if(get_main_gift()):?><div class="alert"><p>今お申込みいただくと、<?php the_field('shipping_month', get_main_gift());?>に「<a href="<?php echo get_main_gift('permalink')?>"><?php echo get_main_feature('name')?></a>」のギフトをお届けします。<br /><small>※受注生産のため、新規会員受付を締め切る可能性がございます。お早めにお申込みください。</small></p></div>
        <?php endif;?>

        <?php echo do_shortcode('[si_registration_button item="GIFT" sku="ボックス" value="毎月3,500円で<br />Membersに登録する" onclick="'. ga_event_script('cv', 'registration-1,').'"]');?>

        <h2 class="heading_tertiary">Membersができること</h2>
        <?php get_template_part('partial/card-members');?>

        <?php echo do_shortcode('[si_registration_button item="GIFT" sku="ボックス" value="毎月3,500円で<br />Membersに登録する" onclick="'. ga_event_script('cv', 'registration-2,').'"]');?>
        <?php /*<p class="button_line c-bg-b_1"><a href="">毎月3,500円で登録する</a></p>*/?>

        <h2 class="heading_tertiary">Members登録の流れ</h2>
        <ol class="list_flow">
          <li>
            <i><svg viewBox="0 0 51.2 34.9"><use xlink:href="#s-icon_card"></use></svg></i>
            <div class="list_flow-text">お申込みフォームから<br />クレジットカードでMembers登録完了</div>
          </li>
          <li>
            <i><svg viewBox="0 0 50 34.07"><use xlink:href="#s-icon_mail"></use></svg></i>
            <div class="list_flow-text">限定記事やイベント情報<br class="pc-hide" />を<br class="sp-hide"/>いち早く知れる<br />メールマガジンが<br />読めるように！</div>
          </li>
          <li>
            <i><svg viewBox="0 0 50 37.31"><use xlink:href="#s-icon_gift"></use></svg></i>
            <div class="list_flow-text">登録した翌月から<br />毎月サプライズギフトを<br />お届け！</div>
          </li>
        </ol>
        <div class="registration-schedule">
          <div class="registration-schedule-section">
            <h2 class="heading_tertiary">9月・10月のギフト<br class="pc-hide" />「未来からきた女性」のスケジュール</h2>
            <ul class="registration-schedule-note">
              <li><small>※9月・10月のギフトを手に入れるには、10月末までにMembersのお申込みが必要です。</small></li>
              <li><small>※お申込みを途中で締め切る可能性がございますので、ご了承ください。</small></li>
            </ul>
            <div class="registration-schedule-image"></div>
          </div>
          <div class="registration-schedule-section">
            <h2 class="heading_tertiary">11月のギフトのスケジュール</h2>
            <ul class="registration-schedule-note">
              <li><small>※11月のギフトを手に入れるには、11月末までにMembersのお申込みが必要です。</small></li>
              <li><small>※お申込みを途中で締め切る可能性がございますので、ご了承ください。</small></li>
              <li><small>※12月以降も同様です。</small></li>
            </ul>
            <div class="registration-schedule-image"></div>
          </div>
        </div>
        <div class="cards_large_wrap">
          <ul class="cards_large">
            <li>
              <div class="cards_large-title">お支払について</div>
              <ul>
                <li>お支払はクレジットカードのみとさせていただいております。</li>
                <li>毎月3,500円（税・送料込）、自動課金で引き落としが行われます。</li>
                <li>登録のときにはクレジットカードの承認のみで課金は行われません。毎月1日頃に課金が行われます（9月にご登録された方は、例外として11月1日に課金が行われます）。</li>
                <li>カード情報は外部サイトにて登録を行い、承認されるとShe isウェブサイトに戻り完了画面が表示されます。画面が表示されるまで登録は完了されませんので、ご注意ください。</li>
                <li>登録月は解約を行うことができませんが、翌月2日からいつでも解約いただけます（9月にご登録された方は、例外として11月2日から解約いただけます）。</li>
              </ul>
            </li>
            <li>
              <div class="cards_large-title">ギフトの郵送について</div>
              <ul>
                <li>送料は日本全国無料です。海外にはお届けできません。</li>
                <li>ギフトはエコ配でお届けします。</li>
                <li>9月・10月のみ、2か月合併版として「未来からきた女性」のギフトを11月下旬にお送りします。11月以降は、毎月一つのテーマのギフトを翌月下旬にお送りします。</li>
              </ul>
            </li>
          </ul>
        </div>

          <div class="wrap_toFaq">
            <p class="text_letter">Membersに関するよくあるご質問をまとめておりますので、お申込み前に必ずお読みください。</p>
            <p class="button_fill"><a href="<?php echo home_url('/faq/');?>">よくあるご質問</a></p>
          </div>

        <?php echo do_shortcode('[si_registration_button item="GIFT" sku="ボックス" value="毎月3,500円で<br />Membersに登録する" onclick="'. ga_event_script('cv', 'registration-3,').'"]');?>
        <?php /*<p class="button_line c-bg-b_1"><a href="">毎月3,500円で登録する</a></p>*/?>

      </section>
    </div>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">会員登録</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>