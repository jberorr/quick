<?php
/* Smarty version 3.1.33, created on 2021-09-09 00:35:55
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/list-tax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61398f2b59c746_02360705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8dfeb2314731a92a2603d03dc96918d5125fa728' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/list-tax.tpl',
      1 => 1551365036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61398f2b59c746_02360705 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_141736912361398f2b48e971_67648025', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_141736912361398f2b48e971_67648025 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_141736912361398f2b48e971_67648025',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales Taxes'];?>
 </h5>
        </div>
        <div class="ibox-content">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/add-tax/" id="item_add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Tax'];?>
 </a>
            <table class="table table-bordered table-hover sys_table">
                <thead>
                <tr>
                    <th width="70%"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</th>
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Tax Rate'];?>
</th>

                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
?>
                    <tr id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                        <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['name'];?>
</td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['ib_money_format_apply']->value) {?>
                                <?php echo ib_money_format($_smarty_tpl->tpl_vars['ds']->value['rate'],$_smarty_tpl->tpl_vars['_c']->value);?>

                            <?php } else { ?>
                                <?php echo $_smarty_tpl->tpl_vars['ds']->value['rate']+0;?>

                            <?php }?>

                        </td>
                        <td>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/edit-tax/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-info btn-xs edit"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
 </a>
                            <button type="button" id="t<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-danger btn-xs cdelete"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
 </button>
                        </td>

                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

        </div>
    </div>
    <input type="hidden" id="_lan_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">


<?php
}
}
/* {/block "content"} */
}
