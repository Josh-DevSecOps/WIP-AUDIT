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
                        <th>LIBELLE</th>
                        <th>VALEUR</th>
                        <th>ACTION</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($riskstatus as $risk)
                        <tr id="riskstatus{{$risk->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $risk-> libelle}}</td>
                            <td>{{ $risk-> valeur}}</td>
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
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="5">6</option>
                                <option value="5">7</option>
                                <option value="5">8</option>
                                <option value="5">9</option>
                                <option value="5">10</option>
                                <option value="5">11</option>
                                <option value="5">12</option>
                                <option value="5">13</option>
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


