<?php
/* Smarty version 3.1.30, created on 2017-07-27 09:44:13
  from "C:\xampp\htdocs\cus\smarty\templates\main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_597999cd547720_45656999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0be3c85dbbe5d35005a357940bde89e996093db4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\smarty\\templates\\main.tpl',
      1 => 1500963241,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597999cd547720_45656999 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
	<?php if (isset($_smarty_tpl->tpl_vars['view']->value)) {?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['view']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	<?php }?>
</div>
<?php }
}
