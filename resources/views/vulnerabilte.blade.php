{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nom_vulnerabilite', 'Nom_vulnerabilite:') !!}
			{!! Form::text('nom_vulnerabilite') !!}
		</li>
		<li>
			{!! Form::label('description_vulnerabilite', 'Description_vulnerabilite:') !!}
			{!! Form::text('description_vulnerabilite') !!}
		</li>
		<li>
			{!! Form::label('methodetoutils_vulnerabilite', 'Methodetoutils_vulnerabilite:') !!}
			{!! Form::text('methodetoutils_vulnerabilite') !!}
		</li>
		<li>
			{!! Form::label('impact_vulnerabilite', 'Impact_vulnerabilite:') !!}
			{!! Form::text('impact_vulnerabilite') !!}
		</li>
		<li>
			{!! Form::label('solution_vulnerabilite', 'Solution_vulnerabilite:') !!}
			{!! Form::text('solution_vulnerabilite') !!}
		</li>
		<li>
			{!! Form::label('probabilite_risk', 'Probabilite_risk:') !!}
			{!! Form::text('probabilite_risk') !!}
		</li>
		<li>
			{!! Form::label('impact_risk', 'Impact_risk:') !!}
			{!! Form::text('impact_risk') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}