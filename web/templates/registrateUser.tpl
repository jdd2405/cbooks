{extends file="layout.tpl"}
{$title="Start"}

{block name=body}

<form action="login.php" method="GET">
    <input type="email" name="email" value="Ihre E-Mail-Adresse">
    <input type="password" name="password" value="Passwort">
    <input type="submit" value="registrieren">
</FORM>

{/block}