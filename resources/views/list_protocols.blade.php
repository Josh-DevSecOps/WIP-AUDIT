@extends('layouts.dashboard')
@section('page_heading','PROTOCOLS')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LISTS PROTOCOLS')
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
                        <th>NOMS PROTOCOLS</th>
                        <th>DESCRIPTION PROTOCOLS</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($protocols as $protocol)
                        <tr id="protocols{{$protocol->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $protocol->nom_protocole }}</td>
                            <td>{{ $protocol->description_protocole }}</td>


                        </tr>
                    @endforeach



                    </tbody>
                </table>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
        </div>
    </div>

@stop