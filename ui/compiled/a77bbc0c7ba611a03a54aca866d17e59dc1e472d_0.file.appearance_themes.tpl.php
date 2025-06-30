<?php
/* Smarty version 3.1.33, created on 2021-09-08 23:50:57
  from '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/appearance_themes.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_613984a16c4835_66123331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a77bbc0c7ba611a03a54aca866d17e59dc1e472d' => 
    array (
      0 => '/home/quickpcservice/public_html/quickpcservice.in/ui/theme/ibilling/appearance_themes.tpl',
      1 => 1551365038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_613984a16c4835_66123331 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_953634550613984a167c2e0_95539568', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/admin.tpl");
}
/* {block "content"} */
class Block_953634550613984a167c2e0_95539568 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_953634550613984a167c2e0_95539568',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Themes'];?>
</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
appearance/themes_post/">


                        <div class="form-group">
                            <label for="theme"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Theme'];?>
</label>
                            <select name="theme" id="theme" class="form-control">
                                
                                
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, (($tmp = @$_smarty_tpl->tpl_vars['themes']->value)===null||$tmp==='' ? array() : $tmp), 'theme');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['theme']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
"
                                            <?php if ($_smarty_tpl->tpl_vars['_c']->value['theme'] == $_smarty_tpl->tpl_vars['theme']->value) {?>selected="selected" <?php }?>><?php echo ucfirst($_smarty_tpl->tpl_vars['theme']->value);?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nstyle"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Style'];?>
</label>
                            <select name="nstyle" id="nstyle" class="form-control">
                                <option value="dark" <?php if ($_smarty_tpl->tpl_vars['_c']->value['nstyle'] == 'dark') {?>selected="selected" <?php }?>>Dark</option>
                                <option value="light" <?php if ($_smarty_tpl->tpl_vars['_c']->value['nstyle'] == 'light') {?>selected="selected" <?php }?>>Light</option>
                                <option value="blue" <?php if ($_smarty_tpl->tpl_vars['_c']->value['nstyle'] == 'blue') {?>selected="selected" <?php }?>>Blue</option>
                                <option value="dark_extra" <?php if ($_smarty_tpl->tpl_vars['_c']->value['nstyle'] == 'dark_extra') {?>selected="selected" <?php }?>>Dark extra</option>
                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                    </form>

                </div>
            </div>










        </div>




    </div>


<?php
}
}
/* {/block "content"} */
}
