<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Archifast</title>
    <link rel="stylesheet" href="{{ asset('asset/presentation.css') }}">
</head>
<body>
<header class="hero">
    <a href="{{ route('admin.home') }}" class="kilo"><i
        class="fa fa-home me-2"></i>Acceuill</a>
<a href="{{ route('admine.register') }}" class="kilo">
    <i class="fa fa-edit me-2" aria-hidden="true" ></i>Créer un compte</a>
<a href="{{ route('admine.accounts') }}" class="kilo"><i
        class="fa fa-users me-2"></i>Liste d'itulisateurs</a>
<a href="{{ route('admine.create') }}"  class="kilo"><i
        class="fa fa-plus me-2"></i>Ajouter une fichier</a>
<a href="{{ route('admine.archife') }}" class="kilo"><i
        class="fa fa-archive me-2"></i>archife</a>
  </header>
 <div class="left">
    <ul class="cards">
        <li class="card card-1"><img src="{{ asset('images/R.png') }}"/>
        </li>
        <li class="card card-2"><img src="{{ asset('images/folders.png') }}"/>
        </li>
        <li class="card card-3"><img src="{{ asset('images/R.png') }}"/>
        </li>
      </ul>
 </div>

<div id="pre">
    <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.
         Facilis modi accusamus autem pariatur.
          Magni, laudantium error provident rerum sequi iusto
           cupiditate consequuntur blanditiis aut hic ipsa quisquam id,
           adipisci doloribus!</h2>
    <button  class="botona">more info</button>
</div>
</body>
</html>
