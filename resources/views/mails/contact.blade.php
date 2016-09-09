<div id="maildecontact" style="background-color:white;font-family: arial,sans-serif;">
    <div id="bandeaumaildecontact" style="background-color: #689F38;text-align: center;color: white;padding: 0.5px;">
        <h1 style="margin-bottom: 0px;line-height: inherit;font-weight: bold;margin: 5px 15px; line-height: inherit;">
            Myosine - Page de contact
        </h1>
    </div>
    <div id="contenuemaildecontact" style="padding: 5px;">
        <h3 style="text-align: center; color:#689F38; font-weight:bold; line-height: inherit;">
            - Vous avez reçu un nouveau message -
        </h3>
        <h4 style="line-height: inherit; font-weight:bold; color: black;">
            <u>De la part de :</u> {{ $name }} - <a href="mailto:{{ $email }}" style="text-decoration: none;">{{ $email }}</a>
        </h4>
        <h4 style="line-height: inherit; font-weight:bold; color: black;">
            <u>Contenu du message :</u>
        </h4>
        <p style="line-height: inherit; font-size: 100%;">
            {{ $message }}
        </p>
        <hr>
        <h5 style="font-size: 70%; font-weight: 300;line-height: inherit;">Ceci est un message automatique, merci de ne pas y répondre.</h5>
    </div>
</div>