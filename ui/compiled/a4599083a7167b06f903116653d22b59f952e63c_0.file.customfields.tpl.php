<?php
/* Smarty version 3.1.33, created on 2021-09-09 10:12:45
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/customfields.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_613990c5cf1590_75956279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4599083a7167b06f903116653d22b59f952e63c' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/customfields.tpl',
      1 => 1551365036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_613990c5cf1590_75956279 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_535889234613990c5ca1090_45047407', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_535889234613990c5ca1090_45047407 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_535889234613990c5ca1090_45047407',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">


        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Custom Fields'];?>
</h5>

                </div>
                <div class="ibox-content" id="application_ajaxrender">

                    <form class="form-horizontal" id="rform">

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cf']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['fieldname'];?>
</label>
                                <?php if (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'text') {?>

                                    <div class="col-lg-4">
                                        <input type="text" id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'password') {?>

                                    <div class="col-lg-4">
                                        <input type="password" id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'dropdown') {?>
                                    <div class="col-lg-4">
                                        <select id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, explode(',',$_smarty_tpl->tpl_vars['c']->value['fieldoptions']), 'fo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fo']->value) {
?>
                                                <option><?php echo $_smarty_tpl->tpl_vars['fo']->value;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>


                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'textarea') {?>

                                    <div class="col-lg-4">
                                        <textarea id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control" rows="3"></textarea>
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } else { ?>

                                <?php }?>
                                <div class="col-lg-4"><a href="#" class="btn btn-primary sys_edit" id="f<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>

                                    <a href="#" class="btn btn-danger cdelete" id="d<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>


                                </div>
                            </div>
                            <?php
}
} else {
?>

                            <h4 class="muted text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Custom Fields Not Available'];?>
</h4>

                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <p class=" text-center"><a href="" class="btn btn-outline btn-success sys_add"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Custom Field'];?>
</a></p>


                    </form>

                </div>
            </div>



        </div>


    </div>


    <input type="hidden" id="_lan_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">


<?php
}
}
/* {/block "content"} */
}
