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
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <script language="JavaScript" type="text/javascript">
                {literal}
                    function moreDetails(detail, action){
                        var detail = document.getElementById(detail);
                        if(action==1){
                             detail.style.display = '';
                        }
                        else{
                            detail.style.display = 'none';
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
                        <td><button type="button" class="btn btn-primary" onclick="moreDetails({$detail}, '1'); return false;"><span class="glyphicon glyphicon-chevron-down"></span></button></td>
                    </tr>

                    <tr id="{$detail}" style="display:none">
                        <td colspan="3">
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
                        <td><button type="button" class="btn btn-primary" onclick="moreDetails({$detail}, '2'); return false;"><span class="glyphicon glyphicon-chevron-up"></span></button></td>
                    </tr>
                {/foreach}


            </tbody>
        </table>
    </div>


    
{/block}