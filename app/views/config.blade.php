@extends('templatenav')

@section('contenu')

		<div class="container configwrap">
		    @include('tipsters.tipsters')
			@include('bookmakers.bookmakers')
			@include('transactions.transactions')
		</div>
@stop
