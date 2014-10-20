<?php /* Smarty version Smarty-3.1.19, created on 2014-10-19 22:48:30
         compiled from ".\templates\portal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:399554413399d47368-47407425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4253afb3894b7a9902785d07106d7d3552e79145' => 
    array (
      0 => '.\\templates\\portal.tpl',
      1 => 1413751705,
      2 => 'file',
    ),
    '8620cc399623b7da78926aa888aaa5d8bcbb56e4' => 
    array (
      0 => '.\\templates\\layout.tpl',
      1 => 1413750142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '399554413399d47368-47407425',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5441339a01fe69_06165277',
  'variables' => 
  array (
    'alert_info' => 0,
    'alert_warning' => 0,
    'mainPage' => 0,
    'isLoggedIn' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5441339a01fe69_06165277')) {function content_5441339a01fe69_06165277($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

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
                        

    <h2>Herzlich Willkommen<?php if ($_smarty_tpl->tpl_vars['user']->value->first_name!='') {?>,<?php }?> <?php echo $_smarty_tpl->tpl_vars['user']->value->first_name;?>
</h2>
    <address>
        <dl class="dl-horizontal">
            <dt>Adresse</dt>
            <dd>
                <?php echo $_smarty_tpl->tpl_vars['user']->value->street;?>
<br>
                <?php echo $_smarty_tpl->tpl_vars['user']->value->zip;?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value->city;?>

            </dd>
            <dt>E-Mail</dt>
            <dd><?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
</dd>
            <dt>Telefon</dt>
            <dd><?php echo $_smarty_tpl->tpl_vars['user']->value->tel;?>
</dd>
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
                                <input type="text" class="form-control " name="updateFirst_name" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->first_name;?>
" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="updateFamily_name" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->family_name;?>
" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateStreet" class="col-sm-4 control-label">Strasse</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="updateStreet" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->street;?>
" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateCity" class="col-sm-4 control-label">Ort</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control " name="updateZIP" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->zip;?>
" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " name="updateCity" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->city;?>
" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateEmail" class="col-sm-4 control-label">E-Mail</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control " name="updateEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
" required>
                                <span class="note"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateTel" class="col-sm-4 control-label">Telefon</label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control " name="updateTel" placeholder="<?php echo $_smarty_tpl->tpl_vars['user']->value->tel;?>
" required>
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




                            



                    </div>
                </div>
                <div class="login-buttons">
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
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span> Einstellungen</button>
                        <a href="index.php?logout=true" class="btn btn-warning" id="logoutBtn" role="button">Abmelden</a>
                    <?php }?>
                </div>


            </div>

        

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
