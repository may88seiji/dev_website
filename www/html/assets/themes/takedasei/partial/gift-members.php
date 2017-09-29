<?php global $feature;?>
<section class="l-section gift-members js-scrollPos">
  <h1 class="heading_section_secondary">WHAT'S MEMBERS?</h1>
  <p class="text_headingDescription">Membersってなに？</p>
  <p class="text_headingDescription_secondary">"She is"は参加型のコミュニティです。<br />毎月3,500円でご登録いただいたMembersの方には<br />日々を祝福するギフトをお届けしたり、<br class="pc-hide" />イベントの優待や限定記事、メールマガジンなど<br />"She is"とのかかわりあいが増えてゆきます。<br />私たちと"She is"をつくってみませんか？</p>

  <?php get_template_part('partial/card-members');?>

  <p class="button_line c-bg-b_<?php the_field('color', $feature)?>"><a href="<?php echo home_url('registration');?>" onClick="<?php echo ga_event_script('cv', 'pre-gift-2');?>">毎月3,500円で<br>Membersに登録する</a></p>
</section>