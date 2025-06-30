<?php
/* Smarty version 3.1.33, created on 2021-09-09 00:01:26
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/email-templates.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6139871693b8e6_80549676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b40a839ea35a0695da82acce832f1dfac2bc7c0' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/email-templates.tpl',
      1 => 1551365036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6139871693b8e6_80549676 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75951137161398716926928_24484886', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_75951137161398716926928_24484886 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_75951137161398716926928_24484886',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">

        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">


                <h2>
                    <?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Templates'];?>

                </h2>

            </div>
            <div class="mail-box" id="application_ajaxrender">

                <table class="table table-hover table-mail">
                    <tbody>


                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
?>
                        <tr class="read">

                            <td><a  class="ve" id="f<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" href="#"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['tplname']);?>
</a>  </td>
                            <td><a  class="ve" id="s<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['ds']->value['subject'];?>
</a></td>
                            <td class=""></td>
                            <td class="text-right">
                                <?php if ($_smarty_tpl->tpl_vars['ds']->value['send'] == 'Yes') {?>
                                    <span class="label label-success pull-right"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Active'];?>
 </span>
                                <?php } else { ?>
                                    <span class="label label-danger pull-right"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Inactive'];?>
 </span>
                                <?php }?>

                            </td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
<?php
}
}
/* {/block "content"} */
}
