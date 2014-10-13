{extends file="layout.tpl"}
{$title="Start"}

{block name=body}
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
                            <form role="form" action="searchBook.php" method="get">
                                <input type="text" class="form-control" name="input" placeholder="Titel, ISBN oder Stichwort">
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
                    <table>
                        {for $row=0 to $number-1}
                            <tr>
                            {for $col=0 to 3}   
                            <td>{$array[$row][$col]}</td>
                            {/for}
                            </tr>
                        {/for}
                    </table>
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



{/block}