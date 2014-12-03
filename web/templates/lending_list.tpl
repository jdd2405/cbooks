{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>{$lendingListTitle}</h2>
        </div>
    </div>
{/block}

{block name=body}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Titel</th>
                            <th>Autor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <script language="JavaScript" type="text/javascript">
                        {literal}
                    function moreDetails(detail) {
                        var d = document.getElementById(detail);

                        if (d.style.display == 'none') {
                            d.style.display = '';
                        }
                        else {
                            d.style.display = 'none';
                        }
                    }
                        {/literal}
                    </script>

                    <!--{$detail=0}-->
                    {foreach $lists as $list}
                        <!--{$detail++}-->

                        <tr> 
                            <td>{$list.isbn}</td>
                            <td>{$list.title}</td>
                            <td>{$list.aut_name}</td>
                            <td><button type="button" class="btn btn-primary" onclick="moreDetails({$detail});
                                return false;"><span id="collapseBtn" class="glyphicon glyphicon-sort"></span></button></td>
                        </tr>


                        <tr id="{$detail}" style="display:none">
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <dl class="dl-horizontal">
                                            <h4>Buchdetails</h4>
                                            <dt>ISBN: </dt>
                                            <dd>{$list.isbn}</dd>
                                            <dt>Titel: </dt>
                                            <dd>{$list.title}</dd>
                                            <dt>Untertitel: </dt>
                                            <dd>{$list.subtitle}</dd>
                                            <dt>Autor: </dt>
                                            <dd>{$list.aut_name}</dd>
                                            <dt>Klappentext: </dt>
                                            <dd>{$list.blurb}</dd> 
                                        </dl>
                                    </div>
                                    {if $lendingListTitle == "Empfangene Anfragen"}
                                        <div class="col-md-5 col-md-offset-1">
                                            <dl class="dl-horizontal">
                                                <h4>Zusatzinformationen</h4>
                                                <dt>Antragsperson: </dt>
                                                <dd>{$list.first_name}</dd>
                                                <dt>Postleitzahl und Ort: </dt>
                                                <dd>{$list.zip} {$list.city}</dd>
                                                <dt>Anfragedatum: </dt>
                                                <dd>{$list.requestDate|date_format:"%e.%m.%Y"}</dd>
                                                <dt>Ausleihedauer: </dt>
                                                <dd>{$list.duration}</dd><br>
                                                <a href="{$path}?decline={$list.item_id_personal_book}" class="btn btn-default">Ausleihe ablehnen</a>
                                                <a href="{$path}?accept={$list.item_id_personal_book}" class="btn btn-primary">Ausleihe akzeptieren</a>
                                            </dl>
                                        </div>
                                    {elseif $lendingListTitle == "Offene Anfragen"}
                                        <div class="col-md-5 col-md-offset-1">
                                            <dl class="dl-horizontal">
                                                <h4>Zusatzinformationen</h4>
                                                <dt>Bucheigentümer: </dt>
                                                <dd>{$list.first_name}</dd>
                                                <dt>Postleitzahl und Ort: </dt>
                                                <dd>{$list.zip} {$list.city}</dd>
                                                <dt>Anfragedatum: </dt>
                                                <dd>{$list.requestDate|date_format:"%e.%m.%Y"}</dd>
                                                <dt>Ausleihedauer: </dt>
                                                <dd>{$list.duration}</dd><br>
                                                <a href="{$path}?ID={$list.item_id_personal_book}&RemoveOrReturn=remove" class="btn btn-primary">Anfrage zurücknehmen</a>
                                            </dl>
                                        </div>

                                    {elseif $lendingListTitle == "Geliehene Bücher"}
                                        <div class="col-md-5 col-md-offset-1">
                                            <dl class="dl-horizontal">
                                                <h4>Zusatzinformationen</h4>
                                                <dt>Bucheigentümer: </dt>
                                                <dd>{$list.first_name}</dd>
                                                <dt>Postleitzahl und Ort: </dt>
                                                <dd>{$list.zip} {$list.city}</dd>
                                                <dt>Rückgabedatum: </dt>
                                                <dd>{$list.returnDate|date_format:"%e.%m.%Y"}</dd><br>
                                            </dl>
                                        </div>

                                    {else}
                                        <div class="col-md-5 col-md-offset-1">
                                            <dl class="dl-horizontal">
                                                <h4>Zusatzinformationen</h4>
                                                <dt>Vorname: </dt>
                                                <dd>{$list.first_name}</dd>
                                                <dt>Postleitzahl und Ort: </dt>
                                                <dd>{$list.zip} {$list.city}</dd>
                                                <dt>Rückgabedatum: </dt>
                                                <dd>{$list.returnDate|date_format:"%e.%m.%Y"}</dd><br>
                                                <a href="{$path}?ID={$list.item_id_personal_book}&RemoveOrReturn=return" class="btn btn-primary">Buchrückgabe bestätigen</a>
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
        </div>
    </div>



{/block}