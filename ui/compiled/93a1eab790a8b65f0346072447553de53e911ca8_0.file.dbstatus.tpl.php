<?php
/* Smarty version 3.1.33, created on 2021-09-09 11:12:12
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/dbstatus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61399eb413c4e0_02311205',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93a1eab790a8b65f0346072447553de53e911ca8' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/dbstatus.tpl',
      1 => 1551365038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61399eb413c4e0_02311205 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132676686561399eb40f8816_68284723', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_132676686561399eb40f8816_68284723 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_132676686561399eb40f8816_68284723',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Database Size'];?>
: <?php echo $_smarty_tpl->tpl_vars['dbsize']->value;?>
  MB </h5>
            <div class="ibox-tools">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/dbbackup/" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Download Database Backup'];?>
</a>
            </div>
        </div>
        <div class="ibox-content">

            <table class="table table-bordered table-hover sys_table">
                <thead>
                <tr>
                    <th width="50%"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Table Name'];?>
</th>
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Rows'];?>
</th>
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Size'];?>
</th>

                </tr>
                </thead>
                <tbody>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tables']->value, 'tbl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['tbl']->value) {
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['tbl']->value['name'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['tbl']->value['rows'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['tbl']->value['size'];?>
 Kb</td>

                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                </tbody>
            </table>

        </div>
    </div>


<?php
}
}
/* {/block "content"} */
}
