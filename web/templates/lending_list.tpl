{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Lendingrelation</h2>
        </div>
    </div>
{/block}

{block name=body}
    
    {if isset($test123)}
        {foreach $test123 as $test}
            <tr> 
                <td>{$test.id_lending_relation}</td>
                <td>{$test.requestDate}</td>
            </tr>
        {/foreach}
    {/if}


    
    
    
{/block}