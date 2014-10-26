{extends file="layout.tpl"}


{block name=body}

    <h2>Suchresultate für "{$searchTerm}"</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titel</th>
                </tr>
            </thead>
            <tbody>
                {if isset($isLoggedIn)}
                {foreach $searchResult as $book}
                    <tr onclick="document.location = 'portal.php?book_id={$book.id_isbn}';"> 
                        <td>{$book.id_isbn}</td>
                        <td>{$book.title}</td>
                    </tr>
                {/foreach}
                {else}
                    {foreach $searchResult as $book}
                    <tr onclick="document.location = 'index.php?book_id={$book.id_isbn}';"> 
                        <td>{$book.id_isbn}</td>
                        <td>{$book.title}</td>
                    </tr>
                    {/foreach}
                {/if}
                    
            </tbody>
        </table>
    </div>





{/block}
