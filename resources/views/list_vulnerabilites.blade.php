@extends('layouts.dashboard')
@section('page_heading','VULNERABILITES')
@section('section')

<div class="row">
    <div class="table-responsive">
        <div align="right">
            <button type="button" name="add" id="add" class="btn btn-danger" title="Nouveau"><i class="fa fa-plus-square "></i></button>
        </div>
    </div>
    <div class="col-sm-12">
        @section ('cotable_panel_title','LIST VULNERABILITE')

        @section ('cotable_panel_body')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>nom</th>
                <th>description</th>
                <th>methode/outils</th>
                <th>impact</th>
                <th>solution</th>
                <th>probabilite</th>
                <th>impact_risk</th>
                <th>statusrisk_id</th>
                <th>menace_id</th>
            </tr>
            </thead>
            <tbody>

            @foreach($vulnerabilites as $vulnerabilite)
            <tr id="vulnerabilites{{$vulnerabilite->id}}" class="success">
                <td>{{ isset($i)? ++$i : $i=1 }}</td>
                <td>{{ $menace->nom_vulnerabilite }}</td>
                <td>{{ $menace->description_vulnerabilite }}</td>
                <td>{{ $menace->methodetoutils_vulnerabilite }}</td>
                <td>{{ $menace->impact_vulnerabilite }}</td>
                <td>{{ $menace->solution_vulnerabilite }}</td>
                <td>{{ $menace->probabilite_risk }}</td>
                <td>{{ $menace->impact_risk }}</td>
                <td>{{ $menace->libelle }}</td>
                <td>{{ $menace->nom_menace }}</td>


            </tr>
            @endforeach



            </tbody>
        </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
    </div>
</div>

@stop