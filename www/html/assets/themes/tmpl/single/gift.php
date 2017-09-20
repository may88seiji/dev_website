<?php
global $wp_query, $exclude_id, $feature;
the_post();

$exclude_id[] = get_the_ID();
$feature = get_the_first_term(get_the_ID(), 'feature');

get_template_part('partial/head');?>
<div class="l-container page-detail_gift c-bg-b_<?php the_field('color', $feature)?>">
  <div class="l-billboard">
    <div class="billboard_feature">
      <div class="billboard-image js-billboardImg">
        <?php if($img = get_field('main_images')):?><div class="billboard-image-inner">
          <img src="<?php echo $img[0]['image']['sizes']['si-keyvisual']?>" alt="<?php echo strip_tags(get_the_title());?>">
        </div><?php endif;?>
        <div class="billboard-gift">
          <a href="<?php echo home_url('registration');?>" onClick="<?php echo ga_event_script('cv', 'pre-gift-billboard');?>">
            <div class="billboard-gift-text">
              <p class="billboard-gift-text-lead"><?php the_field('month', get_main_feature());?>月のギフトから申し込む<small>（<?php the_field('shipping_month', get_main_gift())?>のお届け）</small></p>
            </div>
          </a>
        </div>
        <div class="scrollable js-scrollable"><i></i></div>
      </div>
      <div class="billboard_feature-preamble js-scrollPos" data-scrolldelay="0.8">
        <p class="billboard_feature-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature)?>年<?php the_field('month', $feature)?>月のギフトテーマ</p>
        <h2 class="billboard_feature-title js-transitionBlock">「<?php echo $feature->name?>」</h2>
        <div class="billboard-text"><?php the_content();?></div>
      </div>
    </div>
  </div>
  <div class="l-content">
    <div class="l-main">
      <?php get_template_part('partial/gift-girlfriend');?>
      <section class="l-section gift-description js-scrollPos" data-scrolldelay="0.7">
        <h1 class="gift-description-heading js-transitionBlock">“She is”が毎月お届けする、<br class="pc-hide" />日常を祝福する贈りもの</h1>
        <p class="text_headingDescription_secondary">
          日々を勇気づけるようなギフトを<br class="pc-hide" />She isから毎月お届け。<br />Girlfriendsと一緒につくるオリジナルプロダクトや<span class="sp-hide">、</span><br />
          作品、グッズなどがつまったサプライズギフトを<br class="pc-hide" />有料Membersの方にお贈りします。<br />
          夢みたいな日も泣くことすらできなかった日も、<br class="pc-hide" />どんな心も体もちゃんと<br class="pc-hide" />祝福できるようになるために。<br />どうか大切なあなたの手元に届きますように。<br /><br />
          <small>※ギフトの内容は、毎月異なります。</small>
        </p>

        <ul class="cards_simple">
          <li class="js-transitionBlock">
            <h2 class="cards_simple-title">ORIGINAL PRODUCT</h2>
            <div class="cards-img">
              <svg viewBox="0 0 38.1 43.64"><use xlink:href="#s-icon_socks"></use></svg>
            </div>
            <div class="card-text">
              <div class="cards-description">Girlfriendsとつくった、<br>She isのギフトでしか手に入らないオリジナルプロダクト</div>
            </div>
          </li>
          <li class="js-transitionBlock">
            <h2 class="cards_simple-title">ARTWORK</h2>
            <div class="cards-img">
              <svg viewBox="0 0 66.35 33.79"><use xlink:href="#s-icon_art"></use></svg>
            </div>
            <div class="card-text">
              <div class="cards-description">小説、詩、イラスト、写真……。<br />特集テーマから生まれたとっておきの作品</div>
            </div>
          </li>
          <li class="js-transitionBlock">
            <h2 class="cards_simple-title">AND SO ON!</h2>
            <div class="cards-img">
              <svg viewBox="0 0 61.01 36.27"><use xlink:href="#s-icon_gift2"></use></svg>
            </div>
            <div class="card-text">
              <div class="cards-description">お花やアロマなど、<br />She isがセレクトしたさまざまなグッズ</div>
            </div>
          </li>
        </ul>

        <p class="button_line c-bg-b_<?php the_field('color', $feature)?>"><a href="<?php echo home_url('registration');?>" onClick="<?php echo ga_event_script('cv', 'pre-gift-1');?>"><?php the_field('month', get_main_feature());?>月のギフトから申し込む<small>（<?php the_field('shipping_month', get_main_gift())?>のお届け）</small></a></p>
      </section>

      <?php get_template_part('partial/gift-past');?>
      <?php get_template_part('partial/gift-members');?>

    </div>
  </div>
  <div class="l-aside">
    <section class="l-section">
      <?php get_template_part('partial/gift-feature');?>
      <?php get_template_part('partial/gift-share');?>
    </section>
    <?php /*<section class="l-section gift-timeline">
      <h1 class="heading_section_secondary">#sheisgift</h1>
      <p class="text_headingDescription_secondary">ギフトが届いたらInstagramでシェア</p>
      <div class="js-instaFeed"></div>
      <p class="button_fill"><a href="https://www.instagram.com/sheis_jp/" target="_blank">INSTAGRAM</a></p>
    </section>*/?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li><a href="<?php echo home_url('/gift/')?>">ギフト一覧</a></li>
      <li class="is-current"><?php the_title();?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>
