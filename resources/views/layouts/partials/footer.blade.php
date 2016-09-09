<br>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 text-center">
                <a href="{{ URL::route('admin') }}">Admin</a>  |  Mise en page : Ugho STEPHAN &copy; {{ date('Y') }}  |  <a href="{{ URL::route('terms') }}">Conditions</a> | <a href="{{ URL::route('contact') }}#informations">{{ Session::get('informations')->adresse_salle }}</a>  |  <a href="{{ URL::route('contact') }}#informations">{{ Session::get('informations')->tel_salle }}</a>
            </div>
        </div>
    </div>
</footer>