<?php /* Smarty version Smarty-3.1.19, created on 2014-10-08 02:46:25
         compiled from ".\templates\registrateUser.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1186454348961d3e818-97785574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dce77f9d0ae9443dae75a203ff8706ecc280ae25' => 
    array (
      0 => '.\\templates\\registrateUser.tpl',
      1 => 1412674397,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1412065672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1186454348961d3e818-97785574',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54348961e4a903_03986552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54348961e4a903_03986552')) {function content_54348961e4a903_03986552($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>




<form action="login.php" method="GET">
    <input type="email" name="email" value="Ihre E-Mail-Adresse">
    <input type="password" name="password" value="Passwort">
    <input type="submit" value="registrieren">
</FORM>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
