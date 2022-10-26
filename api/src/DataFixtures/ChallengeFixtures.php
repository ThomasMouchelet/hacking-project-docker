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
            'answer' => "0",
            'description' => "Bonjour {namingGame}
                <br><br>
                L'une des principales qualité d'un hackeur est l'observation. Avez-vous bien analysé l'ensemble du lieu où vous vous trouvez ?
                <br>
                Pour atteindre l'étape 2, vous devrez trouver et renseigner numéro dans le champs ci-dessous.
                <br><br>
                Voici un indice, mais ne vous y habituez pas.
                <br><br>
                <em>“Il vous faudra analyser les dessous du stade pour gagner la partie</em>",
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
            'name' => "01000010 01101001 01101110 01100001 01101001 01110010 01100101",
            'answer' => "i love css",
            'description' => "
                01101001 00100000 01101100 01101111 01110110 01100101 00100000 01100011 01110011 01110011 
            ",
            'orderChallenge' => "3",
            'type' => 'student'
        ],
        'challenge4' => [
            'name' => "tnasrevneR",
            'answer' => "264",
            'description' => "
                <audio
                    controls
                    src=\"http://sn.icri5960.odns.fr/reverse.mp3\">
                </audio>
            ",
            'orderChallenge' => "4",
            'type' => 'student'
        ],
        'challenge5' => [
            'name' => "Dev-joke",
            'answer' => "mrtdominera",
            'description' => "
                <div id=\"mrtdominera\">
                    Cher {namingGame}, j'espère que ces quelques aller-retours vous ont dégourdi les jambes. 
                    <br><br>
                    Au risque que cela vous semble répétitif, il est important d'avoir de la <em>.class</em>
                    <br>
                    Mais la réponse que vous cherchez nécessite quelque chose de bien plus <em>#unique</em>
                </div>
            ",
            'orderChallenge' => "5",
            'type' => 'student'
        ],
        'challenge6' => [
            'name' => "Concaténation",
            'answer' => "42",
            'description' => "
                <p>1 + 1= 2</p>
                <p>2 * '3' = 6</p>
                <p>'4' + '2' = ?</p>
            ",
            'orderChallenge' => "6",
            'type' => 'student'
        ],
        'challenge7' => [
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
            'orderChallenge' => "7",
            'type' => 'student'
        ],
        'challenge8' => [
            'name' => "WPA",
            'answer' => "espd_bo_r1_3",
            'description' => "
                Eh bien, nous pouvons enfin commencer {namingGame} !
                <br><br>
                Il est temps de changer le monde !
                <br><br>
                J’ai réussi à récupérer les positions GPS de l’un des membres de Tcorp.
                Il est passé par cette école le vendredi 22 octobre.
                <br>
                Il s’est probablement connecté avec son ordinateur au réseau wifi. Sur certaines de ces bornes, il y a une référence d'inscrite.
                <br>
                Trouvez la borne et noter la référence. 
                Elle nous permettra de parcourir les adresses IP de l'école .
            ",
            'orderChallenge' => "8",
            'type' => 'team'
        ],
        'challenge9' => [
            'name' => "Trouver l'adresse IP",
            'answer' => "192.168.0.250",
            'description' => "
                Il nous faut maintenant récupérer l’adresse ip de son ordinateur portable. 
                Je suis parvenu à récupérer l’interface d’administration réseaux de l’école.
                <br>
                Vous devez trouver une ip qui corresponde avec la date de son passage (22 octobre)
                <br><br>
                <a href=\"http://meraki.icri5960.odns.fr\" id=\"link\" target=\"_blank\">meraki.icri5960.odns.fr</a>

            ",
            'orderChallenge' => "9",
            'type' => 'team'
        ],
        'challenge10' => [
            'name' => "Search and replace",
            'answer' => "thomas mouchelet",
            'description' => "
                Après avoir intercepté certaines requêtes, j'ai pu récupérer des données cryptées.
                <br>
                Le peux que j'ai pu en déchiffrer, m'a donné des informations sur son agenda.
                <br>
                Il est indiqué qu'il est présent en <em>salle 4</em> la semaine du 24 au 28 octobre.
                <br>
                Il faut que l’ont sache de qui il s’agit pour récolter des informations.
                <br>
                Envoiez moi son prénom et son nom.
                <br>
                Il faut fouiller l'école, peut être qu’il y a des indices.
            ",
            'orderChallenge' => "10",
            'type' => 'team'
        ],
        'challenge11' => [
            'name' => "Social engineering",
            'answer' => "18/07/1988",
            'description' => "
                Bien joué, nous savons maintenant à qui nous attaquer. 
                <br><br>
                Restons discrets pour ne pas qu’il le découvre. Cela pourrait mettre en péril notre plan.
                <br><br>
                Nous allons effectuer une attaque par dictionnaire, <br>
                il nous faut des informations personnelles. Trouvez la <em>date de naissance</em> de Thomas Mouchelet.
                <br>
                <em>jj/mm/AAAA</em>
            ",
            'orderChallenge' => "11",
            'type' => 'team'
        ],
        'challenge12' => [
            'name' => "Social engineering",
            'answer' => "cwalk",
            'description' => "
                Il nous faut plus d'informations. 
                <br>
                Je sais que Thomas Mouchelet a pratiqué un type de danse et qu'il y a des vidéos.
                <br>
                <br>
                <em>Trouvez le nom de la danse qu'il a pratiqué.</em>
                <br>
                <br>
                Pour cela il vous faut récupérer son pseudo afin de trouver la chaine Youtube relié aux vidéos.
            ",
            'orderChallenge' => "12",
            'type' => 'team'
        ],
        'challenge13' => [
            'name' => "L'attaque des titans !",
            'answer' => "",
            'description' => "
                Je ne regrette pas de vous avoir recruté ! On va maintenant passer à l’attaque !
                <br><br>
                Avec son ancien pseudo, le nom de cette danse et sa date de naissance, nous pouvons maintenant lancer l’attaque pour accéder à l'espace administrateur.
                <br><br>
                <a href=\"http://sn.icri5960.odns.fr/\" id=\"link\" target=\"_blank\">sn.icri5960.odns.fr/</a>
            ",
            'orderChallenge' => "13",
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
