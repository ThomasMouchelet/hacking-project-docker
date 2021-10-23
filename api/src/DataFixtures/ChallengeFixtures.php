<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use ApiPlatform\Core\Annotation\ApiResource;

class ChallengeFixtures extends Fixture
{
    const CHALLENGES = [
        'challenge1' => [
            'name' => "L'observation",
            'answer' => "268",
            'description' => "Bonjour {namingGame}
                                <br><br>
                                L'une des principales qualité d'un hackeur est l'observation. Avez-vous bien analysé l'ensemble du lieu où vous vous trouvez ?
                                <br>
                                Pour atteindre l'étape 2, vous devrez trouver et renseigner un code à 3 chiffres dans le champs ci-dessous.
                                <br><br>
                                Voici un indice, mais ne vous y habituez pas.
                                <br><br>
                                <em>“Le sombre ciel du studio photo vous fera faire la connexion”</em>",
            'orderChallenge' => "1",
            'type' => 'student'
        ],
        'challenge2' => [
            'name' => "Test oculaire",
            'answer' => "#00ff00",
            'description' => "
                Eh bien, nous pouvons enfin commencer {namingGame} !
                <br><br>
                Un premier test facile
                <br><br>
                Vous me voyez, d'ailleurs je suis plutôt voyant. A vous de me trouver et de me rentrer Hexa-ctement
                ",
            'orderChallenge' => "2",
            'type' => 'student'
        ],
        'challenge3' => [
            'name' => "Code à trouver",
            'answer' => "réponse",
            'description' => "
            à trouver
            ",
            'orderChallenge' => "3",
            'type' => 'student'
        ],
        'challenge4' => [
            'name' => "Dev-joke",
            'answer' => "mrtdominera",
            'description' => "
                <div id=\"MrTdominera\">
                    Cher {namingGame}, j'espère que ces quelques aller-retours vous ont dégourdi les jambes. 
                    <br><br>
                    Au risque que cela vous semble répétitif, il est important d'avoir de la <em>.class</em>
                    <br>
                    Mais la réponse que vous cherchez nécessite quelque chose de bien plus <em>#unique</em>
                </div>
            ",
            'orderChallenge' => "4",
            'type' => 'student'
        ],
        'challenge5' => [
            'name' => "Pas mal",
            'answer' => "team",
            'description' => "
               Vous avez fait vos preuves {namingGame}, de toute évidence.
                <br><br>
                Mais de ce que j'ai pu observer, vous ne vous en sortirez pas sans aide pour la tâche que j'ai à vous confier. 
                <br><br>
                C'est pourquoi vous allez devoir rejoindre une team, une équipe composée de hackers comme vous. 
                <br><br>
                Dorénavant vos destins sont liés, et l'entraide sera le maître mot.
                <br>
                Avant toute chose, notez bien le code suivant, il vous sera rapidement nécessaire :
                <br><br>
                <em>{secretKey}</em>
                <br><br>
                A présent, rejoignez-moi dans un espace sécurisé pour constituer votre équipe.
                <br> 
                Vous commencez à avoir l'habitude... inspectez et trouvez simplement quel lien suivre.
                <br><br>
                <a href=\"/#/create_team\" id=\"link\" style=\"display: none;\" target=\"_blank\">C'est bien ici !</a>
            ",
            'orderChallenge' => "5",
            'type' => 'student'
        ],
        'challenge6' => [
            'name' => "WPA",
            'answer' => "netgear-6-wpa3-2707",
            'description' => "
                Eh bien, nous pouvons enfin commencer {namingGame} !
                <br><br>
                Il est temps de changer le monde !
                <br><br>
                J’ai réussit à récupérer les positions GPS de l’un des membre de Tcorp.
                Il est passé par cette école et d'après ses messages il avait rendez-vous au bureau pédagogique le vendredi 22 octobre à 17h15.
                <br>
                Il s’est probablement connecté avec son ordinateur au réseau wifi. Sur chacune de ces bornes il y a une référence d'inscrits.
                <br>
                En imaginant le parcours qu'il a pu effectuer, trouver la borne et noter la référence. 
                Elle nous permettra de parcourir les adresses IP qui ce sont connecter.
            ",
            'orderChallenge' => "6",
            'type' => 'team'
        ],
        'challenge7' => [
            'name' => "Trouver l'adresse IP",
            'answer' => "192.168.0.205",
            'description' => "
                Il nous faut maintenant récupérer l’adresse ip de son ordinateur portable. 
                Je suis parvenu à récupérer l’interface d’administration réseaux de l’école.
                <br>
                Vous devez trouver une ip qui matche avec la date et l'heure de son rendez-vous (22 octobre)
                <br><br>
                http://meraki.icri5960.odns.fr

            ",
            'orderChallenge' => "7",
            'type' => 'team'
        ],
        'challenge8' => [
            'name' => "Search and replace",
            'answer' => "thomas mouchelet",
            'description' => "
                C’est bien cela, elle correspond avec celle que j’ai récupérées de mon coté. 
                <br>
                Il faut que l’ont sache de qui il s’agit pour récolter des informations.
                Envoi moi son prénom et son nom.
                <br>
                Il faut fouiller l'école, peut être qu’il y a des indices.
            ",
            'orderChallenge' => "8",
            'type' => 'team'
        ],
        'challenge9' => [
            'name' => "Social engineering",
            'answer' => "18/07/1988",
            'description' => "
                Bien joué, on sais maintenant qui nous devons attaquer. 
                <br><br>
                Restons discret pour ne pas qu’il le découvre. Cela pourrait mettre en péril notre plan.
                <br><br>
                Nous allons effectuer une attaque par dictionnaire, <br>
                il nous faut des informations personnelles. Trouvez la date de naissance de Thomas Mouchelet.
            ",
            'orderChallenge' => "9",
            'type' => 'team'
        ],
        'challenge10' => [
            'name' => "L'attaque des titans !",
            'answer' => "",
            'description' => "
                Je ne regrette pas de vous avoir recruter ! On va maintenant passer à l’attaque !
                <br><br>
                Il faut se connecter à sont compte, utiliser les informations récoltés
                <br><br>
                http://sn.icri5960.odns.fr/
            ",
            'orderChallenge' => "10",
            'type' => 'team'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CHALLENGES as $challengeRef => $data) {
            $challenge = new Challenge();
            $challenge->setName($data["name"])
                ->setAnswer($data["answer"])
                ->setDescription($data["description"])
                ->setType($data['type'])
                ->setOrderChallenge($data['orderChallenge']);

            $this->addReference('challenge' . $data['orderChallenge'], $challenge);
            $manager->persist($challenge);
        }

        $manager->flush();
    }
}
