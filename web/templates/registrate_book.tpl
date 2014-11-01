{extends file="layout.tpl"}


{block name=body}

    Vorhandenes Buch erfassen.
    <p>Bitte einen vollständigen Datensatz eingeben:</p>
    <form action = "jot_datenbankPflege_2.php" method = "post">
        <p><input name = "isbn" value="{$id_isbn}">ISBN</p>
        <p><input name = "title" value="{$title}">Titel</p>
        <p><input name = "subtitle">Untertitel</p>
        <p><input name = "author">Autor</p>
        <p>
            <input type="submit" name="registrate_book">
        </p>
    </form>
    




{/block}