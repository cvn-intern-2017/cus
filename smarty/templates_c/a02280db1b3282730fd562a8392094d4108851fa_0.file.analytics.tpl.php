<?php
/* Smarty version 3.1.30, created on 2017-07-24 09:49:16
  from "C:\xampp\htdocs\cus\Views\analytics\analytics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5975a67c8d0498_04852177',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a02280db1b3282730fd562a8392094d4108851fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\analytics\\analytics.tpl',
      1 => 1500882555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5975a67c8d0498_04852177 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="maintenance">
      <h1>Analytics Page</h1>
      <p>Created Date: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['created_time'];?>
</b></p>
      <p>Original URL: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['original_link'];?>
</b></p>
      <p>Total Clicks: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['total_click'];?>
</b></p>
      <p>Chrome: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['gg_click'];?>
</b></p>
      <p>Firefox: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['ff_click'];?>
</b></p>
      <p>Others: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['other_click'];?>
</b></p>
</div>
<?php }
}
