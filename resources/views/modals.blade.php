<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Basic Modal Example</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addprotocol">Open Modal</button>

    <!-- Modal -->
    <div class="modal fade" id="addprotocol" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>

                <div class="modal-body">

                    <form role="form" id="addform">

                        <div class="form-group has-success">

                            {{csrf_field() }}

                            <label class="control-label" for="inputSuccess">Nom du Protocole</label>
                            <input type="text" name="nom_protocole" class="form-control" id="inputSuccess" placeholder="Entrez le nom du protocole">
                        </div>

                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">description du protocole</label>
                            <input type="text" name="description_protocole" class="form-control" id="inputSuccess" placeholder="decrire le protocole">
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Protocol</button>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script>

     $(document).ready(function () {

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     });

         $('#addform').on('submit',function (e) {
             e.preventDefault();
             $.ajax({
                 type: "POST",
                 url: "/protocoleadd",
                 data:$('#addform').serialize(),
                 success: function (response) {
                     console.log(response)
                     $('#addprotocol').modal('hide')
                     alert("Data Saved");
                 },
                 error: function (error) {
                     console.log(error)
                     alert("Data Not Saved");

                 }

             });

         });




</script>
</body>
</html>

@section('js')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        // insertion de Risk Status

        $('#add').on('click',function () {
            console.log('add-click', 'ça passe');

            $('#myModal').modal('show');
            $('#save').val('save');
            $('#insert_form').trigger('reset');

            $('#insert_form').on('submit', function (e) {
                e.preventDefault();
                var url = $('#insert_form').attr('action');
                var data = $('#insert_form').serialize();
                var type = 'POST';
                var statut = $('#save').val();

                //alert(data);
                if( statut == 'modifier')
                {
                    type = 'PUT';
                    //data += '&id='+$(this).data('id');
                }
                if($('#libelle').val()=='')
                {
                    alert("libelle is requred");
                }
                else if($('#valeur').val()=='')
                {
                    alert("valeur is requred");
                }
                else
                {

                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success:function (data) {
                            console.log(data);
                            /*$('#insert_form')[0].reset();
                             $('#add_data_Modal').modal('hide');
                             $('#membre_table').html(data);*/

                            var row = '<tr id="riskstatus'+ data.id+'" >' +
                                '<td>' + data.libelle + '</td>' +
                                '<td>' + data.valeur + '</td>' +
                                '<td>' +
                                '<button class="btn btn-xs btn-info" data-id="' + data.id + '" title="voir"><i class="material-icons">list</i></button> ' +
                                '<button class="btn btn-xs btn-danger" data-id="' + data.id + '"title="Supprimer"><i class="material-icons">remove</i></button>'+
                                '</td>'+
                                '</tr>';
                            if (statut == 'save') {
                                $('tbody').prepend(row);
                            }
                            else
                            {
                                $('#riskstatus'+ data.id).replaceWith(row);
                                $('#add_data_Modal').modal('hide');

                            }

                        }

                    });



                    //---------reset_formulaire--------------------
                    $(this).trigger('reset');
                }

            });



        });








    </script>


@endsection
