<?php
/* Smarty version 3.1.33, created on 2023-05-27 19:06:21
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/pg-conf.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6472075524c346_54429541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39465a6d49658aa450f023c6c8a95ee063e73bb8' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/pg-conf.tpl',
      1 => 1677483173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6472075524c346_54429541 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_35883796664720755233233_00943687', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_35883796664720755233233_00943687 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_35883796664720755233233_00943687',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-<?php if ($_smarty_tpl->tpl_vars['extra_panel']->value == '') {?>12<?php } else { ?>6<?php }?>">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="pg-conf" role="form">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
">
                            </div>
                        </div>

                                                                                                                                                
                        <div class="form-group">
                            <label for="value" class="col-sm-3 control-label">


                                <?php echo $_smarty_tpl->tpl_vars['label']->value['value'];?>




                            </label>
                            <div class="col-sm-9">



                                <?php echo $_smarty_tpl->tpl_vars['input']->value['value'];?>

                                <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['value']) != '') {?>
                                    <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['value'];?>
</span>
                                <?php }?>
                            </div>
                        </div>





                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c1']) != '') {?>
                            <div class="form-group">
                                <label for="c1" class="col-sm-3 control-label"> <?php echo $_smarty_tpl->tpl_vars['label']->value['c1'];?>
 </label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c1'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c1']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c1'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>

                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c2']) != '') {?>

                            <div class="form-group">
                                <label for="c2" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c2'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c2'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c2']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c2'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>


                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c3']) != '') {?>

                            <div class="form-group">
                                <label for="c3" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c3'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c3'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c3']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c3'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>



                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c4']) != '') {?>

                            <div class="form-group">
                                <label for="c4" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c4'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c4'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c4']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c4'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>



                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c5']) != '') {?>
                            <div class="form-group">
                                <label for="c5" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c5'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c5'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c5']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c5'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Active') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Active'];?>
</option>
                                    <option value="Inactive" <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Inactive') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Inactive'];?>
</option>

                                </select>



                            </div>
                        </div>


                        <?php if (($_smarty_tpl->tpl_vars['label']->value['mode'])) {?>

                            <div class="form-group">
                                <label for="mode" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Mode'];?>
</label>
                                <div class="col-sm-9">
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="Live" <?php if ($_smarty_tpl->tpl_vars['d']->value['mode'] == 'Live') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Live'];?>
</option>
                                        <option value="Sandbox" <?php if ($_smarty_tpl->tpl_vars['d']->value['mode'] == 'Sandbox') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sandbox'];?>
</option>

                                    </select>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['mode']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['mode'];?>
</span>
                                    <?php }?>

                                </div>
                            </div>

                        <?php }?>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="pgid" id="pgid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                                | <?php echo $_smarty_tpl->tpl_vars['_L']->value['Or'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/pg/"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Back To The List'];?>
</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>


        <?php if ($_smarty_tpl->tpl_vars['extra_panel']->value != '') {?>
            <div class="col-md-6">
                <?php echo $_smarty_tpl->tpl_vars['extra_panel']->value;?>

            </div>
        <?php }?>

    </div>




<?php
}
}
/* {/block "content"} */
}
