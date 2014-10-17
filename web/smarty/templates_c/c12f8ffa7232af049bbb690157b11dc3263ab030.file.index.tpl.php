<?php /* Smarty version Smarty-3.1.19, created on 2014-10-17 18:46:14
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:688154406031bda950-11523684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c12f8ffa7232af049bbb690157b11dc3263ab030' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1413554416,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1413564289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '688154406031bda950-11523684',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54406031c930b9_03068634',
  'variables' => 
  array (
    'alert_info' => 0,
    'alert_warning' => 0,
    'mainPage' => 0,
    'isLoggedIn' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54406031c930b9_03068634')) {function content_54406031c930b9_03068634($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

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
        <?php if (isset($_smarty_tpl->tpl_vars['alert_info']->value)) {?>
            <div class="alert alert-info" role="alert">
                <?php echo $_smarty_tpl->tpl_vars['alert_info']->value;?>

                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['alert_warning']->value)) {?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_smarty_tpl->tpl_vars['alert_warning']->value;?>

                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        <?php }?>
        <div class="container">
            

            <header>
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['mainPage']->value;?>
"><img src="img/v2.png" class="img-responsive"></a>
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
                    <form class="form-horizontal" role="form" action="index.php" method="POST" name="registration_form">
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
                <?php if (!isset($_smarty_tpl->tpl_vars['isLoggedIn']->value)) {?>
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
                
                <?php } else { ?>
                    <a href="index.php?logout=true" class="btn btn-warning" id="logoutBtn" role="button">Abmelden</a>
                <?php }?>



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
                            <form role="form" action="index.php" method="get">
                                <input type="text" class="form-control" name="search_book" placeholder="Titel, ISBN oder Stichwort">
                                <button type="submit" class="btn btn-primary" id="btnsearchBooks">suchen</button>
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Titel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars['book'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['book']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['books']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['book']->key => $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->_loop = true;
?>
                                    <tr> 
                                        <td><?php echo $_smarty_tpl->tpl_vars['book']->value['id_isbn'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
    <script src="templates/js/forms.js"></script>
    <script src="templates/js/sha512.js"></script>
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

    function registrate(){
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
          
    </script>
</body>
</html><?php }} ?>
