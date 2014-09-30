{extends file="layout.tpl"}
{$title="Start"}

{block name=body}
Session-ID: {$session_id}

<form action="login.php" method="GET">
    <input type="text" name="username" value="Benutzername">
    <input type="password" name="password" value="Passwort">
    <input type="submit" value="login">
</FORM>

{/block}