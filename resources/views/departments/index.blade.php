@extends('/layouts/layout_admin')

@section('contenu')
<link rel="stylesheet" href="Monstyle/style_agence.css">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Départements</li>
    </ol>
    <div class="row">
        <div class="col-sm-12">
            <h4>Liste des départements</h4>
        </div>
    </div> <br>
    <div class="container">
    <div>
        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Ajouter</button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nouveau département</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST" class="row">

                        @csrf

                        <div class="col-sm-4">
        <div class="form-group">
                <input type="text" name="name" class="form-control " placeholder="Nom">
                @if($errors->has('name'))
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>
    <div class="col-sm-12">
        <div class="form-group">
            <textarea name="desc" id="" cols="20" rows="2" placeholder="description" class="form-control"></textarea>
            @if($errors->has('desc'))
                <small class="form-text text-danger">{{ $errors->first('desc') }}</small>
            @endif
        </div>
    </div>
     
    <div class="col-sm-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary "> <i class="far fa-save"></i> Enregister</button>
        </div>
    </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>
    </div> <br>
    <table id="example" class="display table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($depts as $dept)
                <tr>
                    <td> {{$dept -> name}} </td>
                    <td> {{$dept -> desc}} </td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm"> <i class="far fa-eye"></i> Voir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- CODE JAVASCRIPT -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pagingType": "simple_numbers",
                language: {
                    paginate: {
                    next:'<i class="fas fa-arrow-right"></i>',
                    previous: '<i class="fas fa-arrow-left"></i>'  
                    }
                }
            } );
        } );
    </script>
@endsection