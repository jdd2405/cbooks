{extends file="layout.tpl"}
{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Herzlich Willkommen{if $user->first_name != ""},{/if} {$user->first_name}</h2>
            <address>
                <dl class="dl-horizontal">
                    <dt>Adresse</dt>
                    <dd>
                        {$user->street}<br>
                        {$user->zip} {$user->city}
                    </dd>
                    <dt>E-Mail</dt>
                    <dd>{$user->email}</dd>
                    <dt>Telefon</dt>
                    <dd>{$user->tel}</dd>
                    <dt></dt>
                    <dd><br><button type="button" class="btn btn-default"  data-toggle="modal" data-target="#changeAdressModal"><span class="glyphicon glyphicon-pencil"></span> Angaben ändern</button></dd>
                </dl>
            </address>

            <!-- Modal -->
            <div class="modal fade" id="changeAdressModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Angaben ändern</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" action="" method="POST" name="updateUser_form">
                                <div class="form-group">
                                    <label for="updateName" class="col-sm-4 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " name="updateFirstName" value="{$user->first_name}" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " name="updateFamilyName" value="{$user->family_name}" required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateStreet" class="col-sm-4 control-label">Strasse</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="updateStreet" value="{$user->street}" required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateCity" class="col-sm-4 control-label">Ort</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control " name="updateZIP" value="{$user->zip}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control " name="updateCity" value="{$user->city}" required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateEmail" class="col-sm-4 control-label">E-Mail</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control " name="updateEmail" value="{$user->email}"required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateTel" class="col-sm-4 control-label">Telefon</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control " name="updateTel" value="{$user->tel}" required>
                                        <span class="note"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="msg"></div>
                                        <button type="submit" name="updateUser" class="btn btn-primary">Änderungen speichern</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{/block}

{block name=body}
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h2>neues Buch registrieren</h2>
                    <form class="form-inline" role="form" action="" method="POST" name="updateUser_form">
                        <input type="text" class="form-control " name="updateFirst_name" placeholder="ISBN" required> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></button>

                    </form>
                    <a href="#">Keine ISBN vorhanden?</a>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Deine Bücher</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Titel</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $books as $book}
                                    <tr onclick="document.location = 'portal.php?book_id={$book.id_isbn}';"> 
                                        <td>{$book.id_isbn}</td>
                                        <td>{$book.title}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Deine Statistik</h2>
                    <dl class="dl-horizontal">
                        <dt>Registrierte Bücher</dt>
                        <dd>10</dd>
                        <dt>Gelesene Bücher</dt>
                        <dd>2</dd>
                        <dt>Ausgeliehne Bücher</dt>
                        <dd>5</dd>
                        <dt>Ausgeliehne Bücher</dt>
                        <dd>5</dd>

                    </dl>

                </div>
            </div>
        </div>
    </div>
{/block}