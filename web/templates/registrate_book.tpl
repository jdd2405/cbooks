{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Neues Buch registrieren</h2>
        </div>
    </div>
{/block}
{block name=body}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3>Daten erfassen</h3>
                    <form class="form-horizontal" role="form" action="{$path}" method="POST">
                        <div class="form-group">
                            <label for="isbn" class="col-sm-4 control-label">ISBN</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="isbn" placeholder="... ISBN" {if isset($book.id_isbn)}value="{if $book.id_isbn|count_characters>10}{$book.id_isbn|substr:-13:3}-{/if}{$book.id_isbn|substr:-10:1}-{$book.id_isbn|substr:-9:5}-{$book.id_isbn|substr:-4:3}-{$book.id_isbn|substr:-1}" {else if isset($isbn_input)}value="{if $isbn_input|count_characters>10}{$isbn_input|substr:-13:3}-{/if}{$isbn_input|substr:-10:1}-{$isbn_input|substr:-9:5}-{$isbn_input|substr:-4:3}-{$isbn_input|substr:-1}"{/if} readonly>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-4 control-label">Titel</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" placeholder="... Titel" {if isset($book.title)}value="{$book.title}"{/if} required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subtitle" class="col-sm-4 control-label">Untertitel</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="subtitle" placeholder="... Untertitel" {if isset($book.subtitle)}value="{$book.subtitle}"{/if}>
                                <span class="note"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="author" class="col-sm-4 control-label">Autor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="author" placeholder="... Autor"{if isset($book.aut_name)}value="{$book.aut_name}"{/if}>
                                <span class="note"></span>
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Klappentext</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="blurb" placeholder="... Klappentext"{if isset($book.blurb)}value="{$book.blurb}"{/if}>
                                <span class="note"></span>
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <label for="run" class="col-sm-4 control-label">Auflage</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="run" placeholder="... Auflage">
                                <span class="note"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="col-sm-4 control-label">Beschrieb</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="description" placeholder="... individuelle Beschreibung">
                                <span class="note"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <div class="msg"></div>
                                <button type="submit" name="registrateBook" class="btn btn-primary">Jetzt registrieren.</button>
                            </div>
                        </div>
                    </form>
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