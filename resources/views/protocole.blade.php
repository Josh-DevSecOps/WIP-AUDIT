{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nom_protocole', 'Nom_protocole:') !!}
			{!! Form::text('nom_protocole') !!}
		</li>
		<li>
			{!! Form::label('description_protocole', 'Description_protocole:') !!}
			{!! Form::text('description_protocole') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}