<?php /* Template Name: FLAT */?>
<?php the_post(); get_template_part('partial/head');?>
<div class="l-container page-note">
  <div class="l-billboard">
    <h1 class="heading_billboard"><?php the_title();?></h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <div class="section-content">
          <div class="wysiwyg">
            <?php the_content();?>
          </div>
        </div>

      </section>
    </div>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current"><?php the_title();?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>