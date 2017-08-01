<?php
/* Smarty version 3.1.30, created on 2017-08-01 04:07:51
  from "C:\xampp\htdocs\cus\Views\analytics\analytics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_597fe27770e5e1_47623801',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a02280db1b3282730fd562a8392094d4108851fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cus\\Views\\analytics\\analytics.tpl',
      1 => 1501552572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597fe27770e5e1_47623801 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
  <div class="col s12">
    <blockquote>
    <p><b>Creation time of the short URL: </b>2017-07-31 09:26:20</p>
    <p>
      <b>Original URL: </b>
      <a target="_blank" href="https://github.com/cvn-intern-2017/cus/wiki/Specification:-Feature-3---Chart">https://github.com/cvn-intern-2017/cus/wiki/Specification:-Feature-3---Chart</a>
    </p>
  </blockquote>
<!--    <table>
      <thead>
        <tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['alltime'], 'num', false, 'browser');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['browser']->value => $_smarty_tpl->tpl_vars['num']->value) {
?>
            <th>
              <?php echo $_smarty_tpl->tpl_vars['browser']->value;?>

            </th>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

          <th class="grey lighten-2 center-align">Total</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['alltime'], 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value) {
?>
              <td>
                <?php echo $_smarty_tpl->tpl_vars['num']->value;?>

              </td>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <td class="grey lighten-2 center-align"><?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
</td>
          </tr>
      </tbody>
    </table>-->
  </div>
</div>
<div style="font: 21px arial; padding: 10px 0 0 100px;">Bar Chart</div>
<div id="bar_chart" style="width: 900px; height: 300px;"></div>
<?php }
}
