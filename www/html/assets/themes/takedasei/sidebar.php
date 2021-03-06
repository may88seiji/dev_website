<?php 
$pt = get_post_type( $post );;
?>

<div class="side-navi">
  <div class="side-navi-inner">
    <h1 class="side-logo"><a href="/">Takeda Sei</a></h1>
    <ul class="side-navi-main">
      <li class="<?php if ( is_home() ) { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>">home</a></li>
      <li class="<?php if ( is_page('about') ) { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/about">about</a></li>
      <li class="<?php if ( $pt == 'news') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/news">news</a></li>
      <li class="<?php if ( $pt == 'works') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/works">works</a></li>
      <li class="<?php if ( $pt == 'blog') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/blog">blog</a></li>
      <li><a href="mailto:takedasei.ishere@gmail.com">contact</a></li>
    </ul>
  </div>
</div>
<div class="side-utility">
  <ul class="side-utility-sns">
    <li><a href="https://twitter.com/takedaseiishere"><i class="icon-twitter"></i></a></li>
    <li><a href="https://www.instagram.com/takedasei.ishere/?hl=ja"><i class="icon-instagram"></i></a></li>
    <li><a href='https://feedly.com/i/subscription/feed%2Fhttp%3A%2F%2Ftakedasei.com%2Ffeed%2F%3Fpost_type%3Dblog'  target='blank'><img id='feedlyFollow' src='http://s3.feedly.com/img/follows/feedly-follow-logo-black_2x.png' alt='follow us in feedly' width='14' height='14'></a></li>
  </ul>
</div>