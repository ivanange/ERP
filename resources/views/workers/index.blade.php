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
        <h4>Liste des employés</h4>
    </div>
</div> <br>
<div class="container">
    <div>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i
                class="fas fa-plus"></i> Ajouter</button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">New worker</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="" method="POST" class="row">

                            @csrf

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control text-center"
                                        placeholder="Login" value="{{ old('username') }}">
                                    @if($errors->has('username'))
                                    <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control text-center" placeholder="Nom"
                                        value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="surname" class="form-control text-center"
                                        placeholder="Prenom" value="{{ old('surname') }}">
                                    @if($errors->has('surname'))
                                    <small class="form-text text-danger">{{ $errors->first('surname') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="tel" name="telephone" class="form-control text-center"
                                        placeholder="Téléphone" value="{{ old('telephone') }}">
                                    @if($errors->has('telephone'))
                                    <small class="form-text text-danger">{{ $errors->first('telephone') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="date" name="birthday" class="form-control text-center"
                                        placeholder="Date de naissance" value="{{ old('birthday') }}">
                                    @if($errors->has('birthday'))
                                    <small class="form-text text-danger">{{ $errors->first('birthday') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control text-center"
                                        placeholder="Adresse e-mail" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Genre</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="genre" id="inlineCheckbox1"
                                        value="Male">
                                    <label class="form-check-label" for="inlineCheckbox1">Homme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="genre"
                                        value="Female">
                                    <label class="form-check-label" for="inlineCheckbox2">Femme</label>
                                </div>
                                @if($errors->has('genre'))
                                <small class="form-text text-danger">{{ $errors->first('genre') }}</small>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="adresse" class="form-control text-center"
                                        placeholder="Adresse" value="{{ old('adresse') }}">
                                    @if($errors->has('adresse'))
                                    <small class="form-text text-danger">{{ $errors->first('adresse') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" name="pass" class="form-control text-center"
                                        placeholder="Mot de passe">
                                    @if($errors->has('pass'))
                                    <small class="form-text text-danger">{{ $errors->first('pass') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Poste</label>
                                    <select class="form-control" name="poste">
                                        <option>--- Choisissez un poste ---</option>
                                        @foreach($posts as $post)
                                        <option value="{{ $post->id }}">{{ $post->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('poste'))
                                    <small class="form-text text-danger">{{ $errors->first('poste') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <select class="form-control" name="titre">
                                        <option>--- Choisissez un titre ---</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">prof</option>
                                    </select>
                                    @if($errors->has('titre'))
                                    <small class="form-text text-danger">{{ $errors->first('titre') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Enregister</button>
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
                <th>Prenom</th>
                <th>Téléphone</th>
                <th>e-mail</th>
                <th>genre</th>
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
                <td> {{$worker -> gender}} </td>
                <td style="font-size:12px"> {{$worker -> post->name}} </td>

                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm"> <i class="far fa-eye"></i></button>
                    <button type="button" class="btn btn-outline-success btn-sm"> <i class="fas fa-edit"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- CODE JAVASCRIPT -->
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "pagingType": "simple_numbers",
            language: {
                paginate: {
                    next: '<i class="fas fa-arrow-right"></i>',
                    previous: '<i class="fas fa-arrow-left"></i>'
                }
            }
        });
    });

</script>
@endsection
