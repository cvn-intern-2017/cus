{assign var=dataDecode value=$data|json_decode:true}
<div class="clean100"></div>
<div class="row">
  <div class="col s6 offset-s3">
    <div class="row">
      <div class="col s12">
        <div class="height_20px">
          <span class="pink-text" id='error_client'>{if isset($dataDecode.error)} {$dataDecode.error} {/if}</span>
        </div>
      </div>
    </div>
    <div class="row">
      <form class="col s12" action="" method="post" onsubmit="return check()">
        <div class="row">
          <div class="input-field col s9">
            <input  placeholder="Input your link here" type="text" class="validate" id="input_url" name="link">
          </div>
          <div class="input-field col s3">
            <input type="submit" class="waves-light btn" name="submit" value="Shorten URL"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
{if isset($dataDecode.original_link) && !(isset($dataDecode.error)) }
  {include file="Views/home/result.tpl"}
{/if}
