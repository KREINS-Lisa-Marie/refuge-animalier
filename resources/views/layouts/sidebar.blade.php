<header>
<nav class="nav-secondaire">
    <h2>
        Navigation secondaire
    </h2>
    <img src="" alt="">
    <div class="flex flex-col">
        <a href="" >Dashboard</a>
        <a href="" >Les animaux</a>
        <a href="{{--{{route('contacts.index')}}--}}" >Demandes d'adoption</a>
        <a href="" >Bénévoles</a>
        <a href="" >Les adoptants</a>
    </div>

    <div>
        <a href="">
            Profil
        </a>
        <form action="{{--{{route('logout')}}--}}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </div>
</nav>
</header>
