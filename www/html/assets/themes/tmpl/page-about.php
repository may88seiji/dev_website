<?php get_template_part('partial/head');?>
<div class="l-container page-about">

  <div class="l-content">
    <div class="l-main">
      <section class="about-lead js-animLine">
        <p><span>人がほんとうに輝く瞬間というのは</span><br /><span>はたしていつなのだろうか、と考えました。</span></p>
        <p><span>ありのままの私で生きたいと願っても</span><br /><span>ときにはどうしようもない壁にぶつかるし、<br class="pc-hide" />落ち込む夜もある。</span></p>
        <p><span>でも、ひとりだとどうにもならないことも</span><span><br />「私」があつまれば、<br class="pc-hide" />なにかが変わるかもしれない。<br />好きなものを深く語り合ったり、<br class="pc-hide" />意外な出会いに触れたりしたとき、<br />発見が訪れ、力が湧いてくることがある。</span></p>
        <p><span>私たちは、そのための<br class="pc-hide" />「場所」をつくりたいと思います。</span><br /><span>ひとりひとりが、<br class="pc-hide" />無敵かもしれないと思える夜を増やす。</span></p>
        <p><span>女性として生きる道のなかに</span><br /><span>瞬いたり、閃いたり、<br class="pc-hide" />小さな輝きがたくさん生まれますように。</span></p>
        <p><span>自分らしく生きる女性を祝福する</span><br /><span>ライフ&amp;カルチャーコミュニティ<br class="pc-hide" />“She is”、はじまります。</span></p>
        <div class="about-lead-bg"></div>
      </section>
      <section class="about-whats js-scrollPos">
        <div class="about-content">
          <h2 class="heading_section_primary">What's <span class="proper">"She is"?</span></h2>
          <p class="text_headingDescription">"She is"は、自分らしく生きる女性を祝福する<br />ライフ＆カルチャーコミュニティです。</p>
          <div class="about-flexWrap">
            <div class="about-whats-feature js-transitionBlock">
              <h2 class="about-whats-feature-heading">Feature</h2>
              <p class="about-whats-feature-text">毎月特集する<br class="pc-hide" />テーマに沿って<br />読みものや<br class="pc-hide" />ギフトを提案</p>
            </div>
            <div class="about-col about-whats-feature-magazine js-transitionBlock">
              <h2 class="about-heading_secondary">Web Magazine</h2>
              <svg viewBox="0 0 69.23 102.8"><use xlink:href="#s-feature-magazine"></use></svg>
              <p class="text_letter">日常に発見をもたらす読みもの</p>
            </div>
            <div class="about-col about-whats-feature-gift js-transitionBlock">
              <h2 class="about-heading_secondary">Gift</h2>
              <svg viewBox="0 0 101.5 70.3"><use xlink:href="#s-feature-gift"></use></svg>
              <p class="text_letter">日々を祝福する、毎月届く贈りもの<br class="pc-hide" />（月額3,500円）</p>
            </div>
          </div>
        </div>
        <div class="about-image-bg"></div>
      </section>
      <section class="about-member js-scrollPos">
        <div class="about-content">
          <h2 class="heading_section_primary">WHAT'S Members?</h2>
          <p class="text_headingDescription">"She is"は参加型のコミュニティです。<br />毎月3,500円でご登録いただいたMembersの方には<br />日々を祝福するギフトをお届けしたり、<br class="pc-hide" />イベントの優待や限定記事、メールマガジンなど<br />"She is"とのかかわりあいが増えてゆきます。<br />私たちと"She is"をつくってみませんか？</p>

          <?php get_template_part('partial/card-members');?>

          <p class="button_line c-bg-b_<?php the_field('color', get_main_feature())?>"><a href="<?php echo home_url('/registration/')?>" onClick="<?php echo ga_event_script('cv', 'pre-about');?>">毎月3,500円で<br>Membersに登録する</a></p>
        </div>
        <div class="about-image-bg"></div>
      </section>
      <section class="about-girlfriends js-scrollPos" id="girlfriends">
        <div class="about-content">

          <h2 class="heading_section_primary">Girlfriends</h2>
          <p class="text_headingDescription">"She is"は、<br class="pc-hide" />ウェブマガジンやギフト、イベントなどを<br />「Girlfriends」と呼んでいる魅力的な女性たちと<br class="pc-hide" />一緒につくっていきます。</p>
          <?php get_template_part('partial/pickup-girlfriends');?>
          <div class="about-girlfriends-how">
            <h3 class="heading_tertiary">GIRLFRIENDSの応募方法</h3>
            <p class="text_summary">Girlfriendsになる方法は、さまざま。<br />She is編集部から直接ご連絡をさせていただくほか、<br />まだ私たちが出会えていない方々からの応募も次の二つの方法で受け付けます。</p>
            <p class="text_summary">
              <strong>1.「VOICE」への公募</strong><br />「VOICE」は毎月の特集テーマにまつわるコラムやエッセイをさまざまな方に書いていただくコーナー。そのなかで、月に一枠、公募にて原稿を募集します。採用させていただいた方は、今後Girlfriendsとしてさまざまな企画でご一緒できればと思います。募集中の特集テーマについては「お知らせ」にて告知いたしますので、ご覧くださいませ。
            </p>
            <p class="text_summary">
              <strong>2.「コラム」への公募</strong><br />「こんなコラムを書いてみたい」というアイデアをお持ちの方には、お名前とご連絡先、「なぜShe isに掲載したいか」を記載し、原稿案を添付の上、「<a href="mailto:hello@sheishere.jp">hello@sheishere.jp</a>」までご連絡くださいませ。単発でも、連載でもどちらでも結構です。検討の上、採用させていただいた方のみ編集部からご連絡させていただきます。
            </p>
          </div>
        </div>
      </section>
      <section class="about-editor js-scrollPos">
        <div class="about-content">
          <h2 class="heading_section_primary">Editors</h2>
          <p class="text_headingDescription">"She is"は、株式会社CINRAが運営しています。</p>
          <ul class="list_octagon js-matchHeight">
            <li class="js-transitionBlock">
              <div class="list_octagon-img">
                <svg><image xlink:href="<?php echo get_template_directory_uri();?>/assets/img/about-editor-yume.jpg" width="100%" height="100%" /></svg>
              </div>
              <p class="list_octagon-text">野村 由芽</p>
              <p class="list_octagon-position">Founder / Chief Editor</p>
              <ul class="list_octagon-sns">
                <li><a href="http://twitter.com/ymue/" target="_blank"><i class="icon-twitter"></i></a></li>
                <li><a href="http://instagram.com/ymue/" target="_blank"><i class="icon-instagram"></i></a></li>
              </ul>
            </li>
            <li class="js-transitionBlock">
              <div class="list_octagon-img">
                <svg><image xlink:href="<?php echo get_template_directory_uri();?>/assets/img/about-editor-maki.jpg" width="100%" height="100%" /></svg>
              </div>
              <p class="list_octagon-text">竹中 万季</p>
              <p class="list_octagon-position">Founder / Producer</p>
              <ul class="list_octagon-sns">
                <li><a href="http://twitter.com/l_u_l_u/" target="_blank"><i class="icon-twitter"></i></a></li>
                <li><a href="http://instagram.com/l_u_l_u/" target="_blank"><i class="icon-instagram"></i></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </section>
    </div>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">ABOUT</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>