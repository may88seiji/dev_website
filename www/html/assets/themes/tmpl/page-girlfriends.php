<?php
$girlfriends = get_terms('girlfriend', array('hide_empty' => false));
get_template_part('partial/head');
?>
<div class="l-container page-list_girlfriends">
  <div class="l-billboard">
    <h1 class="heading_billboard">GIRLFRIENDS</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <p class="text_section_description">"She is"は、<br class="pc-hide" />さまざまな仲間（Girlfriends）たちと、<br class="pc-hide" />場所をつくっています。</p>
        <p class="button_fill"><a href="<?php echo home_url('about/');?>">Girlfriendsって？</a></p>

        <?php if($girlfriends):?><ul class="list_octagon js-matchHeight">
          <?php foreach($girlfriends as $girlfriend):?><li>
            <a href="<?php echo get_term_link($girlfriend);?>">
              <?php if($img = get_field('image', $girlfriend)):?><div class="list_octagon-img">
                <svg><image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $img['sizes']['si-square-xsmall']?>" width="100%" height="100%"></image></svg>
              </div><?php endif;?>
              <p class="list-octagon-text"><?php echo $girlfriend->name?></p>
            </a>
          </li><?php endforeach;?>
        </ul><?php endif;?>
      </section>
    </div>
  </div>

  <div class="l-aside">
    <?php get_template_part('partial/latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">GIRLFRIENDS</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>