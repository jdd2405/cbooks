{extends file="layout.tpl"}



{block name="banner"}
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Herzlich Willkommen{if $user->first_name != ""},{/if} {$user->first_name}</h2>
            <div class="row">
                <div class="col-md-8">
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
                <div class="col-md-4">
                    <dl class="dl-horizontal" id ="buecherlistenLinks">
                        <dt {if $rowsList1>0}class="text-primary"{else}class="text-muted"{/if}>Empfangene Anfragen</dt>
                        <dd><a href="{$path}?list=1"><span class="badge">{$rowsList1}</span></a></dd>
                        <dt {if $rowsList2>0}class="text-primary"{else}class="text-muted"{/if}>Offene Anfragen</dt>
                        <dd><a href="{$path}?list=2"><span class="badge">{$rowsList2}</span></a></dd>
                        <dt {if $rowsList3>0}class="text-primary"{else}class="text-muted"{/if}>Geliehene Bücher</dt>
                        <dd><a href="{$path}?list=3"><span class="badge">{$rowsList3}</span></a></dd>
                        <dt {if $rowsList4>0}class="text-primary"{else}class="text-muted"{/if}>Verliehene Bücher</dt>
                        <dd><a href="{$path}?list=4"><span class="badge">{$rowsList4}</span></a></dd>
                    </dl>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="changeAdressModal" tabindex="-1" role="dialog" aria-labelledby="changeAdressModal" aria-hidden="true">
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
                                <input type="text" class="form-control " name="searchBook" id="searchBookInput" placeholder="ISBN, Titel oder Stichwort" required> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

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
                            <form id="isbnForm" class="form-inline" action="{$path}" method="GET">
                                <div class="form-group">
                                    <label class="control-label sr-only">ISBN</label>
                                    <input type="text" class="form-control" name="isbn" placeholder="ISBN"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                </div>
                                
                            </form>

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
                                    <th>Titel</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $newestBooks as $book}
                                    <tr onclick="document.location = '{$path}?book_id={$book.id_personal_book}';"> 
                                        <td>{$book.title}</td>
                                    </tr>
                                {foreachelse}
                                    <tr><td colspan="2">Noch keine Bücher registriert</td></tr>
                                {/foreach}
                            </tbody>
                        </table>
                        <a href="{$path}?allPersonalBooks">alle meine Bücher anzeigen</a>
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
                                <dt>Deine Bücher</dt>
                                <dd>{$nofRegBooks}</dd>
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
                            <h2>Bald ablaufende Bücher</h2>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Titel</th>
                                            <th>Rückgabedatum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach $alertbooks as $alertbook}
                                            <tr onclick="document.location = '{$path}?book_id={$alertbook.id_personal_book}';"> 
                                                <td>{$alertbook.title}</td>
                                                <td>{$alertbook.returnDate}</td>
                                            </tr>
                                        {foreachelse}
                                            <tr><td colspan="2">Zurzeit keine zurückzugebenen Bücher</td></tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

{/block}

{block name=js}
    {literal}

        

$(document).ready(function() {
    $('#isbnForm').bootstrapValidator({
        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                isbn: {
                    validators: {
                        isbn: {
                            message: 'The value is not valid ISBN'
                        }
                    }
                }
            }
        });
    });


    {/literal}
{/block}
