{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Fehlerhafte ISBN</h2>
        </div>
    </div>
{/block}
{block name=body}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>ISBN korrigieren</h3>
                    <form class="form-horizontal" role="form" action="" method="GET" name="book_registration_form">
                        <div class="form-group">
                            <label for="isbn" class="col-sm-4 control-label">ISBN</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="registrateBookWithISBN" placeholder="... ISBN" {if isset($book.id_isbn)}value="{$book.id_isbn}" {else if isset($isbn_input)}value="{$isbn_input}"{/if} required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <div class="msg"></div>
                                <button type="submit" class="btn btn-primary">Weiter mit der Registrierung</button>
                            </div>
                        </div>
                    </form>
                    <h4>Anforderungen an ISBN</h4>
                    <p>
                        Die ISBN muss aus 10 oder 13 Ziffern bestehen.
                        Um sie besser lesbar zu machen, kann sie mit einem "-" strukturiert werden.
                        Wenn es sich um eine 10-stellige ISBN handelt, kann die letzte Ziffer aus dem Buchstabaen "X" - r&ouml;misch 10 - bestehen.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Deine Bücher</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Titel</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $newestBooks as $book}
                                    <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                        <td>{$book.isbn}</td>
                                        <td>{$book.title}</td>
                                    </tr>
                                {foreachelse}
                                    <tr><td colspan="2">Noch keine Bücher registriert</td></tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





{/block}