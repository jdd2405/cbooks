{extends file="layout.tpl"}

{block name=banner}
    <div class="jumbotron">
        <h1>Bücher finden.</h1>
        <p>Mach mit bei der Tausch-Platform für spannende Literatur.</p>
        <p><a class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#registrationModal">Jetzt mitmachen</a></p>

        <!-- Modal -->
        <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Registrieren und mitmachen.</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" action="{$path}" method="POST" name="registration_form">
                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">E-Mail</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control " name="registrateEmail" placeholder="E-Mailadresse" required>
                                    <span class="note"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="registratePassword" placeholder="Passwort" required>
                                    <span class="note"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmpwd" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="registrateConfirmpwd" placeholder="Passwort" required>
                                    <span class="note"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <div class="msg"></div>
                                    <button type="submit" name="registrateUser" class="btn btn-primary">Jetzt registrieren.</button>
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
{/block}

{block name=body}
    <div class="row">
        <div class="col-sm-4" id="findABook">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Buch finden</h2>

                    <!-- Nav tabs -->
                    <!--<ul class="nav nav-tabs" id="toggleSearch">
                        <li class="active"><a href="#search" data-toggle="tab">suchen</a></li>
                        <li><a href="#browse" data-toggle="tab">schmökern</a></li>
                    </ul>-->

                    <!-- Tab panes -->
                    <!--
                    <div class="tab-content">
                        <div class="tab-pane active" id="search">-->

                            <form class="form-inline" role="form" action="{$path}" method="GET">
                                <input type="text" class="form-control " id="searchBookInput" name="searchBook" placeholder="ISBN, Titel oder Stichwort" required> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
                            </form>


                        <!--<div class="tab-pane" id="browse">
                            <ul class="list-inline">
                                <li>Kategorie</li>
                                <li>Alphabet</li>
                                <li>Popularität</li>
                            </ul>-->


        </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Grosse Auswahl</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $newestBooks as $book}
                                    <tr onclick="document.location = '{$path}?book_id={$book[0]}';"> 
                                        <td>{$book[2]}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                        <a href="{$path}?allBooks">alle Bücher anzeigen</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4" id="registerABook">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Statistik</h2>
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



{/block}
