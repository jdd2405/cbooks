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
                        var d = document.getElementById(detail);
                        
                        if(d.style.display == 'none'){
                             d.style.display = '';
                        }
                        else{
                            d.style.display = 'none';
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
                        <td><button type="button" class="btn btn-primary" onclick="moreDetails({$detail});  return false;"><span id="collapseBtn" class="glyphicon glyphicon-sort"></span></button></td>
                    </tr>
                    
                    
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
                                {if $lendingListTitle == "Empfangene Anfragen"}
                                    <div class="col-md-5 col-md-offset-1">
                                        <dl class="dl-horizontal">
                                            <h4>Zusatzinformationen</h4>
                                            <dt>Antragsperson: </dt>
                                            <dd>{$test.first_name}</dd>
                                            <dt>Postleitzahl und Ort: </dt>
                                            <dd>{$test.zip} {$test.city}</dd>
                                            <dt>Anfragedatum: </dt>
                                            <dd>{$test.requestDate}</dd>
                                            <dt>Ausleihedauer: </dt>
                                            <dd>{$test.duration}</dd><br>
                                            <a href="{$path}?accept={$test.item_id_personal_book}" class="btn btn-primary">Ausleihe akzeptieren</a>
                                        </dl>
                                    </div>
                                {elseif $lendingListTitle == "Offene Anfragen"}
                                    <div class="col-md-5 col-md-offset-1">
                                        <dl class="dl-horizontal">
                                            <h4>Zusatzinformationen</h4>
                                            <dt>Bucheigentümer: </dt>
                                            <dd>{$test.first_name}</dd>
                                            <dt>Postleitzahl und Ort: </dt>
                                            <dd>{$test.zip} {$test.city}</dd>
                                            <dt>Anfragedatum: </dt>
                                            <dd>{$test.requestDate}</dd>
                                            <dt>Ausleihedauer: </dt>
                                            <dd>{$test.duration}</dd><br>
                                            <a href="{$path}?ID={$test.item_id_personal_book}&RemoveOrReturn=remove" class="btn btn-primary">Anfrage zurücknehmen</a>
                                        </dl>
                                    </div>
                                
                                {elseif $lendingListTitle == "Geliehene Bücher"}
                                    <div class="col-md-5 col-md-offset-1">
                                        <dl class="dl-horizontal">
                                            <h4>Zusatzinformationen</h4>
                                            <dt>Bucheigentümer: </dt>
                                            <dd>{$test.first_name}</dd>
                                            <dt>Postleitzahl und Ort: </dt>
                                            <dd>{$test.zip} {$test.city}</dd>
                                            <dt>Rückgabedatum: </dt>
                                            <dd>{$test.returnDate}</dd><br>
                                            <a href="{$path}?extend={$test.item_id_personal_book}" class="btn btn-primary">Ausleihe verlängern</a>
                                        </dl>
                                    </div>
                                    
                                {else}
                                    <div class="col-md-5 col-md-offset-1">
                                        <dl class="dl-horizontal">
                                            <h4>Zusatzinformationen</h4>
                                            <dt>Vorname: </dt>
                                            <dd>{$test.first_name}</dd>
                                            <dt>Postleitzahl und Ort: </dt>
                                            <dd>{$test.zip} {$test.city}</dd>
                                            <dt>Rückgabedatum: </dt>
                                            <dd>{$test.returnDate}</dd><br>
                                            <a href="{$path}?ID={$test.item_id_personal_book}&RemoveOrReturn=return" class="btn btn-primary">Buchrückgabe bestätigen</a>
                                        </dl>
                                    </div>
                                {/if}
                            </div>
                        </td>
                    </tr> 
                {/foreach}

            </tbody>
        </table>
    </div>


    
{/block}