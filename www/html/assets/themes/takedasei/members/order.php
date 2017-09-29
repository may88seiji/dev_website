<?php get_template_part('partial/head');?>

<div class="l-container page-mypage">
<div class="l-billboard">
    <h1 class="heading_billboard">配達状況一覧</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <div class="mypage-description">
          <p class="text_letter">このページではギフトの配達状況の確認、ならびに領収書をダウンロードいただけます。</p>
        </div>

        <ul class="cards_mypage-delivery">
          <?php /* 10月末までの表示を仮実装 */if($main_feature = get_main_feature()):?><li>
            <div class="cards_mypage-delivery-summary c-bg-b_<?php echo get_main_theme_color_key();?>">
              <a href="<?php echo get_term_link($main_feature);?>">
                <h2 class="cards_mypage-delivery-heading">
                  <span class="c-cl-f_<?php echo get_main_theme_color_key();?>"><?php the_field('year', $main_feature);?>年<?php the_field('month', $main_feature);?>月のギフト</span>
                  <?php echo $main_feature->name?>
                </h2>
                <p class="cards_mypage-delivery-schedule">（<?php the_field('shipping_month', get_main_gift())?>のお届け）</p>
              </a>
            </div>
            <div class="cards_mypage-delivery-status">
              <h3 class="cards_mypage-delivery-status-heading">発送前</h3>
              <?php if(get_field('charge_date')):?><p class="cards_mypage-delivery-status-text">課金予定日：<?php the_field('charge_date', get_main_gift())?></p><?php endif;?>
            </div>
          </li><?php endif;?>
          <?php /* TODO: #376
          <li>
            <div class="cards_mypage-delivery-summary c-bg-b_1">
              <a href="">
                <h2 class="cards_mypage-delivery-heading">
                  <span class="c-cl-f_1">2018年1月のギフト</span>
                  ひとりでもいい
                </h2>
                <p class="cards_mypage-delivery-schedule">（2月下旬のお届け）</p>
              </a>
            </div>
            <div class="cards_mypage-delivery-status">
              <h3 class="cards_mypage-delivery-status-heading">発送前</h3>
              <p class="cards_mypage-delivery-status-text">課金予定日：12月1日</p>
              <div class="cards_mypage-delivery-button">
                <p class="button_fill"><a href="" target="_blank">領収書PDF</a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="cards_mypage-delivery-summary c-bg-b_1">
              <a href="">
                <h2 class="cards_mypage-delivery-heading">
                  <span class="c-cl-f_1">2018年1月のギフト</span>
                  ひとりでもいい
                </h2>
                <p class="cards_mypage-delivery-schedule">（2月下旬のお届け）</p>
              </a>
            </div>
            <div class="cards_mypage-delivery-status">
              <h3 class="cards_mypage-delivery-status-heading">発送前</h3>
              <div class="cards_mypage-delivery-button">
                <p class="button_fill"><a href="" target="_blank">領収書PDF</a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="cards_mypage-delivery-summary c-bg-b_1">
              <a href="">
                <h2 class="cards_mypage-delivery-heading">
                  <span class="c-cl-f_1">2018年1月のギフト</span>
                  母と娘２行の時２行の時２行の時母と娘
                </h2>
                <p class="cards_mypage-delivery-schedule">（2月下旬のお届け）</p>
              </a>
            </div>
            <div class="cards_mypage-delivery-status">
              <h3 class="cards_mypage-delivery-status-heading">発送前</h3>
              <p class="cards_mypage-delivery-status-text">課金予定日：12月1日</p>
              <div class="cards_mypage-delivery-button">
                <p class="button_fill"><a href="" target="_blank">領収書PDF</a></p>
              </div>
            </div>
          </li>
          <li>
            <div class="cards_mypage-delivery-summary c-bg-b_1">
              <a href="">
                <h2 class="cards_mypage-delivery-heading">
                  <span class="c-cl-f_1">2018年9・10月のギフト</span>
                  母と娘２行の時２行の時２行の時母と娘
                </h2>
                <p class="cards_mypage-delivery-schedule">（2月下旬のお届け）</p>
              </a>
            </div>
            <div class="cards_mypage-delivery-status">
              <h3 class="cards_mypage-delivery-status-heading">発送前</h3>
              <p class="cards_mypage-delivery-status-text">詳しくはメールでご案内しておりますので、support@sheishere.jpからのメールをご確認ください。</p>
              <div class="cards_mypage-delivery-button">
                <p class="button_fill"><a href="" target="_blank">領収書PDF</a></p>
              </div>
            </div>
          </li>
          */?>
        </ul>
        <p class="button_fill"><a href="<?php echo home_url('members/');?>">マイページトップに戻る</a></p>
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
      <li class="is-current">配達状況一覧</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>