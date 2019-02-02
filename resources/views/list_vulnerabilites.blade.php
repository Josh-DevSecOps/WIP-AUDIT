@extends('layouts.dashboard')
@section('page_heading','VULNERABILITES')
@section('section')

<div class="row">
    <div class="table-responsive">
        <div align="right">
            <button type="button" id="add" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></button>
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
                <th>STATUS RISK</th>
                <th>MENACES</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>

            @foreach($vulnerabilites as $vulnerabilite)
            <tr id="vulnerabilites{{$vulnerabilite->id}}" class="success">
                <td>{{ isset($i)? ++$i : $i=1 }}</td>
                <td>{{ $vulnerabilite->nom_vulnerabilite }}</td>
                <td>{{ $vulnerabilite->description_vulnerabilite }}</td>
                <td>{{ $vulnerabilite->methodetoutils_vulnerabilite }}</td>
                <td>{{ $vulnerabilite->impact_vulnerabilite }}</td>
                <td>{{ $vulnerabilite->solution_vulnerabilite }}</td>
                <td>{{ $vulnerabilite->probabilite_risk }}</td>
                <td>{{ $vulnerabilite->impact_risk }}</td>
                <td>{{ $vulnerabilite->libelle }}</td>
                <td>{{ $vulnerabilite->nom_menace }}</td>
                <td>
                    <button class="btn btn-primary btn-default" name="edit" id="edit" data-target="#add_data_Modal" data-id="{{ $vulnerabilite->id }}"title="voir"><i class="fa fa-list"></i></button>
                    <button class="btn btn-warning btn-danger" data-id="{{ $vulnerabilite->id }}" title="Supprimer"><i class="fa fa-times"></i></button>

                </td>


            </tr>
            @endforeach



            </tbody>
        </table>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
    </div>
</div>

@stop

