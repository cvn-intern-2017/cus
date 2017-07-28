<?php
/* Smarty version 3.1.30, created on 2017-07-28 08:37:24
  from "C:\xampp\htdocs\cus\Views\home\home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_597adba4d91e17_91026379',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '217b69743087c0db59ea5bec756cbd75cc285c3f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\home\\home.tpl',
      1 => 1501223839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Views/home/result.tpl' => 1,
  ),
),false)) {
function content_597adba4d91e17_91026379 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="clean100"></div>
<div class="row">
  <div class="col s6 offset-s3">
    <div class="row">
      <div class="col s12">
        <div class="height_20px">
          <span class="pink-text" id='error_client'></span>
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
            <input type="submit" class="waves-light btn" value="Shorten URL"/>
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
