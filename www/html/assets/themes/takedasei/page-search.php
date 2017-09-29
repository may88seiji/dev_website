<?php get_template_part('partial/head');?>
<div class="l-container page-search">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">検索結果</h1>
        <div class="search-gcs">
          <script>
            (function() {
              var cx = '007771108752503831979:n5ml9prxabc';
              var gcse = document.createElement('script');
              gcse.type = 'text/javascript';
              gcse.async = true;
              gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(gcse, s);
            })();
          </script>
          <gcse:search></gcse:search>
        </div>
      </section>
    </div>
  </div>


</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">検索結果</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>