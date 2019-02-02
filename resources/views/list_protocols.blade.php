@extends('layouts.dashboard')
@section('page_heading','PROTOCOLS')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('cotable_panel_title','LISTS PROTOCOLS')
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
                        <th>NOMS PROTOCOLS</th>
                        <th>DESCRIPTION PROTOCOLS</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($protocols as $protocol)
                        <tr id="protocols{{$protocol->id}}" class="success">
                            <td>{{ isset($i)? ++$i : $i=1 }}</td>
                            <td>{{ $protocol->nom_protocole }}</td>
                            <td>{{ $protocol->description_protocole }}</td>
                            <td>
                                <button class="btn btn-primary btn-default" name="edit" id="edit" data-target="#add_data_Modal" data-id="{{ $protocol->id }}"title="voir"><i class="fa fa-list"></i></button>
                                <button class="btn btn-warning btn-danger" data-id="{{ $protocol->id }}" title="Supprimer"><i class="fa fa-times"></i></button>

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
            <form id="insert_form" method="POST" action="Protocoles">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enregistrement d'un Protocols</h4>
                </div>

                <div class="modal-body">

                            {{ csrf_field() }}

                            <!-- champ cache -->
                                <input type="hidden"  id="protocolid" name="id">

                                <!-- Champ Protocols -->

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">Nom du Protocole</label>
                            <input type="text" name="nom_protocole" class="form-control" id="nom_protocole_id" placeholder="Entrez le nom du protocole">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">description du protocole</label>
                            <input type="text" name="description_protocole" class="form-control" id="description_protocole_id" placeholder="decrire le protocole">
                        </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" id="save" value="Save" class="btn btn-primary">
                    <!--<button type="submit" id="save" class="btn btn-success" data-dismiss="modal">Save</button>-->
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
                if($('#nom_protocole_id').val()=='')
                {
                    alert("nom protocole is requred");
                }
                else if($('#description_protocole_id').val()=='')
                {
                    alert("description protocole is requred");
                }
                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);


                            var row = '<tr id="protocols'+ data.id+'" >' +
                                '<td>' + data.nom_protocole + '</td>' +
                                '<td>' + data.description_protocole + '</td>' +
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
                                $('#protocols'+ data.id).replaceWith(row);
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
            var url = '{{ URL::to('/deleteProtocoles') }}';
            //alert(value);
            if(confirm("etez vous sure de vouloir Supprimer")==true){

                $.ajax({
                    type : 'post',
                    url : url,
                    data : {'id':value},
                    success:function () {
                        $('#protocols'+value).remove();

                    }
                });
            }

        });


        //--------update  action-------------------------------
        $('tbody').delegate('.btn-default','click',function () {

            var value = $(this).data('id');
            var url = '{{ URL::to('listProtocoles') }}';

           // alert(value);

            $.ajax({
                type : 'get',
                url : url,
                data : {'id':value},

                success:function (data) {  console.log(data)
                    $('#nom_protocole_id').val(data.nom_protocole);
                    $('#description_protocole_id').val(data.description_protocole);
                    $('#protocolid').val(data.id);
                    $('#save').val('modifier');
                    $('#myModal').modal('show');

                },error:function(){
                    alert("error!!!!");
                }

            });

        });


    </script>


@endsection