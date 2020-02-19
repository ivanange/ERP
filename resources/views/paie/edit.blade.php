@extends('layouts/layout_admin')

@section('contenu')
<link rel="stylesheet" href="Monstyle/style_agence.css">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Salaire</li>
    </ol>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center">Edition du Bulletin de salaire</h4> <br>
            <h5 style="color:rgb(111,111,145)">{{ $worker->name }} {{ $worker->surname }} </h5>
            <span style="font-style:italic">{{ $worker->post->name }}</span>
        </div>
    </div> <br><br>

    <div class="">
    <div>
        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Heure suplémentaire</button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Heures supplémentaire</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST" class="row">

                        @csrf

                        <div class="col-sm-4">
                            <div class="form-group">
                                    <input type="number" name="heur_sup" class="form-control " placeholder="Nombre d'heur">
                                    @if($errors->has('heur_sup'))
                                        <small class="form-text text-danger">{{ $errors->first('heur_sup') }}</small>
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
    </div>
    <hr>
    </div> <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p>
                    <span>{{ $worker->name }}</span> <br>
                    <span>{{ $worker->surname }}</span> <br>
                    <span>tel : {{ $worker->telephone }}</span> <br>
                    <span>{{ $worker->address }}</span>
                </p>
            </div>
            <div class="col-sm-4 offset-sm-4 border pt-4 font-weight-bold mb-4 bg-info text-light">
                Bulletin du mois de : 
            </div>
        </div> <br><br>
        <div class=row>
            <div class="col-sm-6">
                <span class="font-weight-bold">Salaire de base :</span>
            </div>
            <div class="col-sm-3">
                <span class="badge badge-success">{{$worker->post->baseSalary}} FCFA</span>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-6">
                    <span class="font-weight-bold">Prime heures supplémentaires :</span>
                </div>
                <div class=col-sm-3>
                    <span class="badge badge-secondary">{{$worker->prime}} FCFA</span>
                </div>
        </div> <br><br>
        <div class="row">
                <div class="col-sm-6">
                    <span class="font-weight-bold">Salaire Total :</span>
                </div>
                <div class="col-sm-3">
                    <span class="badge badge-success">{{$worker->prime+$worker->post->baseSalary}} FCFA</span>
                </div>
        </div><br><br>
        <hr>
        <div>
        <button class="btn btn-success " href=""> <i class="fas fa-print"> Imprimer</i></button>
        </div> <br>
    </div>
@endsection