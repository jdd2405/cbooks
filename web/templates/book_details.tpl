{extends file="layout.tpl"}

{block name=body}

<h2>Details zum Buch: "{$details["title"]}"</h2>
<div>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
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
                </div>
        </div>
        {if isset($isLoggedIn)}
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                
                    
                        <div>
                            {foreach $besitzerdaten as $besitzer} 
                                        <p>{$besitzer.first_name} {$besitzer.family_name}</p>
                                        <br>

                            {/foreach}
                                        
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lendingBook">Buch ausleihen</button>
                        </div>
                    
                </div>
            </div>
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
                            
                            <form class="form-inline" role="form" action="portal.php" method="GET">
                                Ausleihdauer in Wochen:
                                
                                <select class="form-control" name="duration">
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                        </select>
                                 <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Ausleihe anfragen</button>
                                </div>
                            </form>
                            
                        </div>
                       
                    </div>
                </div>
    </div>
    
</div>


{/block}