<?php /* Smarty version Smarty-3.1.19, created on 2014-10-08 03:26:13
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77695425960f90d461-52234428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c12f8ffa7232af049bbb690157b11dc3263ab030' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1412731570,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1412731514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77695425960f90d461-52234428',
  'function' => 
  array (
  ),
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5425960f9e7359_54099901',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5425960f9e7359_54099901')) {function content_5425960f9e7359_54099901($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

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
          
              
    <div class="row">
        <div class="col-sm-4" id="findABook">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Buch finden</h2>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="toggleSearch">
                        <li class="active"><a href="#search" data-toggle="tab">suchen</a></li>
                        <li><a href="#browse" data-toggle="tab">schmökern</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="search">
                            <form role="form">
                                <input type="text" class="form-control" placeholder="Titel, ISBN oder Stichwort">
                                <button type="button" class="btn btn-primary" id="btnsearchBooks">suchen</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="browse">
                            <ul class="list-inline">
                                <li>Kategorie</li>
                                <li>Alphabet</li>
                                <li>Popularität</li>
                            </ul>

                        </div>
                    </div> 
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Grosse Auswahl</h2>
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
        <div class="col-sm-4" id="registerABook">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Neues Buch registrieren</h2>
                    <form role="form">
                        <input type="text" class="form-control" placeholder="ISBN">
                        <button type="button" class="btn btn-primary" id="btnRegisterBook">registrieren</button>
                        <button type="button" class="btn btn-sm btn-default" id="btnNoISBN">keine ISBN?</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




             
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
        
    $(document).ready(function(){
        
        $('#toggleSearch a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
        });
        
        $("input").prop('required',true).blur(function() {
            
            var key = $(this).prop('name');
            var value = $(this).val();    
                        
            if($(this).val().length<3 || $(this).val==$(this).attr('placeholder')){
                
                
                var msg;
                var type =  $(this).prop('name');
                
                if(type=='email' && value.match(emailRegex)){
                    msg='Bitte geben Sie eine gültige E-Mail-Adresse an.';
                }
                else if(type=='username'){
                    msg='Bitte wählen Sie einen Benutzernamen.';
                }
                else if(type=='password'){
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
                errorCount[$(this).index("#registrationModal [required]")]==0;
                
                
                $.ajax({
                    type: "GET",
                    url: "isAvailable.php",
                    data: {key: key, value: value},
                    beforeSend: function(html) { // this happen before actual call
                        $(this).next('span.note').html('');
                    },
                    success: function(result){ // this happen after we get result
                        if(result!=true){
                            $("#registrationModal input[name='"+result+"']").next('span.note').html("bereits registriert");
                            $("#registrationModal input[name='"+result+"']").next('span.note').addClass('text-danger');
                            $("#registrationModal input[name='"+result+"']").next('span.note').html(msg);
                            $("#registrationModal input[name='"+result+"']").parents("div.form-group").addClass('has-error');
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
              .done(function( msg ) {
                alert( msg );
            });
      }
        
    </script>
  </body>
</html><?php }} ?>
