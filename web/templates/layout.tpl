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
                <div class="alert alert-info" role="alert">
                    {$alert_info}
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
            {/if}

            <header>
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="#"><img src="img/v2.png" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="col-md-9 ">
                        <nav role="navigation" id="metaNav">
                            <ul class="nav nav-pills">
                                <li><a href="#">Startseite</a></li>
                                <li><a href="#">Impressum</a></li>
                                <li><a href="#">Hauftungsausschuss</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </header>
            <div class="row" id="banner">
                <div class="col-md-12">
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
                                        <form class="form-horizontal" role="form" action="registrate.php" method="POST">
                                            <div class="form-group">
                                                <label for="email" class="col-sm-4 control-label">E-Mail</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control " name="email" placeholder="E-Mailadresse" required>
                                                    <span class="note"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-4 control-label">Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" placeholder="Passwort" required>
                                                    <span class="note"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                    <div class="msg"></div>
                                                    <button type="submit" class="btn btn-primary">Jetzt registrieren.</button>
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
                <button class="btn btn-warning" id="loginBtn" data-toggle="modal" data-target="#loginModal">Anmelden</button>
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Einloggen und mitmachen.</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-inline" role="form" action="login.php" method="post">
                                    <div class="form-group">
                                        <label class="sr-only" for="loginUsername">Benutzername</label>
                                        <input type="text" class="form-control" id="loginEmail" name="email" placeholder="E-Mailadresse">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="loginPassword">Passwort</label>
                                        <input type="password" class="form-control" id="loginPassword" name="password"  placeholder="Passwort">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <div class="msg"></div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        {block name=body}{/block}

        <div class="row">
            <div class="col-md-12" id="message">

            </div>


            <footer>
                <div class="text-right" id="madeBy">
                    <a href="http://www.realnet.ch" target="_blank"><img src="img/logo.png"></a>
                </div>
            </footer>

        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="templates/js/bootstrap.min.js"></script>
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
    
        $("input").prop('requi red',true).blur(fun ction() {
        
        var key = $(this).prop('name');
        var value = $(this).val();     
             if($(this).val().l e ngth<3 || $(this ). val==$(this).attr('placehold er')){
            
            var msg;
                var type =  $(this).prop('name');
            
                if (t ype=='email' && value.match(emailRe gex)){
            msg='Bitte geben Sie eine gültige E-Mail-Adresse an.';
            }
                el se if (t ype=='usern ame'){
            msg='Bitte wählen Sie einen Benutzernamen.';
            }
                el se if (t ype=='passw ord'){
            msg='Bitte wählen Sie ein Passwort.';
            }
                else{
            msg='Bitte füllen Sie dieses Feld korrekt aus.';
                }
            

            $(this).next('span.note').addClass('text-danger');
            $(this).next('span.note').html(msg);
        $(this).parents("div.form-group").addClass('has-error');
            }
        
            else {
            
            $(this).next('span.note').removeClass('text-danger');
            $(this).next('span.note').html("");
            $(this).parents("div.form-group").removeClass('has-error');
                errorCount[$(this).index("#registrationModal [require d] ")]==0;
            
                $.ajax({
                type: "GET",
                url: "isAvailable.php",
                data: {key: key, value: value},
                    beforeSend: fun ction(html) { // this happen before actual call
                $(this).next('span.note').html('');
                },
                    success: fun ction(re sult){ // this happen after we get result
                        if(r es ult!= true){
                        $("#registrationModal input[na m e='"+r e sult+"']").next('span.note').html("bereits registriert");
                        $("#registrationModal input[na m e='"+r e sult+"']").next('span.note').addClass('text-danger');
                        $("#registrationModal input[na m e='"+r e sult+"']").next('span.note').html(msg);
                    $("#registrationModal input[na m e='"+r e sult+"']").parents("div.form-group").addClass('has-error');
                }
            }
                });
        
            }
    
});
    });

    function registr ate(){
        $.ajax({
        type: "GET",
        url: "registrate.php",
    data: { email: $("#registrationModal input[name='email']").val(), username: $("#registrationModal input[name='username']").val(), password: $("#registrationModal input[name='password']").val() }
            })
                .done(fun ction( msg ) {
            alert( msg );
});
      }

      $(".alert").alert();
        {/literal}  
    </script>
</body>
</html>