<?php /* Smarty version Smarty-3.1.19, created on 2014-10-06 23:09:12
         compiled from ".\templates\portal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15854543304f8604da6-25097191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4253afb3894b7a9902785d07106d7d3552e79145' => 
    array (
      0 => '.\\templates\\portal.tpl',
      1 => 1412068199,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1412065672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15854543304f8604da6-25097191',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_543304f8a51545_39953171',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543304f8a51545_39953171')) {function content_543304f8a51545_39953171($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>




Herzlich willkommen.<br>
<a href="logout.php">ausloggen</a>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
