{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nom_menace', 'Nom_menace:') !!}
			{!! Form::text('nom_menace') !!}
		</li>
		<li>
			{!! Form::label('description_menace', 'Description_menace:') !!}
			{!! Form::text('description_menace') !!}
		</li>
		<li>
			{!! Form::label('solution_menace', 'Solution_menace:') !!}
			{!! Form::text('solution_menace') !!}
		</li>
		<li>
			{!! Form::label('protocole_id', 'Protocole_id:') !!}
			{!! Form::text('protocole_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}