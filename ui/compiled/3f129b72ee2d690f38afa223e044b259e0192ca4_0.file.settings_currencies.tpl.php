<?php
/* Smarty version 3.1.33, created on 2021-09-09 00:00:05
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/settings_currencies.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_613986c516da01_43277985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f129b72ee2d690f38afa223e044b259e0192ca4' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/settings_currencies.tpl',
      1 => 1551365036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_613986c516da01_43277985 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1168278818613986c5070bf7_48605147', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_1168278818613986c5070bf7_48605147 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1168278818613986c5070bf7_48605147',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="#" class="btn btn-primary" id="add_currency"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['New Currency'];?>
</a>


                </div>

            </div>
        </div>



    </div>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Currency Code'];?>
</th>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Currency Symbol'];?>
</th>
                                <th class="text-center bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'currency');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
?>
                                <tr data-id="<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
">
                                    <td> <a class="cedit" id="ae<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['currency']->value['cname'];?>
</a>
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['home_currency'] == $_smarty_tpl->tpl_vars['currency']->value['cname']) {?>
                                            <br>
                                            <?php echo $_smarty_tpl->tpl_vars['_L']->value['Base Currency'];?>

                                        <?php }?>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['currency']->value['symbol'];?>
</td>
                                    <td class="text-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
" id="be<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
" class="btn btn-inverse btn-xs cedit" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
"><i class="fa fa-pencil"></i> </a>
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['home_currency'] != $_smarty_tpl->tpl_vars['currency']->value['cname']) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/make_base_currency/<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
/" class="btn btn-primary btn-xs" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Make Base Currency'];?>
"><i class="fa fa-star"></i> </a>
                                        <?php }?>

                                        <a href="#" class="btn btn-danger btn-xs cdelete" id="c<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
"><i class="fa fa-trash"></i> </a>
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
        </div>



    </div>

<?php
}
}
/* {/block "content"} */
}
