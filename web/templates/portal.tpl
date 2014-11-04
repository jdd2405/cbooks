{extends file="layout.tpl"}
{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Herzlich Willkommen{if $user->first_name != ""},{/if} {$user->first_name}</h2>
            <div class="row">
                <div class="col-md-9">
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
                </div>
                    <div class="col-md-3">
                       <dl class="dl-horizontal">
                        <dt>Empfangene Anfragen</dt>
                        <dd><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span></button></dd>
                        <dt>Offene Anfragen</dt>
                        <dd><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span></button></dd>
                        <dt>Geliehene Bücher</dt>
                        <dd><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span></button></dd>
                        <dt>Verliehene Bücher</dt>
                        <dd><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span></button></dd>
                       </dl>
                    </div>
            </div>


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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h2>Buch suchen</h2>
                            <form class="form-inline" role="form" action="" method="GET" name="searchBook">
                                <input type="text" class="form-control " name="searchBook" placeholder="ISBN, Titel oder Stichwort" required> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h2>neues Buch registrieren</h2>
                            <form class="form-inline" role="form" action="" method="GET" name="updateUser_form">
                                <input type="text" class="form-control " name="registrateBookWithISBN" placeholder="ISBN" required> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></button>

                            </form>
                            <a href="#">Keine ISBN vorhanden?</a>

                        </div>
                    </div>
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
                                {foreach $newestBooks as $book}
                                    <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                        <td>{$book.isbn}</td>
                                        <td>{$book.title}</td>
                                    </tr>
                                {foreachelse}
                                    <tr><td colspan="2">Noch keine Bücher registriert</td></tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>Deine Statistik</h2>
                                <dl class="dl-horizontal">
                                <dt>Registrierte Bücher</dt>
                        <dd>{$nofRegBooks}</dd>
                        <dt>Registrierte Benutzer</dt>
                        <dd>{$nofRegUsers}</dd>
                        <dt>Ausgeliehne Bücher</dt>
                        <dd>{$nofLends}</dd>

                                </dl>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3>Angefragte Bücher</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Anfragedatum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            {if isset($requests)}
                                                {foreach $requests as $request}
                                                <tr> 
                                                <td>{$request.id_lending_relation}</td>
                                                <td>{$request.requestDate}</td>
                                                </tr>
                                                {/foreach}
                                            {/if}
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <h3>Anfragen deiner Bücher</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th colspan="2">Anfragedatum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            {if isset($confirms)}
                                            {foreach $confirms as $confirm}
                                            <tr> 
                                            <td>{$confirm.id_lending_relation}</td>
                                            <td>{$confirm.requestDate}</td>
                                            <td><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#acceptRequest"><span class="glyphicon glyphicon-ok"></span></button></td>
                                            </tr>
                                            {/foreach}
                                            {/if}
                                        </tbody>
                                    </table>
                                </div>
                                <h3>Ausgeliehene Bücher</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rückgabedatum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            {if isset($borrowed)}
                                            {foreach $borrowed as $borrow}
                                            <tr> 
                                            <td>{$borrow.id_lending_relation}</td>
                                            <td>{$borrow.returnDate}</td>
                                            </tr>
                                            {/foreach}
                                            {/if}
                                        </tbody>
                                    </table>
                                </div>
                                <h3>Meine geliehenen Bücher</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rückgabedatum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            {if isset($lended)}
                                            {foreach $lended as $lend}
                                            <tr> 
                                            <td>{$lend.id_lending_relation}</td>
                                            <td>{$lend.returnDate}</td>
                                            <td><button type="submit" class="btn btn-primary" name= "returned"><span class="glyphicon glyphicon-ok"></span></button></td>
                                            </tr>
                                            {/foreach}
                                            {/if}
                                        </tbody>
                                    </table>
                                </div>
                                <!--Modal for confirming-->
                                <div class="modal fade" id="acceptRequest" tabindex="-1" role="dialog" aria-labelledby="Test" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Buchanfrage akzeptieren</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form" action="portal.php" method="POST">
                                                {$confirm.id_lending_relation}<br>
                                                {$confirm.title}<br>
                                                {$confirm.id_isbn}<br>
                                                {$confirm.first_name}
                                                <input type="hidden" name="lendingRelation" value="{$confirm.item_id_personal_book}"/>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Buchanfrage bestätigen</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--Modal Ende-->
                                <!--Modal for returning-->
                                <div class="modal fade" id="returning" tabindex="-1" role="dialog" aria-labelledby="Test" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Buchrückgabe</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form" action="portal.php" method="POST">
                                                    <p>Durch drücken des unteren Buttons, betätigen Sie, dass 
                                                        Ihr Buch wieder zurück gebracht wurden und es wieder frei zur Ausleihe steht.</p>
                                                <input type="hidden" name="return" value="{$lend.item_id_personal_book}"/>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Akzeptieren</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--Modal Ende-->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
    </div>

{/block}
