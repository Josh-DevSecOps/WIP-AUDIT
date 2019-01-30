@extends('layouts.dashboard')
@section('page_heading','RISK STATUS')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LIST RISK STATUS')
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
                        <th>LIBELLE</th>
                        <th>VALEUR</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($riskstatus as $risk)
                        <tr id="riskstatus{{$risk->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $risk-> libelle}}</td>
                            <td>{{ $risk-> valeur}}</td>


                        </tr>
                    @endforeach



                    </tbody>
                </table>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>

@stop