<?php
/* Smarty version 3.1.30, created on 2017-07-24 09:42:20
  from "C:\xampp\htdocs\cus\smarty\templates\master_layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5975a4dc1c6b28_36904707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca2cb0d13cb9eafa9afed1a229d17bdb0ba4d4d2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\smarty\\templates\\master_layout.tpl',
      1 => 1500882101,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:navigation.tpl' => 1,
    'file:main.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5975a4dc1c6b28_36904707 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
  <?php $_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <body>
    <?php $_smarty_tpl->_subTemplateRender("file:navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
    <?php $_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  </body>
</html>
<?php }
}
