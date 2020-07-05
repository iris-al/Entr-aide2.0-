<!doctype html>
<p>De nouvelles annonces ont été publiés sur entraide 2.0! <p>
<h3>Ne les manquez pas :)</h3>
<div id ="results">

@foreach($ads as $ad)
<div class="card mb-3" style="width: 100%;">
  <div class="card-body">
    <h4 class="card-title">{{ $ad['title'] }}</h4>
    <p class="card-text" text-info>Se situe a : {{  $ad['localisation'] }}</p>
    <p class="card-text">Description : {{ $ad['description'] }}</p>
    <p class="card-text">Catégorie : {{ $ad['categorie'] }}</p>
  </div>
</div>
@endforeach

</div>
<style>
p { text-align: center }
h3 { text-align: center }
h4 { text-align: center }
</style>