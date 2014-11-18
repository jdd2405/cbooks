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
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Haftungsausschluss</h2>


                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <address>
                        <strong>cBooks.ch</strong><br>
                        Fachhochschule Nordwestschweiz FHNW<br>
                        School of Business<br>
                    </address>
                </div>
            </div>
        </div>
    </div>



{/block}
