{{var_dump($inputs)}}
{{var_dump($posts)}}
<div class="portlet box green-meadow">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Les selections choisies pour ce ticket  <span class="pull-right glyphicon glyphicon-refresh glyphicon-spin"></span>
        </div>
    </div>
    <div class="portlet-body form form-automatic">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>
                        game_time
                    </th>
                    <th>
                        sport_id
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td>
                        <button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
