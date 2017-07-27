<?php
/* Smarty version 3.1.30, created on 2017-07-27 04:43:53
  from "E:\installed\xampp\htdocs\cus\Views\home\result.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59795369be2564_51832366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73a23e25e3e58083d003b9b2575b0518e093d273' => 
    array (
      0 => 'E:\\installed\\xampp\\htdocs\\cus\\Views\\home\\result.tpl',
      1 => 1501123428,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59795369be2564_51832366 (Smarty_Internal_Template $_smarty_tpl) {
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
          <td><?php echo $_smarty_tpl->tpl_vars['data']->value->original_link;?>
</td>
          <td><a target="_blank" href="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'DOMAIN');
echo $_smarty_tpl->tpl_vars['data']->value->key_url;?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'DOMAIN');
echo $_smarty_tpl->tpl_vars['data']->value->key_url;?>
</a></td>
          <td class="centered"><a target="_blank" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php }
}
