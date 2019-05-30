@extends('layouts.dashboard')
@section('page_heading','EXPERIENCES')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LIST EXPERIENCES')
            <div class="table-responsive">
                <div align="right">
                    <button type="button" id="add" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></button>
                </div>
            </div>

            @section ('cotable_panel_body')
                <table id="data-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMS </th>
                                <th>DESCRIPTION</th>
                                <th>ACTION</th>
                            </tr>

                        </thead>
                    <tbody>


                    @foreach($experiences as $experience)
                        <tr id="experiences{{$experience->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $experience->name }}</td>
                            <td>{{ $experience->description }}</td>
                            <td>
                                <button class="btn btn-primary btn-default" name="edit" id="edit" data-target="#add_data_Modal" data-id="{{ $experience->id }}"title="voir"><i class="fa fa-list"></i></button>
                                <button class="btn btn-warning btn-danger" data-id="{{ $experience->id }}" title="Supprimer"><i class="fa fa-times"></i></button>

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
        <form  id="insert_form" method="POST" action="NewExperiences">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enregistrement d'une experience</h4>
                    </div>

                    <div class="modal-body">

                    {{ csrf_field() }}

                    <!-- champ cache -->
                        <input type="hidden"  id="experienceid" name="id">

                        <!-- Champ Experiences -->

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">NOM</label>
                            <input type="text" name="nom_experience" class="form-control" id="nom_experience_id" placeholder="Entrez nom experience">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">DESCRIPTION</label>
                            <input type="text" name="description" class="form-control" id="description_id" placeholder="Donnez une description">
                        </div>

                        <div class="form-group has-success">
                        @foreach ($protocoles as $protocole)
                                <label class="control-label" for="inputSuccess"><h1>PROTOCOL -> {{ $protocole->nom_protocole }}</h1></label>

                            @foreach ($protocole->menace as $menace)
                                    <label class="control-label" for="inputSuccess"><h3>MENACE :----- {{ $menace->nom_menace }}</h3></label>

                                    <br>
                                    <label class="control-label" for="inputSuccess">VULNERABILITES : </label>
                                           @foreach ($menace->vulnerabilite as $vulnerabilite)
                                    <!--<h3>Vulnérabilite : ------------ <input type="checkbox" name="vulnerabilite" value="{{ $vulnerabilite->id }}"> {{ $vulnerabilite->nom_vulnerabilite }}</h3>-->

                                        <input type="checkbox" name="vulnerabilite[]" value="{{ $vulnerabilite->id }}"> {{ $vulnerabilite->nom_vulnerabilite }}


                                @endforeach
                            @endforeach
                        @endforeach
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
            $('#data-table').DataTable();


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
                /*if($('#nom_experience_id').val()=='')
                {
                    alert("the name is requred");
                }
                else if($('#description_id').val()=='')
                {
                    alert("the description experience is requred");
                }*/

                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);


                            var row = '<tr id="menaces'+ data.id+'" >' +
                                '<td>' + data.nom_experience + '</td>' +
                                '<td>' + data.description + '</td>' +
                                '<td>' + $('#experienceid > option[value='+data.experienceid+']').text()  + '</td>' +                                '<td>' +
                                '<button class="btn btn-primary btn-default" data-id="' + data.id + '" title="voir"><i class="fa fa-list"></i></button> ' +
                                '<button class="btn btn-warning btn-danger" data-id="' + data.id + '"title="Supprimer"><i class="fa fa-times"></i></button>'+
                                '</td>'+
                                '</tr>';
                            if (statut == 'save') {
                                $('tbody').prepend(row);
                            }
                            else
                            {
                                $('#experiences'+ data.id).replaceWith(row);
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
            var url = '{{ URL::to('/deleteExperiences') }}';
            //alert(value);
            if(confirm("etez vous sure de vouloir Supprimer")==true){

                $.ajax({
                    type : 'post',
                    url : url,
                    data : {'id':value},
                    success:function () {
                        $('#experiences'+value).remove();

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



