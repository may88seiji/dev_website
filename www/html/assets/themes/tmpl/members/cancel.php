<?php get_template_part('partial/head');?>

<div class="l-container page-mypage">
  <div class="l-billboard">
    <h1 class="heading_billboard">解約手続き</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <div class="mypage-description_cancellation">
          <p class="text_letter">解約すると、下記のすべてがご利用できなくなります。</p>
          <p class="text_letter">※すでに決済が完了しているギフトについては取り消しを行うことができません。必ず「配達状況」をご確認ください。</p>
          <ul class="list_memberPrivilege_horizontal">
            <li>ギフトが届く</li>
            <li>イベントの<br />優待が受けられる</li>
            <li>Members限定記事が<br />読める</li>
            <li>メールマガジンが<br />受け取れる</li>
          </ul>
        </div>

        <p class="heading_mypage_cancellation">
          より良いサービスを提供するために、<br />
          アンケートにご協力ください。</p>

        <div class="l-form">
          <dl class="form-item">
            <dt class="heading_formTitle">解約理由について教えてください<span>＊</span></dt>
            <dd>
              <div class="form-item-wrap js-radioToNext">
                <div class="form-item_radio_block"><input type="radio" name="gender" value="ギフトの内容に不満があったから" /><label>ギフトの内容に不満があったから</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="イベントの内容に不満があったから" /><label>イベントの内容に不満があったから</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="Members限定記事に不満があったから" /><label>Members限定記事に不満があったから</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="サポートがよくなかったから" /><label>サポートがよくなかったから</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="料金が高いから" /><label>料金が高いから</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="一時的に解約し、再度登録を予定している" /><label>一時的に解約し、再度登録を予定している</label></div>
                <div class="form-item_radio_block"><input type="radio" name="gender" value="興味がなくなったから" /><label>興味がなくなったから</label></div>
              </div>
            </dd>
          </dl>

          <dl class="form-item">
            <dt class="heading_formTitle">その他、ご意見がございましたらお書きください</dt>
            <dd>
              <div class="form-item-wrap">
                <textarea class="form-item_textarea" placeholder="入力してください"></textarea>
              </div>
            </dd>
          </dl>
        </div>

        <div class="pager_simple-wrap">
          <div class="pager_simple">
            <a href="#" class="button_back">BACK</a>
            <div class="button_next-wrap js-button_next-wrap is-disabled">
              <input type="submit" class="button_next is-disabled js-button_next" value=確認する>
            </div>
          </div>
        </div>
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
      <li class="is-current">解約手続き</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>