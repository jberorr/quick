<?php
/* Smarty version 3.1.33, created on 2023-05-01 13:56:55
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/ajax.contact-summary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_644f77cfafef83_69628949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7e53df48c0dd6ad90efea660c96bd3219b3460b' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/ajax.contact-summary.tpl',
      1 => 1677483173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_644f77cfafef83_69628949 (Smarty_Internal_Template $_smarty_tpl) {
?>
<p>

    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Full Name'];?>
: </strong> <?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>
 <br>
   <?php if (($_smarty_tpl->tpl_vars['d']->value['company']) != '') {?>
       <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Company Name'];?>
: </strong> <?php echo $_smarty_tpl->tpl_vars['d']->value['company'];?>
 <br>
   <?php }?>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['email']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['phone']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['phone'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Address'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['address']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['address'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['City'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['city']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['city'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['State Region'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['state']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['state'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['ZIP Postal Code'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['zip']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['zip'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Country'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['country']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['country'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Tags'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['tags']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['tags'];?>
 <?php } else { ?> N/A <?php }?> <br>
    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Group'];?>
: </strong> <?php if (($_smarty_tpl->tpl_vars['d']->value['gname']) != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['gname'];?>
 <?php } else { ?> N/A <?php }?> <br>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cf']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>

        <strong><?php echo $_smarty_tpl->tpl_vars['c']->value['fieldname'];?>
: </strong> <?php if (get_custom_field_value($_smarty_tpl->tpl_vars['c']->value['id'],$_smarty_tpl->tpl_vars['d']->value['id']) != '') {?> <?php echo get_custom_field_value($_smarty_tpl->tpl_vars['c']->value['id'],$_smarty_tpl->tpl_vars['d']->value['id']);?>
 <?php } else { ?> N/A <?php }?> <br>

    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</p>

<hr>

<?php if ($_smarty_tpl->tpl_vars['d']->value->autologin != '') {?>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <div class="col-xs-12">
                <div class="form-material floating open">
                    <input class="form-control" type="text" id="auto_login_url" name="auto_login_url" value="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/autologin/<?php echo $_smarty_tpl->tpl_vars['d']->value->autologin;?>
">
                    <label for="auto_login_url"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Auto Login URL'];?>
</label>
                </div>
                <p class="help-block">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/autologin/<?php echo $_smarty_tpl->tpl_vars['d']->value->autologin;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Login As Customer'];?>
</a> |
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/revoke_auto_login/<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Revoke Auto Login'];?>
</a> |
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/gen_auto_login/<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Re Generate URL'];?>
</a>
                </p>
            </div>
        </div>

    </form>

    <?php } else { ?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/gen_auto_login/<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
/" class="md-btn md-btn-primary"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Create Auto Login URL'];?>
</a>
<?php }?>

<hr>

<?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'reports')) {?>
    <table class="table table-hover margin bottom invoice-total">
        <thead>
        <tr>

            <th colspan="3"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Accounting Summary'];?>
</th>

        </tr>
        </thead>
        <tbody>
        <tr>

            <td> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Income'];?>

            </td>
            <td class="text-center"><span class="label label-primary amount" data-a-dec="<?php echo $_smarty_tpl->tpl_vars['_c']->value['dec_point'];?>
" data-a-sep="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousands_sep'];?>
" data-a-pad="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_decimal_digits'];?>
" data-p-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_symbol_position'];?>
" data-a-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 " data-d-group="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousand_separator_placement'];?>
"><?php echo $_smarty_tpl->tpl_vars['ti']->value;?>
</span></td>

        </tr>
        <tr>

            <td> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Expense'];?>

            </td>
            <td class="text-center"><span class="label label-danger amount" data-a-dec="<?php echo $_smarty_tpl->tpl_vars['_c']->value['dec_point'];?>
" data-a-sep="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousands_sep'];?>
" data-a-pad="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_decimal_digits'];?>
" data-p-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_symbol_position'];?>
" data-a-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 " data-d-group="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousand_separator_placement'];?>
"><?php echo $_smarty_tpl->tpl_vars['te']->value;?>
</span></td>


        </tr>



        </tbody>
    </table>

    <table class="table invoice-total">
        <tbody>

        <tr>
            <td><strong><?php echo $_smarty_tpl->tpl_vars['happened']->value;?>
 :</strong></td>
            <td><strong><span class="label label-<?php echo $_smarty_tpl->tpl_vars['css_class']->value;?>
 amount" data-a-dec="<?php echo $_smarty_tpl->tpl_vars['_c']->value['dec_point'];?>
" data-a-sep="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousands_sep'];?>
" data-a-pad="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_decimal_digits'];?>
" data-p-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_symbol_position'];?>
" data-a-sign="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 " data-d-group="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousand_separator_placement'];?>
" style="font-size: 11px;"><?php echo $_smarty_tpl->tpl_vars['d_amount']->value;?>
</span></strong></td>
        </tr>
        </tbody>
    </table>
<?php }?>

<?php }
}
