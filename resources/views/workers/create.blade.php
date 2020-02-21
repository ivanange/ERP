@extends('layouts.layout_admin')


@section('contenu')
<link rel="stylesheet" href="Monstyle/style_agent.css">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Workers</li>
</ol> 
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-12">
          <h4>Nouvel employé</h4>
      </div>
  </div> <br>
  <div class="">
  <form action="" method="POST" enctype="multipart/form-data" class="row bloc pt-4 pb-5">

    @csrf

    <div class="col-sm-12">
        <div class="form-group">
                <input type="text" name="login" class="form-control " placeholder="Login">
                @if($errors->has('login'))
                    <small class="form-text text-danger">{{ $errors->first('login') }}</small>
                @endif
            </div>
        </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="nom" class="form-control" placeholder="nom">
            @if($errors->has('nom'))
                <small class="form-text text-danger">{{ $errors->first('nom') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="prenom" class="form-control" placeholder="prenom">
            @if($errors->has('prenom'))
                <small class="form-text text-danger">{{ $errors->first('prenom') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <input type="number" name="tel" class="form-control" placeholder="Contact">
            @if($errors->has('tel'))
                <small class="form-text text-danger">{{ $errors->first('tel') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" name="cni" class="form-control" placeholder="numéro de CNI">
            @if($errors->has('cni'))
                <small class="form-text text-danger">{{ $errors->first('cni') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="adresse e-mail">
            @if($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="mot de passe">
            @if($errors->has('pass'))
                <small class="form-text text-danger">{{ $errors->first('pass') }}</small>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="custom-file">
            <input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile">
            <label class="custom-file-label" for="validatedCustomFile">Choisir un avatar...</label>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
        <label>Agence</label>
        <select class="form-control" name="agence">
            <option>--- Choisissez une agence ---</option>
             
        </select>
        </div>
    </div>
    <div class="col-sm-6 mb-3">
        <div class="custom-control custom-switch">
            <input type="hidden" name="statut" value="bloque">
            <input type="checkbox" name="statut" class="custom-control-input" value="actif" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">Activer</label>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary "> <i class="far fa-save"></i> Enregister</button>
        </div>
    </div>
    </form>
  </div>
</div>
@endsection