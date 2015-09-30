    @extends('layouts.default', array('title' => 'Tipsters', 'page_title_small' => 'ajouter,supprimer & modifier'))

    @section('content')
        @include('tipster_edit_modal')
        @include('tipster_add_modal')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="fa fa-cogs font-green-sharp"></i>
                                <span class="caption-subject theme-font bold uppercase">Tipsters</span>
                                <span class="caption-helper">Configuration</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="note note-success ">
                                <dl class="dl-horizontal">
                                    <dt>Suivi:</dt>
                                    <dd>Si vous choisissez le type de suivi <strong>à blanc</strong> pour un tipster, les
                                        gains
                                        et pertes ne seront pas comptabilisés dans vos bankrolls des bookmakers. Ce type de
                                        suivi
                                        convient
                                        lorsqu'on veut tester l'efficacité d'un nouveau tipster.<br> Vous avez la
                                        possibilité de
                                        changer le type de suivi a n'importequel moment. Si vous changez de type de suivi
                                        dans
                                        le
                                        meme mois, le tipster aura deux profils avec ses pertes et/ou profits respectifs.
                                    </dd>
                                    <dt>Montant par unité:</dt>
                                    <dd>Correspond au montant alloué pour 1 unité. Example: Si le montant par unité est 40€
                                        alors 1
                                        unité = 40€, 2 unités = 80€.<br>
                                        Vous avez la possibilité de modifier le montant par unité à n'importequel moment.
                                    </dd>
                                </dl>
                            </div>
                            <button class="btn bg-green-meadow" data-toggle="modal"
                                    data-target="#tipsterAddModal">
                                Ajouter un
                                tipster <span class="glyphicon glyphicon-user"></span>
                            </button>
                            <div class="row">

                                <div id="tipsters-pagination" class="col-md-8 col-md-offset-2">
                                    @if($tipsters->count() == 0)
                                        <div class="text-center">Aucun tipster</div>
                                    @else
                                        <div class="table-scrollable table-scrollable-borderless" w>
                                            <table id="tipsterstable" class="table table-hover table-light">
                                                <thead>
                                                <tr class="uppercase">
                                                    <th width="25%" colspan="">Nom</th>
                                                    <th>Suivi</th>
                                                    <th width="25%">Montant par indice</th>
                                                    <th width="25%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tipsters as $tipster)
                                                    <tr>
                                                        <td class="idtipstertd hidden">{{$tipster->id}}</td>
                                                        <td class="name"><img alt="" class="user img-circle" src="{{asset('img/unknown.jpg')}}" width="25px">{{' '.$tipster->name}}</td>
                                                        <td>

                                                            @if($tipster->followtype == 'n')
                                                                <span class="">{{ 'normal' }}</span>
                                                            @else
                                                                <span class="">{{ 'à blanc' }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="">
                                                            <span class="bold theme-font">{{round($tipster->montant_par_unite, 2)}}</span>
                                                            <span class="bold theme-font">{{Auth::user()->devise}}</span>
                                                        </td>

                                                        <td>
                                                            <div class="action-tipster-btn ">
                                                                <button type="button" class="tipsterEditButton btn btn-sm bg-yellow-saffron"
                                                                        data-target="#tipsterEditModal" data-toggle="modal" data-id="{{$tipster->id}}"
                                                                        data-name="{{$tipster->name}}"
                                                                        data-mt="{{round($tipster->montant_par_unite, 2)}}" data-suivi="{{$tipster->followtype}}">

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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        @parent
        <script src="{{asset('build/js/welcome.js')}}" type="text/javascript"></script>
    @stop
