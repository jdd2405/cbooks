{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            {if isset($searchTerm)}
            <h2>Suchresultate für "{$searchTerm}"</h2>
            {elseif isset($allPersonalBooks)}<h2>Alle deine Bücher</h2>
            {else}<h2>Alle Bücher</h2>{/if}
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
                                        <th>Autor</th>
                                        <th>Ort</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {foreach $searchResult as $book}
                                        <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                            <td>{if $book.id_isbn|count_characters>10}{$book.id_isbn|substr:-13:3}-{/if}{$book.id_isbn|substr:-10:1}-{$book.id_isbn|substr:-9:5}-{$book.id_isbn|substr:-4:3}-{$book.id_isbn|substr:-1}</td>
                                            <td>{$book.title}</td>
                                            <td>{$book.aut_name}</td>
                                            <td>{$book.zip} {$book.city}</td>
                                        </tr>
                                    {/foreach}


                                </tbody>
                            </table>
                        </div>
                    {elseif isset($allPersonalBooks)}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>Titel</th>
                                        <th>Autor</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {foreach $allPersonalBooks as $book}
                                        <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                            <td>{if $book.isbn|count_characters>10}{$book.isbn|substr:-13:3}-{/if}{$book.isbn|substr:-10:1}-{$book.isbn|substr:-9:5}-{$book.isbn|substr:-4:3}-{$book.isbn|substr:-1}</td>
                                            <td>{$book.title}</td>
                                            <td>{$book.aut_name}</td>
                                        </tr>
                                    {/foreach}


                                </tbody>
                            </table>
                        </div> 
                    {elseif isset($allBooks)}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>Titel</th>
                                        <th>Autor</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {foreach $allBooks as $allBook}
                                        <tr onclick="document.location = '{$path}?book_id={$allBook.id_personal_book}';"> 
                                            <td>{$allBook.isbn}</td>
                                            <td>{$allBook.title}</td>
                                            <td>{$allBook.aut_name}</td>
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
