@extends('layouts.dashboard')
@section('page_heading','MENACES')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LIST MENACES')
            <div class="table-responsive">
                <div align="right">
                    <button type="button" id="add" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></button>
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
                        <th>VALEUR RISQUE</th>
                        <th>ACTION</th>

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
                            <td>{{ $menace->id }}</td>
                            <td>
                                <button class="btn btn-primary btn-default" name="edit" id="edit" data-target="#add_data_Modal" data-id="{{ $menace->id }}"title="voir"><i class="fa fa-list"></i></button>
                                <button class="btn btn-warning btn-danger" data-id="{{ $menace->id }}" title="Supprimer"><i class="fa fa-times"></i></button>

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
        <form  id="insert_form" method="POST" action="NewMenaces">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enregistrement d'une menace</h4>
                    </div>

                    <div class="modal-body">

                    {{ csrf_field() }}

                    <!-- champ cache -->
                        <input type="hidden"  id="menaceid" name="id">

                        <!-- Champ menaces -->

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">LIBELLE</label>
                            <input type="text" name="nom_menace" class="form-control" id="nom_menace_id" placeholder="Entrez le nom de menace">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">DESCRIPTION</label>
                            <input type="text" name="description_menace" class="form-control" id="description_menace_id" placeholder="Entrez la description de la menace">

                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">SOLUTION</label>
                            <input type="text" name="solution_menace" class="form-control" id="solution_menace_id" placeholder="Entrez la solution de cette menace">
                        </div>

                        <div class="form-group has-feedback">
                            <select class="form-control has-success" name="protocole_id" id="protocole_id">
                                <option value="">-----------------CETTE MENACE APPARTIENT AU PROTOCOLE ---------------</option>
                                @foreach($protocoles as $protocole)
                                    <option value="{{ $protocole->id }}">{{ $protocole->nom_protocole }}</option>
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

                // alert(data);
                if( statut == 'modifier')
                {
                    type = 'PUT';
                    //data += '&id='+$(this).data('id');
                }
                if($('#nom_menace_id').val()=='')
                {
                    alert("the menace is requred");
                }
                else if($('#description_menace_id').val()=='')
                {
                    alert("the description menace is requred");
                }
                else if($('#solution_menace_id').val()=='')
                {
                    alert("the solution  menace is requred");
                }
                else if($('#protocole_id').val()=='')
                {
                    alert("the protocole menace is requred");
                }
                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);


                            var row = '<tr id="menaces'+ data.id+'" >' +
                                '<td>' + data.nom_menace + '</td>' +
                                '<td>' + data.description_menace + '</td>' +
                                '<td>' + data.solution_menace + '</td>' +
                                '<td>' + $('#protocole_id > option[value='+data.protocole_id+']').text()  + '</td>' +                                '<td>' +
                                '<button class="btn btn-primary btn-default" data-id="' + data.id + '" title="voir"><i class="fa fa-list"></i></button> ' +
                                '<button class="btn btn-warning btn-danger" data-id="' + data.id + '"title="Supprimer"><i class="fa fa-times"></i></button>'+
                                '</td>'+
                                '</tr>';
                            if (statut == 'save') {
                                $('tbody').prepend(row);
                            }
                            else
                            {
                                $('#menaces'+ data.id).replaceWith(row);
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
                        $('#menaces'+value).remove();

                    }
                });
            }

        });


        //--------update  action-------------------------------
        $('tbody').delegate('.btn-default','click',function () {


            var value = $(this).data('id');
            var url = '{{ URL::to('listMenaces') }}';

          alert(value);

            $.ajax({
                type : 'get',
                url : url,
                data : {'id':value},

                success:function (data) {  console.log(data)
                    $('#nom_menace_id').val(data.nom_menace);
                    $('#description_menace_id').val(data.description_menace);
                    $('#solution_menace_id').val(data.solution_menace);
                    $('#protocole_id').val(data.protocole_id);
                    $('#menaceid').val(data.id);
                    $('#save').val('modifier');
                    $('#myModal').modal('show');

                },error:function(){
                    alert("error!!!!");
                }

            });

        });


    </script>


@endsection
