{extends file="layout.tpl"}
{$title="Portal"}

{block name=body}

Herzlich willkommen.<br>
<h2>Grosse Auswahl</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            {for $row=0 to $number-1}
                                <tr>
                                {for $col=0 to 3}   
                                <td>{$array[$row][$col]}</td>
                                {/for}
                                </tr>
                            {/for}
                        </table>
                    </div>
<a href="logout.php">ausloggen</a>

{/block}