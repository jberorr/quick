<?php
/* Smarty version 3.1.33, created on 2021-09-08 23:51:09
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/appearance_user_interface.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_613984add94208_09058955',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9178de5b327ffbb5a575b2257cc2cb74fcec8ec9' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/appearance_user_interface.tpl',
      1 => 1551365036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_613984add94208_09058955 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1778987011613984add72ff4_79405220', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_1778987011613984add72ff4_79405220 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1778987011613984add72ff4_79405220',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins" id="ui_settings">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['User Interface'];?>
</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <tr>
                            <td width="80%"><label for="config_animate"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Enable Page Loading Animation'];?>
 </label></td>
                            <td><input type="checkbox" <?php if (get_option('animate') == '1') {?>checked<?php }?> data-toggle="toggle"
                                       data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
" id="config_animate">
                            </td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_rtl"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Enable RTL'];?>
 </label></td>
                            <td><input type="checkbox" <?php if (get_option('rtl') == '1') {?>checked<?php }?> data-toggle="toggle"
                                       data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
" id="config_rtl"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_mininav"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Fold Sidebar Default'];?>
 </label></td>
                            <td><input type="checkbox" <?php if (get_option('mininav') == '1') {?>checked<?php }?> data-toggle="toggle"
                                       data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
" id="config_mininav">
                            </td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_hide_footer"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Hide Footer Copyright'];?>
 </label></td>
                            <td><input type="checkbox" <?php if (get_option('hide_footer') == '1') {?>checked<?php }?>
                                       data-toggle="toggle" data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
"
                                       id="config_hide_footer"></td>
                        </tr>


                        </tbody>
                    </table>

                    <hr>

                    <div class="form-group">
                        <label for="contentAnimation"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Content Animation'];?>
</label>
                        <select name="contentAnimation" id="contentAnimation" class="form-control">

                            <option value="" <?php if ($_smarty_tpl->tpl_vars['_c']->value['contentAnimation'] == '') {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['None'];?>
</option>

                            <?php echo $_smarty_tpl->tpl_vars['ca_options']->value;?>


                        </select>
                    </div>


                    <div class="form-group">
                        <label for="contact_set_view_mode"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Customers View Mode'];?>
</label>
                        <select name="contact_set_view_mode" id="contact_set_view_mode" class="form-control">

                            <option value="tbl" <?php if ($_smarty_tpl->tpl_vars['_c']->value['contact_set_view_mode'] == 'tbl') {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Table'];?>
</option>
                            <option value="card" <?php if ($_smarty_tpl->tpl_vars['_c']->value['contact_set_view_mode'] == 'card') {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Card'];?>
</option>
                            <option value="search" <?php if ($_smarty_tpl->tpl_vars['_c']->value['contact_set_view_mode'] == 'search') {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Search'];?>
</option>



                        </select>
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
