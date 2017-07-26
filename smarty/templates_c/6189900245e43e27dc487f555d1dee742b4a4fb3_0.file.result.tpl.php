<?php
/* Smarty version 3.1.30, created on 2017-07-25 11:18:43
  from "C:\xampp\htdocs\cus\Views\home\result.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59770cf354ad63_74014718',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6189900245e43e27dc487f555d1dee742b4a4fb3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\home\\result.tpl',
      1 => 1500974320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59770cf354ad63_74014718 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="row">
  <div class="col s12">
    <div class="clean100"></div>
    <table>
      <thead>
        <tr>
          <th>Original Link</th>
          <th>Shorten Link</th>
          <th>Analytics Data</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['data']->value['originalLinkDisplayed'];?>
</td>
          <td><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['newLink'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['newLink'];?>
</a></td>
          <td class="centered"><a target="_blank" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php }
}
