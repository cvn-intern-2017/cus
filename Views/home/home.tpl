
<div class="clean100"></div>
<div class="row">
  <div class="col s6 offset-s3">
    <div class="row">
      <form class="col s12" action="" method="post">
        <div class="row">
          <div class="input-field col s9">
            <input placeholder="Nhập link cần rút gọn" type="text" class="validate" id="input_url" name="link">
          </div>
          <div class="input-field col s3">
            <input type="submit" class="waves-effect waves-light btn-large btn" onclick="check()" value="Shorten URL"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

{if isset($data)}
{include file="Views/home/result.tpl"}
{/if}
