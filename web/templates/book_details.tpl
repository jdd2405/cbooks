{extends file="layout.tpl"}

{block name=body}

<h2>Details zum Buch: "{$details["title"]}"</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>ISBN</th>
                    <td>{$details["id_isbn"]}</td>
                </tr>
                <tr>
                    <th>Titel</th>
                    <td>{$details["title"]}</td>
                </tr>
                <tr>
                    <th>Subtitle</th>
                    <td>{$details["subtitle"]}</td>
                </tr>
                <tr>
                    <th>Blurb</th>
                    <td>{$details["blurb"]}</td>
                </tr>
                <tr>
                    <th>Reg-Date</th>
                    <td>{$details["reg_date"]}</td>
                </tr>
            </tbody>
                   
        </table>
    </div>


{/block}