@section('modal_content')
    <div class="modal fade" id="myModal" role="dialog">
        <form  id="insert_form" method="POST" action="NewVulnerabilites">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enregistrement d'une Vulnérabilité</h4>
                    </div>

                    <div class="modal-body">

                    {{ csrf_field() }}

                    <!-- champ cache -->
                        <input type="hidden"  id="vulnerabiliteid" name="id">

                        <!-- Champ menaces -->

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">LIBELLE</label>
                            <input type="text" name="nom_vulnerabilite" class="form-control" id="nom_vulnerabilite_id" placeholder="Entrez le nom de menace">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">DESCRIPTION</label>
                            <input type="text" name="description_vulnerabilite" class="form-control" id="description_vulnerabilite_id" placeholder="Entrez la description de la menace">

                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">METHODE/OUTILS</label>
                            <input type="text" name="methodetoutils_vulnerabilite" class="form-control" id="methodetoutils_vulnerabilite_id" placeholder="Entrez la solution de cette menace">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">IMPACT VULNERABILITE</label>
                            <input type="text" name="impact_vulnerabilite" class="form-control" id="impact_vulnerabilite_id" placeholder="Entrez la solution de cette menace">
                        </div>

                        <!--<div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">METHODE/OUTILS</label>
                            <input type="text" name="methodetoutils_vulnerabilite" class="form-control" id="methodetoutils_vulnerabilite_id" placeholder="Entrez la solution de cette menace">
                        </div>-->

                        <div class="form-group">
                            <label>Quel est Sa Probabilité</label>
                            <select class="form-control" name="probabilite_risk" id="probabilite_risk_id">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>

                            </select>
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">IMPACT RISK</label>
                            <input type="text" name="impact_risk" class="form-control" id="impact_risk_id" placeholder="Entrez la solution de cette menace">
                        </div>

                        <div class="form-group has-feedback">
                            <label class="control-label" for="inputSuccess">RISK STATUS</label>
                            <select class="form-control has-success" name="riskstatus_id" id="riskstatus_id">
                                <option value="">-----------------QU'ELLE EST LE RISK STATUS ---------------</option>
                                @foreach($statusrisks as $statusrisk)
                                    <option value="{{ $statusrisk->id }}">{{ $statusrisk->libelle }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group has-feedback">
                            <label class="control-label" for="inputSuccess">MENACES</label>
                            <select class="form-control has-success" name="menace_id" id="menace_id">
                                <option value="">-----------------QU'ELLE EST LA MENACE ---------------</option>
                                @foreach($menaces as $menace)
                                    <option value="{{ $menace->id }}">{{ $menace->nom_menace }}</option>
                                @endforeach
                            </select>

                        </div>


                    </div>

                    <div class="modal-footer">
                        <input type="submit" id="save" value="Save" class="btn btn-primary">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#save').val('save');
            //alert("test");
            $('#insert_form').trigger('reset');
            $('#insert_form').on('submit', function (e) {
                e.preventDefault();
                // alert("form");

                var url = $('#insert_form').attr('action');
                var data = $('#insert_form').serialize();
                var type = 'POST';
                var statut = $('#save').val();

                 alert(data);
                if( statut == 'modifier')
                {
                    type = 'PUT';
                    //data += '&id='+$(this).data('id');
                }
                if($('#nom_vulnerabilite_id').val()=='')
                {
                    alert("the name vulnerabilite is requred");
                }
                else if($('#description_vulnerabilitie_id').val()=='')
                {
                    alert("the description vulnerabilitie is requred");
                }
                else if($('#methodetoutils_vulnerabilite_id').val()=='')
                {
                    alert("the methode/outils vulnerabilite is requred");
                }
                else if($('#impact_vulnerabilite_id').val()=='')
                {
                    alert("the impact vulnerabilitie is requred");
                }
                else if($('#solution_vulnerabilite_id').val()=='')
                {
                    alert("the solution vulnerabilitie is requred");
                }
                else if($('#probabilite_risk_id').val()=='')
                {
                    alert("the probability vulnerabilitie is requred");
                }
                else if($('#riskstatus_id').val()=='')
                {
                    alert("the risk status vulnerabilitie is requred");
                }
                else if($('#menace_id').val()=='')
                {
                    alert("the menace vulnerabilitie is requred");
                }
                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);




                            var row = '<tr id="vulnerabilites'+ data.id+'" >' +
                                '<td>' + data.nom_vulnerabilite + '</td>' +
                                '<td>' + data.description_vulnerabilite + '</td>' +
                                '<td>' + data.methodetoutils_vulnerabilite + '</td>' +
                                '<td>' + data.impact_vulnerabilite + '</td>' +
                                '<td>' + data.solution_vulnerabilite + '</td>' +
                                '<td>' + data.probabilite_risk + '</td>' +
                                '<td>' + data.impact_risk + '</td>' +
                                '<td>' + $('#riskstatus_id > option[value='+data.riskstatus_id+']').text()  + '</td>' +
                                '<td>' + $('#menace_id > option[value='+data.menace_id+']').text()  + '</td>' +
                                '<td>' +
                                '<button class="btn btn-primary btn-default" data-id="' + data.id + '" title="voir"><i class="fa fa-list"></i></button> ' +
                                '<button class="btn btn-warning btn-danger" data-id="' + data.id + '"title="Supprimer"><i class="fa fa-times"></i></button>'+
                                '</td>'+
                                '</tr>';
                            if (statut == 'save') {
                                $('tbody').prepend(row);
                            }
                            else
                            {
                                $('#vulnerabilites'+ data.id).replaceWith(row);
                                $('#myModal').modal('hide');

                            }

                        }

                    });



                    //---------reset_forms--------------------
                    $(this).trigger('reset');
                }

                return false;
            });
        });


        //------------------delete action--------------------
        $('tbody').delegate('.btn-danger','click',function () {

            var value= $(this).data('id');
            var url = '{{ URL::to('/deleteMenaces') }}';
            //alert(value);
            if(confirm("etez vous sure de vouloir Supprimer")==true){

                $.ajax({
                    type : 'post',
                    url : url,
                    data : {'id':value},
                    success:function () {
                        $('#vulnerabilites'+value).remove();

                    }
                });
            }

        });


        //--------update  action-------------------------------
        $('tbody').delegate('.btn-default','click',function () {


            var value = $(this).data('id');
            var url = '{{ URL::to('listMenaces') }}';

           // alert(value);

            $.ajax({
                type : 'get',
                url : url,
                data : {'id':value},




                success:function (data) {  console.log(data)
                    $('#nom_vulnerabilite_id').val(data.nom_vulnerabilite);
                    $('#description_vulnerabilite_id').val(data.description_vulnerabilite);
                    $('#methodetoutils_vulnerabilite_id').val(data.methodetoutils_vulnerabilite);
                    $('#impact_vulnerabilite_id').val(data.impact_vulnerabilite);
                    $('#solution_vulnerabilite_id').val(data.solution_vulnerabilite);
                    $('#probabilite_risk_id').val(data.probabilite_risk);
                    $('#impact_risk_id').val(data.impact_risk);
                    $('#riskstatus_id').val(data.statusrisk_id);
                    $('#menace_id').val(data.menace_id);
                    $('#vulnerabiliteid').val(data.id);
                    $('#save').val('modifier');
                    $('#myModal').modal('show');

                },error:function(){
                    alert("error!!!!");
                }

            });

        });


    </script>


@endsection
