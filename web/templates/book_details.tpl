{extends file="layout.tpl"}

{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Details zum Buch:</br> "{$details["title"]}"</h2>
        </div>
    </div>
{/block}

{block name=body}

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
                                        <td>{$details["isbn"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Titel</th>
                                        <td>{$details["title"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Untertitel</th>
                                        <td>{$details["subtitle"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Autor</th>
                                        <td>{$details["aut_name"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Klappentext</th>
                                        <td>{$details["blurb"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Beschreibung</th>
                                        <td>{$details["description"]}</td>
                                    </tr>
                                    <tr>
                                        <th>Verfügbarkeit</th>
                                        <td>{if $details["availability"] == l}ausgeliehen</td></tr>
                                    <tr><th>Rückgabedatum</th><td>{$returnDate["returnDate"]}</td></tr>{elseif $details["availability"] == a}verfügbar {else}zur Zeit nicht verfügbar{/if}

                                </tbody>    
                            </table>     
                        </div>
                    </div>
                </div>
            </div>
            {if isset($isLoggedIn) and $details["availability"]==a and $details["owner_id_user"] != {$smarty.session.user_id}}
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">


                            <div>
                                <h4>Daten des Besitzers</h4>
                                <p>Name: {$besitzerdaten["first_name"]}<br>
                                    Ort: {$besitzerdaten["city"]}</p>

                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lendingBook">Buch ausleihen</button>
                            </div>

                        </div>
                    </div>
                </div>
                {elseif isset($isLoggedIn) and $details["availability"] == a and $details["owner_id_user"] == {$smarty.session.user_id}}
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editBook">Buch bearbeiten</button>
                            </div>
                        </div>
                    </div>
                {elseif !isset($isLoggedIn)}
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p><b>Du musst eingeloggt sein um ein Buch auszuleihen.</b></p>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>

            <a href="javascript:history.back()">Zurück zur Suche</a>





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
                                <input type="hidden" name="id_personal_book" value="{$details["id_personal_book"]}"/> &nbsp;
                                <button type="submit" class="btn btn-primary" >Ausleihe anfragen</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
                                
            <!--Modal-->
            <div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="Test" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Buch bearbeiten</h4>
                        </div>
                        <div class="modal-body">
                            
                            <form class="form-horizontal" role="form" action="{$path}" method="GET" name="bookEditForm">
                                <div class="form-group">
                                    <label for="isbn" class="col-sm-4 control-label">ISBN</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="isbn-display" placeholder="... ISBN" {if isset($details.isbn)}value="{$details.isbn}"{/if} disabled="disabled">
                                        <input type="hidden" name="isbn" {if isset($details.isbn)}value="{$details.isbn}"{/if} >
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-4 control-label">Titel</label>
                                    <div class="col-sm-8">
                                        <input type="textarea" class="form-control" name="title" placeholder="... Titel" {if isset($details.title)}value="{$details.title}"{/if} required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subtitle" class="col-sm-4 control-label">Untertitel</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="subtitle" placeholder="... Untertitel"{if isset($details.subtitle)}value="{$details.subtitle}"{/if}>
                                        <span class="note"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="author" class="col-sm-4 control-label">Autor</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="author" placeholder="... Autor"{if isset($details.aut_name)}value="{$details.aut_name}"{/if}>
                                        <span class="note"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="volume" class="col-sm-4 control-label">Klappentext</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="blurb" placeholder="... Klappentext" {if isset($details.blurb)}value="{$details.blurb}"{/if}>
                                        <span class="note"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="run" class="col-sm-4 control-label">Auflage</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="run" placeholder="... Auflage" {if isset($details.run)}value="{$details.run}"{/if}>
                                        <span class="note"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">Beschrieb</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="description" placeholder="... individuelle Beschreibung"{if isset($details.description)}value="{$details.description}"{/if}>
                                        <span class="note"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="msg"></div>
                                        <button type="submit" name="editBook" class="btn btn-primary">&Auml;nderungen speichern</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>              

        </div>


    {/block}