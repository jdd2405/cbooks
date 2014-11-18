{config_load file="test.conf" section="setup"}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>cBooks.ch</title>

        <!-- Bootstrap -->
        <link href="templates/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Style Sheet -->
        <link href="templates/css/cbooks.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="container">
            {if isset($alert_info) }
                <div class="alert alert-info fade in" role="alert">
                    {$alert_info}
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
            {/if}
            {if isset($alert_warning) }
                <div class="alert alert-warning fade in" role="alert">
                    {$alert_warning}
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
            {/if}
            {if isset($alert_success) }
                <div class="alert alert-success fade in" role="alert">
                    {$alert_success}
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
            {/if}

            <header>
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="{$path}"><img src="img/v2.png" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="col-md-9 ">
                        <nav role="navigation" id="metaNav">
                            <ul class="nav nav-pills">
                                <li><a href="{$path}">Startseite</a></li>
                                <li><a href="{$path}?page=impressum">Impressum</a></li>
                                <li><a href="{$path}?page=disclaimer">Haftungsausschuss</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </header>
            <div class="row" id="banner">
                <div class="col-md-12">

                {block name=banner}{/block}




            </div>
            <div class="login-buttons">
                {if !isset($isLoggedIn)}
                    <button class="btn btn-success" id="loginBtn" data-toggle="modal" data-target="#loginModal">Anmelden</button>
                    <!-- Modal -->
                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Einloggen und mitmachen.</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-inline" role="form" action="index.php" method="post">
                                        <div class="form-group">
                                            <label class="sr-only" for="loginEmail">Benutzername</label>
                                            <input type="text" class="form-control" id="loginEmail" name="loginEmail" placeholder="E-Mailadresse">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="loginPassword">Passwort</label>
                                            <input type="password" class="form-control" id="loginPassword" name="loginPassword"  placeholder="Passwort">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                                        <div class="msg"></div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <a class="pull-left" id="resetPasswordBtn" data-toggle="modal" data-target="#resetPasswordModal" data-sidmiss="modal">Passwort vergessen?</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPassword" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Passwort zurücksetzen</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="info">Bitte gib deine E-Mail-Adresse an. Das neue Passwort wird dir dann zugestellt.</p>
                                    <form class="form-inline" role="form" action="index.php" method="post">
                                        <div class="form-group">
                                            <label class="sr-only" for="loginEmail">E-Mail</label>
                                            <input type="text" class="form-control" id="loginEmail" name="loginEmail" placeholder="E-Mailadresse">
                                        </div>
                                        <button type="submit" class="btn btn-danger" name="resetPassword">Passwort zurücksetzen</button>
                                        <div class="msg"></div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                {else}
                    <button type="button" class="btn btn-default" id="settingsBtn" data-toggle="modal" data-target="#settingsModal"><span class="glyphicon glyphicon-cog"></span> Einstellungen</button>
                    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Passwort ändern</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{$path}" method="post">
                                        <div class="form-group">
                                            <label for="password" >Neues Passwort</label>
                                            <input type="password" class="form-control" id="loginEmail" name="password" placeholder="Neues Passwort">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPwd" >Passwort bestätigen</label>
                                            <input type="password" class="form-control" id="loginEmail" name="confirmPwd" placeholder="Passwort bestätigen">
                                        </div>
                                        <button type="submit" class="btn btn-warning" name="changePassword">Passwort ändern</button>
                                        <div class="msg"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="index.php?logout=true" class="btn btn-warning" id="logoutBtn" role="button">Abmelden</a>
                {/if}
            </div>


        </div>

    {block name=body}{/block}

    <div class="row">


        <footer>
            <div class="col-md-12">
                <div class="text-right" id="madeBy">
                    <a href="http://www.realnet.ch" target="_blank"><img src="img/logo.png"></a>
                </div>
            </div>
        </footer>

    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="templates/js/bootstrap.min.js"></script>
<script src="templates/js/forms.js"></script>
<script src="templates/js/sha512.js"></script>
<script type="text/javascript">
    {literal}    
//match email address
            var emailRegex = '^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$';
//match credit card numbers
            var creditCardRegex = '^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35d{3})d{11})$';
//match username
            var usernameRegex = '/^[a-z0-9_-]{3,16}$/';
//match password
            var passwordRegex = '/^[a-z0-9_-]{6,18}$/';
//Match 8 to 15 character string with at least one upper case letter, one lower case letter, and one digit (useful for passwords).
            var passwordStrengthRegex = /((?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/gm;
//match elements that could contain a phone number
            var phoneNumber = /[0-9-()+]{3,20}/;
            $(document).ready(fun ct ion(){

    $('#toggleSearch a').click(function (e) {
    e.preventDefault();
            $(this).tab('show');
    });
            $("input").prop('requi red', true).blur(fun ction() {

    var key = $(this).prop('name');
            var value = $(this).val();
            if ($(this).val().l e ngth < 3 || $(this).val == $(this).attr('placehold er')){

    var msg;
            var type = $(this).prop('name');
            if (t ype == 'email' && value.match(emailRe gex)){
    msg = 'Bitte geben Sie eine gültige E-Mail-Adresse an.';
    }
    el se if (t ype == 'usern ame'){
    msg = 'Bitte wählen Sie einen Benutzernamen.';
    }
    el se if (t ype == 'passw ord'){
    msg = 'Bitte wählen Sie ein Passwort.';
    }
    else{
    msg = 'Bitte füllen Sie dieses Feld korrekt aus.';
    }


    $(this).next('span.note').addClass('text-danger');
            $(this).next('span.note').html(msg);
            $(this).parents("div.form-group").addClass('has-error');
    }

    else {

    $(this).next('span.note').removeClass('text-danger');
            $(this).next('span.note').html("");
            $(this).parents("div.form-group").removeClass('has-error');
            errorCount[$(this).index("#registrationModal [require d] ")] == 0;
            $.ajax({
            type: "GET",
                    url: "isAvailable.php",
                    data: {key: key, value: value},
                    beforeSend: function(html) { // this happen before actual call
                    $(this).next('span.note').html('');
                    },
                    success: fun ction(re sult){ // this happen after we get result
            if (r es ult != true){
            $("#registrationModal input[na m e='" + r e sult + "']").next('span.note').html("bereits registriert");
                    $("#registrationModal input[na m e='" + r e sult + "']").next('span.note').addClass('text-danger');
                    $("#registrationModal input[na m e='" + r e sult + "']").next('span.note').html(msg);
                    $("#registrationModal input[na m e='" + r e sult + "']").parents("div.form-group").addClass('has-error');
            }
            }
            });
    }

    });
    });
            function registrate(){
            $.ajax({
            type: "GET",
                    url: "registrate.php",
                    data: { email: $("#registrationModal input[name='email']").val(), username: $("#registrationModal input[name='username']").val(), password: $("#registrationModal input[name='password']").val() }
            })
                    .done(fun ction(msg) {
                    alert(msg);
                    });
            }

    $(".alert").alert();
    {/literal}  
</script>
</body>
</html>
