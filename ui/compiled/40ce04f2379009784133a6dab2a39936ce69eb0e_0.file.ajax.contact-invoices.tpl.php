<?php
/* Smarty version 3.1.33, created on 2023-05-01 13:57:18
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/ajax.contact-invoices.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_644f77e63ce630_89826414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40ce04f2379009784133a6dab2a39936ce69eb0e' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/ajax.contact-invoices.tpl',
      1 => 1677483173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644f77e63ce630_89826414 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/add/1/<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
/" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['New Invoice'];?>
</a>

<hr>

<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Date'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Due Date'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
</th>
        <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
    </tr>
    </thead>
    <tbody>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['i']->value, 'is');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['is']->value) {
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['is']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['is']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['is']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['is']->value['id'];?>
 <?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['is']->value['account'];?>
</td>
            <td class="amount" data-a-dec="<?php echo $_smarty_tpl->tpl_vars['_c']->value['dec_point'];?>
" data-a-sep="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousands_sep'];?>
" data-a-pad="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_decimal_digits'];?>
" data-p-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_symbol_position'];?>
" data-a-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 " data-d-group="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousand_separator_placement'];?>
"><?php echo $_smarty_tpl->tpl_vars['is']->value['total'];?>
</td>
            <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['is']->value['date']));?>
</td>
            <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['is']->value['duedate']));?>
</td>
            <td><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['is']->value['status']);?>
</td>
            <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/view/<?php echo $_smarty_tpl->tpl_vars['is']->value['id'];?>
/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['View'];?>
</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/edit/<?php echo $_smarty_tpl->tpl_vars['is']->value['id'];?>
/" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>
            </td>
        </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </tbody>
</table><?php }
}
