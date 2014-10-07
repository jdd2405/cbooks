<?php /* Smarty version Smarty-3.1.19, created on 2014-10-06 23:10:17
         compiled from ".\templates\logout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1052454330539d0a407-46893425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fed2de3a84e454734e519ed9de686848cab336e3' => 
    array (
      0 => '.\\templates\\logout.tpl',
      1 => 1412068137,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1412065672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1052454330539d0a407-46893425',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54330539d7d6a1_28170637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54330539d7d6a1_28170637')) {function content_54330539d7d6a1_28170637($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>




    Sie wurden ausgeloggt.<br>
<a href="index.php">Startseite</a>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
