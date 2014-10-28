{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Suchresultate für "{$searchTerm}"</h2>
        </div>
    </div>
{/block}
{block name=body}
    <div class="panel panel-default">
        <div class="panel-body">

            {if isset($searchResult)}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Titel</th>
                                <th>Ort</th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach $searchResult as $book}
                                <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                    <td>{$book.id_isbn}</td>
                                    <td>{$book.title}</td>
                                    <td>{$book.zip} {$book.city}</td>
                                </tr>
                            {/foreach}


                        </tbody>
                    </table>
                </div>

            {else}Keine Bücher gefunden.
            {/if}

        </div>
    </div>






{/block}
