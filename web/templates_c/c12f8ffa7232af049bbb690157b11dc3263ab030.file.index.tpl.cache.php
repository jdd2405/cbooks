<?php /* Smarty version Smarty-3.1.19, created on 2014-09-30 10:31:36
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77695425960f90d461-52234428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c12f8ffa7232af049bbb690157b11dc3263ab030' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1412065891,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1412065672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77695425960f90d461-52234428',
  'function' => 
  array (
  ),
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5425960f9e7359_54099901',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5425960f9e7359_54099901')) {function content_5425960f9e7359_54099901($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>



Session-ID: <?php echo $_smarty_tpl->tpl_vars['session_id']->value;?>


<form action="login.php" method="GET">
    <input type="text" name="username" value="Benutzername">
    <input type="password" name="password" value="Passwort">
    <input type="submit" value="login">
</FORM>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
