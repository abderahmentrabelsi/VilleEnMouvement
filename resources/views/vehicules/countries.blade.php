<h1>Liste des Pays</h1>
<ul>
    @foreach ($countries as $country)
        <li>{{ $country['name']['common'] }}</li>
    @endforeach
</ul>