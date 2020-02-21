@extends('layouts/layout_admin')

@section('title', 'Workers')

@section('contenu')
    <link rel="stylesheet" href="Monstyle/style_agence.css">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">workers</li>
    </ol>
    <div class="row">
        <div class="col-sm-12">
            <h4>Bulletin de paie</h4>
        </div>
    </div> <br>
    <div class="container">
    <div>
         
    <table id="example" class="display table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Téléphone</th>
                <th>e-mail</th>
                <th>Poste</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($workers as $worker)
                <tr>
                    <td> {{$worker -> name}} </td>
                    <td> {{$worker -> surname}} </td>
                    <td> {{$worker -> telephone}} </td>
                    <td> {{$worker -> email}} </td>
                    <td style="font-size:12px"> {{$worker -> post->name}} </td>
                
                    <td>
                        <!-- <a class="btn btn-primary btn-sm" href=""> <i class="fas fa-print"></i></a> -->
                        <a class="btn btn-success btn-sm" href="/payroll/paie/{{$worker->id}}/bulletin"> <i class="fas fa-edit"></i></a>
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