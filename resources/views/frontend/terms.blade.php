@extends('layouts.public')

@section('title', 'Conditions d’utilisation de Myosine')
@section('description', 'Conditions d’utilisation de Myosine')

@section('section_title', 'Conditions d’utilisation')

@section('content')
    <h2>Termes de contact</h2>
    <p class="text-justify">
        Utilisez une adresse e-mail valide pour que nous puissions vous recontactez.<br>
        Essayez d'expliquer au mieux les problèmes que vous rencontrez :<br>
        - Donnez le maximum d'informations annexes (navigateur, type de matériel, etc)<br>
        - Expliquez en détail votre problème et les conditions dans lesquelles il est parvenu<br>
        - Utilisez le plus possible un vocabulaire simple et compréhensible<br>
        - Toute nouvelle amélioration est la bienvenue !<br>

        Évitez de nous contactez pour des problèmes qui peuvent êtres personnel (connexion lentes, etc) et si possible utilisez la FAQ (bientôt disponible).<br>
        Nous nous reservons le droit de banir les spammers et les personnes injurieuses.
    </p>

    <h2>Conditions générales d'utilisation</h2>
    <p class="text-justify">
        Le présent document a pour objet de définir les modalités et conditions dans lesquelles d’une part, {{ $editeur }}, ci-après dénommé l’EDITEUR,
        met à la disposition de ses utilisateurs le site, et les services disponibles sur le site et d’autre part, la manière par laquelle l’utilisateur accède au site et utilise ses services.
        Toute connexion au site est subordonnée au respect des présentes conditions.
        Pour l’utilisateur, le simple accès au site de l’EDITEUR à l’adresse URL suivante ".$url."  implique l’acceptation de l’ensemble des conditions décrites ci-après.
    </p>

    <h2>Propriété intellectuelle</h2>
    <p class="text-justify">
        La structure générale du site {!! $site !!}, ainsi que les textes, graphiques, images, sons et vidéos la composant,
        sont la propriété de l'éditeur ou de ses partenaires.
        Toute représentation et/ou reproduction et/ou exploitation partielle ou totale des contenus et services proposés par le site {!! $site !!},
        par quelque procédé que ce soit, sans l'autorisation préalable et par écrit de  {{ $editeur }}  et/ou de ses partenaires est strictement interdite et serait susceptible de constituer
        une contrefaçon au sens des articles L 335-2 et suivants du Code de la propriété intellectuelle.
    </p>

    <h2>Accès au site</h2>
    <p class="text-justify">
        L’éditeur s’efforce de permettre l’accès au site 24 heures sur 24, 7 jours sur 7, sauf en cas de force majeure ou d’un événement hors du contrôle de l’EDITEUR,
        et sous réserve des éventuelles pannes et interventions de maintenance nécessaires au bon fonctionnement du site et des services.
        Par conséquent, l’EDITEUR ne peut garantir une disponibilité du site et/ou des services, une fiabilité des transmissions et des performances en terme de temps de réponse ou de qualité.
        Il n’est prévu aucune assistance technique vis à vis de l’utilisateur que ce soit par des moyens électronique ou téléphonique.

        La responsabilité de l’éditeur ne saurait être engagée en cas d’impossibilité d’accès à ce site et/ou d’utilisation des services.

        Par ailleurs, l’EDITEUR peut être amené à interrompre le site ou une partie des services, à tout moment sans préavis, le tout sans droit à indemnités.
        L’utilisateur reconnaît et accepte que l’EDITEUR ne soit pas responsable des interruptions, et des conséquences qui peuvent en découler pour l’utilisateur ou tout tiers.
        <br>
        Modification des conditions d’utilisation :<br>
        L’EDITEUR se réserve la possibilité de modifier, à tout moment et sans préavis, les présentes conditions d’utilisation afin de les adapter aux évolutions du site et/ou de son exploitation.
    </p>

    <h2>Règles d'usage d'Internet</h2>
    <p class="text-justify">
        L’utilisateur déclare accepter les caractéristiques et les limites d’Internet, et notamment reconnaît que : <br>
        - L’EDITEUR n’assume aucune responsabilité sur les services accessibles par Internet et n’exerce aucun contrôle de quelque forme que ce soit sur la nature et les caractéristiques des données qui pourraient transiter par l’intermédiaire de son centre serveur. <br>
        - L’utilisateur reconnaît que les données circulant sur Internet ne sont pas protégées notamment contre les détournements éventuels. La présence du logo {!! $site !!} institue une présomption simple de validité. <br>
        - La communication de toute information jugée par l’utilisateur de nature sensible ou confidentielle se fait à ses risques et périls. <br>
        - L’utilisateur reconnaît que les données circulant sur Internet peuvent être réglementées en termes d’usage ou être protégées par un droit de propriété. <br>
        - L’utilisateur est seul responsable de l’usage des données qu’il consulte, interroge et transfère sur Internet. <br>
        - L’utilisateur reconnaît que l’EDITEUR ne dispose d’aucun moyen de contrôle sur le contenu des services accessibles sur Internet <br>
    </p>

    <h2>Droit applicable</h2>
    <p class="text-justify">
        Tant le présent site que les modalités et conditions de son utilisation sont régis par le droit français, quel que soit le lieu d’utilisation.
        En cas de contestation éventuelle, et après l’échec de toute tentative de recherche d’une solution amiable, les tribunaux français seront seuls compétents pour connaître de ce litige.
        Pour toute question relative aux présentes conditions d’utilisation du site, vous pouvez nous écrire à l’adresse suivante :
    </p>
@endsection