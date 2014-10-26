{extends file="layout.tpl"}

{block name=body}

<h2>Details zum Buch: "{$details["title"]}"</h2>
<div>
    <div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>ISBN</th>
                    <td>{$details["id_isbn"]}</td>
                </tr>
                <tr>
                    <th>Titel</th>
                    <td>{$details["title"]}</td>
                </tr>
                <tr>
                    <th>Subtitle</th>
                    <td>{$details["subtitle"]}</td>
                </tr>
                <tr>
                    <th>Blurb</th>
                    <td>{$details["blurb"]}</td>
                </tr>
                <tr>
                    <th>Reg-Date</th>
                    <td>{$details["reg_date"]}</td>
                </tr>
            </tbody>    
        </table>     
    </div>
    </div>
                <div>
                    {if isset($isLoggedIn)}
                        <div>
                            {$besitzerdaten}
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lendingBook">Buch ausleihen</button>
                        </div>
                    {/if}
                </div>
                
                
                
                
    
    
    <!--Modal-->
    <div class="modal fade" id="lendingBook" tabindex="-1" role="dialog" aria-labelledby="Test" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Buch ausleihen</h4>
                        </div>
                        <div class="modal-body">
                            {$details["title"]}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name= "request" data-dismiss="modal">Ausleihe anfragen</button>
                        </div>
                    </div>
                </div>
    </div>
    
</div>


{/block}