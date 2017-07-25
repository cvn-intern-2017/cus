<?php
/* Smarty version 3.1.30, created on 2017-07-25 03:25:30
  from "C:\xampp\htdocs\cus\Views\analytics\analytics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59769e0abbead4_76585245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a02280db1b3282730fd562a8392094d4108851fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\analytics\\analytics.tpl',
      1 => 1500945874,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59769e0abbead4_76585245 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>
.analystic_page{
  padding-top: 2%;
  color: #888;
  display: table;
  font-family: sans-serif;
  height: 100%;
  width: 100%;
}
</style>

<div class="analystic_page">
      <h4>Analytics Data for <a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['short_link'];?>
</a></h4>
      <p>Created Date: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['created_time'];?>
</b></p>
      <p>Original URL: <b><a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['original_link'];?>
</a></b></p>
      <p>Total Clicks: <b><?php echo $_smarty_tpl->tpl_vars['data']->value['total_click'];?>
</b></p>
</div>

<!--



      <p>Chrome: <b><?php if (isset($_smarty_tpl->tpl_vars['data']->value['gg_click'])) {
echo $_smarty_tpl->tpl_vars['data']->value['gg_click'];
}?></b></p>
      <p>Firefox: <b><?php if (isset($_smarty_tpl->tpl_vars['data']->value['ff_click'])) {
echo $_smarty_tpl->tpl_vars['data']->value['ff_click'];
}?></b></p>
      <p>Others: <b><?php if (isset($_smarty_tpl->tpl_vars['data']->value['other_click'])) {
echo $_smarty_tpl->tpl_vars['data']->value['other_click'];
}?></b></p>
-->
<?php }
}
