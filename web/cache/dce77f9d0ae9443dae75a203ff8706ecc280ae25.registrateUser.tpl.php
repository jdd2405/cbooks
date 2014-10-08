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
    '0debd65d8a9db561a3ba3fd862046bf4e41cc1db' => 
    array (
      0 => '.\\configs\\test.conf',
      1 => 1404158794,
      2 => 'file',
    ),
    '73b5e4648aef1979b8c54ec525c2f915b534245b' => 
    array (
      0 => '.\\templates\\header.tpl',
      1 => 1412065810,
      2 => 'file',
    ),
    'e8666a5882158d5163a6391a6d823f614c53e2be' => 
    array (
      0 => '.\\templates\\footer.tpl',
      1 => 1404158794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1186454348961d3e818-97785574',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54348961e8c3b9_64867363',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54348961e8c3b9_64867363')) {function content_54348961e8c3b9_64867363($_smarty_tpl) {?>
<HTML>
<HEAD>
    <TITLE>foo</TITLE>
</HEAD>
<BODY bgcolor="#ffffff">




<form action="login.php" method="GET">
    <input type="email" name="email" value="Ihre E-Mail-Adresse">
    <input type="password" name="password" value="Passwort">
    <input type="submit" value="registrieren">
</FORM>




</BODY>
</HTML>

<?php }} ?>
