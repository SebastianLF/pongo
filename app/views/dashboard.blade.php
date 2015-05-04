@if ($user->devise == 'non')
    @include('modal_welcome')
@endif
@extends('template')


@section('contenu')
	<div class="avatar">

					</div>
		<nav class="navbar navbar-default" role="navigation">
		
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
      <a class="navbar-brand" href="#">
      	
        
      </a>
    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    
		      <ul class="nav navbar-nav">
		          <li class="active"><a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-list-alt"></span>Dashboard</a></li>
		          <li class=""><a href="{{url('stats')}}"><span class="glyphicon glyphicon-signal"></span>Statistiques</a></li>
		          <li class=""><a href="{{url('config')}}"><span class="glyphicon glyphicon-cog"></span>Configuration</a></li>
		          <li class=""><a href="{{url('account')}}"><span class="glyphicon glyphicon-user"></span>Compte</a></li>
		          <li class=""><a href="{{url('test')}}"><span class="glyphicon glyphicon-user"></span>Test</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Somse here</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Separagclink</a></li>
		            <li class="divider"></li>
		            <li><a href="#">One morated link</a></li>
		          </ul>
		        </li>
		      </ul>
		      

		
		</nav>
		
		<header>

			<div class="profilheader ">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-4 profilname pull-left margl100"><span class="pseudo green">edofthedead</span> </div>

						
					</div>
					<div class="row">
						<div class="col-md-4 pull-left datecontainer margl100"><span class="date grey">{{$dt}}  </span></div>
						<div class="col-md-2 alignright  pull-right">
							<div class="soldecontainer">
								<span class="etiquette ">solde: </span></span><span class="number green">{{$user->bankroll_actuelle_total}}</span><span class="number green"> {{$user->devise}} </span>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-4 pull-left margl100"><span class="flag">15:30</span><span class="pays">PM</span></div>
						
					</div>
				</div>
			</div>
		</header>
		<section>

		 @include('bet.lastbets')
		 @include('bet.addbet')
		 @include('dashboard.bookmakers');
            <div class="col-md-3 pull-right">
                <div class="panel panel-default ">
                    <div class="panel-heading bcgblack colorwhite">Cumul unités Mois en cours</div>
                    <div class="panel-body">
                        @include('dashboard.profitmonth')
                    </div>
                </div>
            </div>
		</section>


@stop