<?php
/* Smarty version 3.1.30, created on 2017-07-26 06:01:08
  from "C:\xampp\htdocs\cus\Views\home\home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59781404360b97_60196985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '217b69743087c0db59ea5bec756cbd75cc285c3f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\home\\home.tpl',
      1 => 1501041665,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Views/home/result.tpl' => 1,
  ),
),false)) {
function content_59781404360b97_60196985 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="clean100"></div>
<div class="row">
  <div class="col s6 offset-s3">
    <div class="row">
      <form class="col s12" action="" method="post">
        <div class="row">
          <div class="input-field col s9">
            <input placeholder="Input your link here" type="text" class="validate" id="input_url" name="link">
          </div>
          <div class="input-field col s3">
            <input type="submit" class="waves-effect waves-light btn-large btn" onclick="check()" value="Shorten URL"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?>
  <?php $_smarty_tpl->_subTemplateRender("file:Views/home/result.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
}
