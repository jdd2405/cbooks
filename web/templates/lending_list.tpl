{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>{$lendingListTitle}</h2>
        </div>
    </div>
{/block}

{block name=body}
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titel</th>
                </tr>
            </thead>
            <tbody>

                {foreach $test123 as $test}
                    <tr> 
                        <td>{$test.requestDate}</td>
                        <td>{$test.state}</td>
                    </tr>
                {/foreach}


            </tbody>
        </table>
    </div>


    
{/block}