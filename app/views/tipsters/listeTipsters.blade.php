
        <div class="table-scrollable table-scrollable-borderless">
            <table id="tipsterstable" class="table table-hover table-light">
                <thead>
                <tr class="uppercase">
                    <th colspan="">Nom</th>
                    <th>Suivi</th>
                    <th>Indice</th>
                    <th>Montant par indice</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipsters as $tipster)
                    <tr>
                        <td class="idtipstertd hidden">{{$tipster->id}}</td>
                        <td class="name">{{$tipster->name}}</td>
                        <td>

                            @if($tipster->followtype == 'n')
                                <span class="">{{ 'normal' }}</span>
                            @else
                                <span class="">{{ 'à blanc' }}</span>
                            @endif
                        </td>
                        <td>{{$tipster->indice_unite}}</td>
                        <td class="">
                            <span class="bold theme-font">{{number_format($tipster->montant_par_unite, 2, '.', ',' )}}</span>
                            <span class="bold theme-font">{{$user->devise}}</span>
                        </td>

                        <td>
                            <div class="action-tipster-btn ">
                                <button type="button" class="tipsterEditButton btn btn-sm bg-yellow-saffron"
                                        data-target="#tipsterEditModal" data-toggle="modal" data-id="{{$tipster->id}}"
                                        data-name="{{$tipster->name}}" data-indice="{{$tipster->indice_unite}}"
                                        data-mt="{{$tipster->montant_par_unite}}" data-suivi="{{$tipster->followtype}}">

                                    <i
                                            class="fa fa-pencil-square-o fa-2x"></i></button>
                                <button type="button" class="tipsterDeleteButton btn btn-sm red"><i
                                            class="fa fa-trash-o fa-2x"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$tipsters->links()}}



