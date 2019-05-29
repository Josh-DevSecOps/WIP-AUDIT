@extends('layouts.dashboard')
@section('page_heading','RISK STATUS')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LIST RISK STATUS')
            <div class="table-responsive">
                <div align="right">

                    <button type="button" id="add" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></button>

                   <!-- <button type="button" name="add" id="add" class="btn btn-danger" title="Nouveau"><i class="fa fa-plus-square"></i></button>-->
                </div>
            </div>


            @section ('cotable_panel_body')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>VALEUR</th>
                        <th>LIBELLE</th>
                        <th>CONSEQUENCE</th>
                        <th>ACTIONS-CORRECTRICES</th>
                        <th>ACTION</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($riskstatus as $risk)
                        <tr id="riskstatus{{$risk->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $risk-> valeur}}</td>
                                @if ($risk-> libelle == "Faible" )
                                <td style="background-color: green">{{ $risk-> libelle}}</td>
                                  @elseif($risk-> libelle == "Moyen")
                                <td style="background-color: blue">{{ $risk-> libelle}}</td>
                                    @elseif($risk-> libelle == "Eleve")
                                <td style="background-color: orange">{{ $risk-> libelle}}</td>
                            @else
                                <td style="background-color: red">{{ $risk-> libelle}}</td>
                                @endif

                            <td>{{ $risk-> consequence}}</td>
                            <td>{{ $risk-> actions}}</td>
                            <td>
                                <button class="btn btn-primary btn-default" name="edit" id="edit" data-target="#add_data_Modal" data-id="{{ $risk->id }}"title="voir"><i class="fa fa-list"></i></button>
                                <button class="btn btn-warning btn-danger" data-id="{{ $risk->id }}" title="Supprimer"><i class="fa fa-times"></i></button>

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
        <form  id="insert_form" method="POST" action="NewStatusRisks">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enregistrement d'un Risk Statut</h4>
                </div>

                <div class="modal-body">

                {{ csrf_field() }}

                <!-- champ cache -->
                    <input type="hidden"  id="riskstatusid" name="id">

                    <!-- Champ Protocols -->

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">LIBELLE</label>
                            <input type="text" name="libelle" class="form-control" id="libelle_id" placeholder="Entrez la denomination du risk statut">
                        </div>

                    <!--<div class="form-group has-success">
                        <label class="control-label" for="inputSuccess">LIBELLE</label>
                        <input type="text" name="valeur" class="form-control" id="valeur_id" placeholder="Entrez la denomination du risk statut">
                    </div>-->

                        <div class="form-group">
                            <label>Quel est sa valeur</label>
                            <select class="form-control" name="valeur" id="valeur_id">
                                <option value="1">1</option>
                                <option value="2-4">2-4</option>
                                <option value="6-8">6-8</option>
                                <option value="12-16">12-16</option>
                            </select>
                        </div>

                    <div class="form-group has-success">
                        <label class="control-label" for="inputSuccess">CONSEQUENCE</label>
                        <input type="text" name="consequence" class="form-control" id="consequence_id" placeholder="Entrez la consequence du risk statut">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label" for="inputSuccess">ACTION</label>
                        <textarea rows="4" cols="50" name="actions" class="form-control" id="action_id" placeholder="Entrez l'action du risk statut">   </textarea>

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

                // alert(data);
                if( statut == 'modifier')
                {
                    type = 'PUT';
                    //data += '&id='+$(this).data('id');
                }
                if($('#libelle_id').val()=='')
                {
                    alert("the libelle is requred");
                }
                else if($('#valeur_id').val()=='')
                {
                    alert("the valeur is requred");
                }
                if($('#consequence_id').val()=='')
                {
                    alert("the consequence is requred");
                }
                else if($('#action_id').val()=='')
                {
                    alert("the action is requred");
                }
                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);


                            var row = '<tr id="riskstatus'+ data.id+'" >' +
                                '<td>' + data.libelle + '</td>' +
                                '<td>' + data.valeur + '</td>' +
                                '<td>' + data.consequence + '</td>' +
                                '<td>' + data.actions + '</td>' +
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
                                $('#riskstatus'+ data.id).replaceWith(row);
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
            var url = '{{ URL::to('/deleteStatusRisks') }}';
            //alert(value);
            if(confirm("etez vous sure de vouloir Supprimer")==true){

                $.ajax({
                    type : 'post',
                    url : url,
                    data : {'id':value},
                    success:function () {
                        $('#riskstatus'+value).remove();

                    }
                });
            }

        });


        //--------update  action-------------------------------
        $('tbody').delegate('.btn-default','click',function () {

            var value = $(this).data('id');
            var url = '{{ URL::to('listStatusRisks') }}';

            // alert(value);

            $.ajax({
                type : 'get',
                url : url,
                data : {'id':value},

                success:function (data) {  console.log(data)
                    $('#action_id').val(data.actions);
                    $('#consequence_id').val(data.consequence);
                    $('#libelle_id').val(data.libelle);
                    $('#valeur_id').val(data.valeur);
                    $('#riskstatusid').val(data.id);
                    $('#save').val('modifier');
                    $('#myModal').modal('show');

                },error:function(){
                    alert("error!!!!");
                }

            });

        });


    </script>


@endsection


