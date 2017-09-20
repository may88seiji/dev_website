<?php
/* Template Name: FAQ */

the_post();

$sections = array(
                  'section_01' => 'Members登録・Members情報の<br />変更について',
                  'section_02' => '注文内容・注文状況の確認について',
                  'section_03' => '自動継続・お支払いについて',
                  'section_04' => '商品の配送について',
                  'section_05' => 'その他',
                  );

get_template_part('partial/head');?>

<div class="l-container page-faq">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary"><?php the_title();?></h1>

        <ul class="pageScroll">
          <?php foreach($sections as $key => $label):?><li><a href="#<?php echo $key?>"><p><?php echo $label?></p></a></li><?php endforeach;?>
        </ul>

        <?php foreach($sections as $key => $label):?><section id="<?php echo $key?>" class="wrap-accordion js-pageScroll">
          <h1><?php echo strip_tags($label)?></h1>
          <?php if($faq = get_field($key)):?><dl class="accordion">
            <?php foreach($faq as $value):?>
              <dt class="js-accordion"><?php echo $value['question']?><i></i></dt>
              <dd>
                <div class="accordion-inner"><?php echo $value['answer']?></div>
              </dd>
            <?php endforeach;?>
          </dl><?php endif;?>
        </section><?php endforeach;?>

      </section>
    </div>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">よくあるご質問</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>