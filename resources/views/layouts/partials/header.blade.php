<header>
    <div id="title">
        <table>
            <tr>
                <td><img src="{{URL::to('/')}}/images/header_gauche.jpg" alt="image header gauche"/></td>
                <td>
                    <a href="{{ URL::route('index') }}">
                        <img src="{{URL::to('/')}}/images/logo.png" alt="logo"/>
                        <h1>La forme pour tous !!!</h1>
                    </a>
                </td>
                <td><img src="{{URL::to('/')}}/images/header_droite.jpg" alt="image header droite"/></td>
            </tr>
        </table>
    </div>
</header>

<br/>

<div class="container">
    <div id="nav-trigger"><span>Menu</span></div>
    <nav id="nav-main">
        <ul>
            <li @if(Request::url() == URL::route('index')) class="active" @endif>
                <a href="{{ URL::route('index') }}">Accueil</a>
            </li>
            <li @if(Request::url() == URL::route('tarifs_horaires')) class="active" @endif>
                <a href="{{ URL::route('tarifs_horaires') }}">Tarifs & Horaires</a>
            </li>
            <li @if(Request::url() == URL::route('renseignements')) class="active" @endif>
                <a href="{{ URL::route('renseignements') }}">Renseignements</a>
            </li>
            <li @if(Request::url() == URL::route('photos')) class="active" @endif>
                <a href="{{ URL::route('photos') }}">Photos</a>
            </li>
            <li @if(Request::url() == URL::route('contact')) class="active" @endif>
                <a href="{{ URL::route('contact') }}">Contact</a>
            </li>
        </ul>
    </nav>
    <nav id="nav-mobile"></nav>
</div>