@extends('layouts.dashboard')
@section('page_heading','MENACES')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LIST MENACES')
            <div class="table-responsive">
                <div align="right">
                    <button type="button" name="add" id="add" class="btn btn-danger" title="Nouveau"><i class="fa fa-plus-square "></i></button>
                </div>
            </div>

            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NOMS</th>
                        <th>DESCRIPTION</th>
                        <th>SOLUTION</th>
                        <th>DU PROTOCOLS</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($menaces as $menace)
                        <tr id="menaces{{$menace->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $menace->nom_menace }}</td>
                            <td>{{ $menace->description_menace }}</td>
                            <td>{{ $menace->solution_menace }}</td>
                            <td>{{ $menace->nom_protocole }}</td>


                        </tr>
                    @endforeach



                    </tbody>
                </table>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>

@stop