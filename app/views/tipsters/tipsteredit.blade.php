@extends('templatenav')


@section('contenu')
<div class="container">
    <div class="panel panel-default ">

        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{$tipster->name}}</strong></h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-info" role="alert">
                <dl class="dl-horizontal">
                    <dt>Indice:</dt>
                    <dd>Correspond a l'indice de confiance maximum donné par le tipster, généralement 10. Example: 10
                        pour 2/10, 5 pour 2/5.
                    </dd>
                    <dt>Montant par unité:</dt>
                    <dd>Correspond au montant alloué pour 1 unité. Example: Pour un tipster avec un indice maximum de
                        10, si le montant par unité est 40€ alors 1/10 = 40€, 2/10 = 80€.
                    </dd>
                    <dt>Suivi:</dt>
                    <dd>Si vous choisissez le type de suivi <strong>à blanc</strong> pour un tipster, les gains et
                        pertes ne seront pas comptabilisés dans vos bankrolls. Ce type de suivi convient lorsqu'on veut
                        tester l'efficacité d'un nouveau tipster.
                    </dd>
                </dl>
            </div>
            {{ Form::open(array('url' => 'tipster/'.$id, 'method' => 'put', 'id' => 'tipsterform-edit', 'class' => '',
            'role' => 'form')) }}

            <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
                <div class="namemodifcontainer form-group">
                    <label for="namemodifinput">nom :</label>
                    <small class="text-danger">{{ $errors->tipsters->first('followtypeselect') }}</small>
                    <input id="namemodifinput" type="text" name="namemodifinput" class="form-control"
                           value="{{ $tipster->name }}">
                </div>


                <div class="stakeindicatormodifcontainer form-group">
                    <label for="staketypemodifselect">Indice :</label>
                    <small class="text-danger">{{ $errors->tipsters->first('followtypeselect') }}</small>
                    <select id="staketypemodifselect" name="staketypemodifselect" class="form-control">
                        @if ($tipster->indice_unite == '3')

                            <option selected="selected">3</option>
                            <option>5</option>
                            <option>10</option>
                        @elseif ($tipster->indice_unite == '5')
                            <option>3</option>
                            <option selected="selected">5</option>
                            <option>10</option>
                        @else
                            <option>3</option>
                            <option>5</option>
                            <option selected="selected">10</option>
                        @endif
                    </select>
                </div>


                <div class="stakeamountmodifcontainer form-group">
                    <label for="unitnumbermodifinput">montant par unité en {{$user->devise}}</label>
                    <small class="text-danger">{{ $errors->tipsters->first('followtypeselect') }}</small>
                    <input id="unitnumbermodifinput" name="unitnumbermodifinput" class="form-control" placeholder="0.00"
                           value="{{ $tipster->montant_par_unite }}">
                </div>


                <div class="followmodifcontainer form-group">
                    <label for="followtypemodifselect">suivi :</label>
                    <small class="text-danger">{{ $errors->tipsters->first('followtypeselect') }}</small>
                    <select id="followtypemodifselect" name="followtypemodifselect" class="form-control">
                        @if($tipster->followtype == 'n')
                            <option value="n" selected="selected">normal</option>
                            <option value="b">à blanc</option>
                        @else
                            <option value="n">normal</option>
                            <option value="b" selected="selected">à blanc</option>
                        @endif
                    </select>
                </div>
                <input id="tipsterformmodifinput" value="Enregistrer" type="submit"
                       class="btn btn-success center-block"/>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <a href="{{url('config')}}" class="btn btn-default">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </a>
</div>


@stop