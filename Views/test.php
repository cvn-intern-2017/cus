

  <div class="container">
    <div class="clean100"></div>
		<div class="row">
			<div class="col s6 offset-s3">
        <div class="row">
          <form class="col s12" action="index.php" method="post">
            <div class="row">
              <div class="input-field col s9">
                <input name="link" placeholder="Nhập link cần rút gọn" type="text" class="validate" id="input_url">
              </div>
              <div class="input-field col s3">
                <input type="submit" data-target="modal1" class="waves-effect waves-light btn-large btn" value="Shorten URL" onclick="check()"/>
              </div>
            </div>

          </form>
          <?php echo isset($new_link)?$new_link:'';?>
        </div>
		  </div>
    </div>


		<div id="modal1" class="modal" style="width:40%">
      <div class="modal-content">
        <span>Shorten URL:</span>&nbsp;&nbsp;&nbsp;
        <code style="background:#DDD; height:50px;"> </code>
      </div>
      <div class="modal-footer">
        <a href="https://goo.gl/#analytics/goo.gl/gwZsEL/all_time" target="_blank" class="waves-effect waves-green btn-flat">Analytics</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat">Done</a>
      </div>
    </div>
	</div>
