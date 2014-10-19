{extends file="layout.tpl"}
{block name="banner"}

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
                                <input type="text" class="form-control " name="updateFirst_name" placeholder="{$user->first_name}" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="updateFamily_name" placeholder="{$user->family_name}" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateStreet" class="col-sm-4 control-label">Strasse</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="updateStreet" placeholder="{$user->street}" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateCity" class="col-sm-4 control-label">Ort</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control " name="updateZIP" placeholder="{$user->zip}" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " name="updateCity" placeholder="{$user->city}" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateEmail" class="col-sm-4 control-label">E-Mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control " name="updateEmail" placeholder="{$user->email}" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateTel" class="col-sm-4 control-label">Telefon</label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control " name="updateTel" placeholder="{$user->tel}" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <div class="msg"></div>
                                <button type="submit" class="btn btn-primary">Änderungen speichern</button>
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



{/block}

{block name=body}

    <h2>Grosse Auswahl</h2>
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
                    <tr> 
                        <td>{$book.id_isbn}</td>
                        <td>{$book.title}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>

{/block}