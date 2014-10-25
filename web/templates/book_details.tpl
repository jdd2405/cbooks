{extends file="layout.tpl"}

{block name=body}

 <h2>Suchresultate für </h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titel</th>
                </tr>
            </thead>
            <tbody>
                {foreach $details as $detail}
                    <tr> 
                        <td>{$detail.id_isbn}</td>
                        <td>{$detail.title}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>


{/block}