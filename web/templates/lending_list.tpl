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
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titel</th>
                    <th>Untertitel</th>
                </tr>
            </thead>
            <tbody>
            <script language="JavaScript" type="text/javascript">
                {literal}
                    function moreDetails(detail){
                        var detail = document.getElementById(detail);
                        
                        if(detail.style.display == 'none'){
                             detail.style.display = '';
                             document.getElementById('collapseBtn').className="glyphicon glyphicon-chevron-up";
                        }
                        else{
                            detail.style.display = 'none';
                            document.getElementById('collapseBtn').className="glyphicon glyphicon-chevron-down";
                        }
                    }
                {/literal}
            </script>
                
                <!--{$detail=0}-->
                {foreach $test123 as $test}
                    <!--{$detail++}-->
                    <tr> 
                        <td>{$test.isbn}</td>
                        <td>{$test.title}</td>
                        <td>{$test.subtitle}</td>
                        <td><button type="button" class="btn btn-primary" onclick="moreDetails({$detail}); return false;"><span id="collapseBtn" class="glyphicon glyphicon-chevron-down"></span></button></td>
                    </tr>
                    
                    {if $lendingListTitle == "Empfangene Anfragen"}
                    <tr id="{$detail}" style="display:none">
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-5">
                                    <dl class="dl-horizontal">
                                        <h4>Buchdetails</h4>
                                        <dt>Titel: </dt>
                                        <dd>{$test.title}</dd>
                                        <dt>Untertitel: </dt>
                                        <dd>{$test.subtitle}</dd>
                                        <dt>Klappentext: </dt>
                                        <dd>{$test.blurb}</dd>
                                        
                                    </dl>
                                </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <dl class="dl-horizontal">
                                            <h4>Anfrageinfos</h4>
                                            <dt>Vorname: </dt>
                                            <dd>{$test.first_name}</dd>
                                            <dt>Postleitzahl und Ort: </dt>
                                            <dd>{$test.zip} {$test.city}</dd>
                                            <dt>Anfragedatum: </dt>
                                            <dd>{$test.requestDate}</dd>
                                            <dt>Ausleihedauer: </dt>
                                            <dd>{$test.duration}</dd>
                                            <form role="form" action="portal.php" methode="GET"><button type="submit" class="btn btn-primary" name="accept" value="{$test.item_id_personal_book}">Ausleihe akzeptieren</button></form>
                                        </dl>
                                    </div>
                            </div>
                        </td>
                    </tr>
                    {elseif $lendingListTitle == "Offene Anfragen"}
                    <tr id="{$detail}" style="display:none">
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-5">
                                    <dl class="dl-horizontal">
                                        <dt>Title: </dt>
                                        <dd>{$test.title}</dd>
                                        <dt>Untertitel: </dt>
                                        <dd>{$test.subtitle}</dd>
                                        <dt>Klappentext: </dt>
                                        <dd>{$test.blurb}</dd>
                                    </dl>
                                </div>
                                    <div class="col-md-5">
                                        <dl class="dl-horizontal">
                                            <dt>Titel: </dt>
                                            <dd>{$test.title}</dd>
                                            <dt>Untertitel: </dt>
                                            <dd>{$test.subtitle}</dd>
                                            <dt>Klappentext: </dt>
                                            <dd>{$test.blurb}</dd>
                                            <dt>Ausleihe akzeptieren: </dt>
                                            <dd><form role="form" action="portal.php" methode="GET"><button type="submit" class="btn btn-primary" name="accept" value="{$test.item_id_personal_book}"><span class="glyphicon glyphicon-ok"></span></button></form></dd>
                                        </dl>
                                    </div>
                            </div>
                        </td>
                    </tr>
                    {elseif $lendingListTitle == "Geliehene Bücher"}
                    <tr id="{$detail}" style="display:none">
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-5">
                                    <dl class="dl-horizontal">
                                        <dt>Title: </dt>
                                        <dd>{$test.title}</dd>
                                        <dt>Untertitel: </dt>
                                        <dd>{$test.subtitle}</dd>
                                        <dt>Klappentext: </dt>
                                        <dd>{$test.blurb}</dd>
                                    </dl>
                                </div>
                                    <div class="col-md-5">
                                        <dl class="dl-horizontal">
                                            <dt>Titel: </dt>
                                            <dd>{$test.title}</dd>
                                            <dt>Untertitel: </dt>
                                            <dd>{$test.subtitle}</dd>
                                            <dt>Klappentext: </dt>
                                            <dd>{$test.blurb}</dd>
                                            <dt>Ausleihe akzeptieren: </dt>
                                            <dd><form role="form" action="portal.php" methode="GET"><button type="submit" class="btn btn-primary" name="accept" value="{$test.item_id_personal_book}"><span class="glyphicon glyphicon-ok"></span></button></form></dd>
                                        </dl>
                                    </div>
                            </div>
                        </td>
                    </tr>
                    {else}
                    <tr id="{$detail}" style="display:none">
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-5">
                                    <dl class="dl-horizontal">
                                        <dt>Title: </dt>
                                        <dd>{$test.title}</dd>
                                        <dt>Untertitel: </dt>
                                        <dd>{$test.subtitle}</dd>
                                        <dt>Klappentext: </dt>
                                        <dd>{$test.blurb}</dd>
                                    </dl>
                                </div>
                                    <div class="col-md-5">
                                        <dl class="dl-horizontal">
                                            <dt>Titel: </dt>
                                            <dd>{$test.title}</dd>
                                            <dt>Untertitel: </dt>
                                            <dd>{$test.subtitle}</dd>
                                            <dt>Klappentext: </dt>
                                            <dd>{$test.blurb}</dd>
                                            <dt>Ausleihe akzeptieren: </dt>
                                            <dd><form role="form" action="portal.php" methode="GET"><button type="submit" class="btn btn-primary" name="accept" value="{$test.item_id_personal_book}"><span class="glyphicon glyphicon-ok"></span></button></form></dd>
                                        </dl>
                                    </div>
                            </div>
                        </td>
                    </tr>
                    {/if}
                    
                    
                    
                    
                    
                    
                    
                {/foreach}


            </tbody>
        </table>
    </div>


    
{/block}