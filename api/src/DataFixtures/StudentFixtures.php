<?php

namespace App\DataFixtures;

use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StudentFixtures extends Fixture
{

    const STUDENTS = [
        'student1' => [
            'firstName' => "Maxime",
            'lastName' => "ASSELINE",
        ],
        'student2' => [
            'firstName' => "Emma",
            'lastName' => "BESSAS",
        ],
        'student3' => [
            'firstName' => "Hugo",
            'lastName' => "BONY",
        ],
        'student4' => [
            'firstName' => "Cyrielle",
            'lastName' => "BOSSE",
        ],
        'student5' => [
            'firstName' => "Adrien",
            'lastName' => "BOUSQUET",
        ],
        'student6' => [
            'firstName' => "Celine",
            'lastName' => "COUGNON",
        ],
        'student7' => [
            'firstName' => "Paul",
            'lastName' => "CRAPPIER",
        ],
        'student8' => [
            'firstName' => "Victor",
            'lastName' => "HAIMEZ",
        ],
        'student9' => [
            'firstName' => "Dylan",
            'lastName' => "HAUDRY",
        ],
        'student10' => [
            'firstName' => "Carla",
            'lastName' => "HIBSCHELE",
        ],
        'student11' => [
            'firstName' => "Louis",
            'lastName' => "JUNCA",
        ],
        'student12' => [
            'firstName' => "Mathieu",
            'lastName' => "KLOPP",
        ],
        'student13' => [
            'firstName' => "Lucas",
            'lastName' => "LABROUSSE",
        ],
        'student14' => [
            'firstName' => "Marie",
            'lastName' => "LAFFONT",
        ],
        'student15' => [
            'firstName' => "Lea",
            'lastName' => "LALLEMAND",
        ],
        'student16' => [
            'firstName' => "Etienne",
            'lastName' => "LORY",
        ],
        'student17' => [
            'firstName' => "Clement",
            'lastName' => "MEHAT",
        ],
        'student18' => [
            'firstName' => "Fanny",
            'lastName' => "MOUSSET",
        ],
        'student19' => [
            'firstName' => "Victor",
            'lastName' => "POUDAVIGNE",
        ],
        'student20' => [
            'firstName' => "Berenice",
            'lastName' => "RELLE",
        ],
        'student21' => [
            'firstName' => "Marie",
            'lastName' => "SIDAMBAROMPOULE",
        ],
        'student22' => [
            'firstName' => "Estelle",
            'lastName' => "VASCHE",
        ],
        'student23' => [
            'firstName' => "Marine",
            'lastName' => "AUTHIER",
        ],
        'student24' => [
            'firstName' => "Jean-Baptiste",
            'lastName' => "BEY",
        ],
        'student25' => [
            'firstName' => "Elise",
            'lastName' => "BODIN",
        ],
        'student26' => [
            'firstName' => "Romain",
            'lastName' => "BOISSONNET-MARQUET",
        ],
        'student27' => [
            'firstName' => "Elodie",
            'lastName' => "BORNET",
        ],
        'student28' => [
            'firstName' => "Emma",
            'lastName' => "BOUDEY",
        ],
        'student29' => [
            'firstName' => "Hanae",
            'lastName' => "BOUREKBA",
        ],
        'student30' => [
            'firstName' => "Mathis",
            'lastName' => "BRICOURT",
        ],
        'student31' => [
            'firstName' => "Leo",
            'lastName' => "BUTIN",
        ],
        'student32' => [
            'firstName' => "Loic",
            'lastName' => "DELEGLISE",
        ],
        'student33' => [
            'firstName' => "Mathis",
            'lastName' => "DHAYNAUT",
        ],
        'student34' => [
            'firstName' => "Leslie",
            'lastName' => "FEZANS",
        ],
        'student35' => [
            'firstName' => "Youness",
            'lastName' => "KOURTE",
        ],
        'student36' => [
            'firstName' => "Alexandre",
            'lastName' => "LECAS",
        ],
        'student37' => [
            'firstName' => "Celia-Yuka",
            'lastName' => "MARIGNAN",
        ],
        'student38' => [
            'firstName' => "Benjamin",
            'lastName' => "METAIS",
        ],
        'student39' => [
            'firstName' => "Nicolas",
            'lastName' => "SABLAYROLLES",
        ],
        'student40' => [
            'firstName' => "Blandine",
            'lastName' => "SERRE",
        ],
        'student41' => [
            'firstName' => "Theo",
            'lastName' => "SLIMANI",
        ],
        'student42' => [
            'firstName' => "Mathilde",
            'lastName' => "VINCENT",
        ],
        'student43' => [
            'firstName' => "Malko",
            'lastName' => "WATIN",
        ],
        'student44' => [
            'firstName' => "Iannis",
            'lastName' => "COUBLE",
        ],
        'student45' => [
            'firstName' => "Simon",
            'lastName' => "DURET",
        ],
        'student46' => [
            'firstName' => "Rudy",
            'lastName' => "KOUAME",
        ],
        'student47' => [
            'firstName' => "Theo",
            'lastName' => "METAIS",
        ],
        'student48' => [
            'firstName' => "Clarisse",
            'lastName' => "MONITOR",
        ],
        'student49' => [
            'firstName' => "Adrien",
            'lastName' => "ROY",
        ],
        'student50' => [
            'firstName' => "Raphael",
            'lastName' => "SABATIER",
        ],
        'student51' => [
            'firstName' => "Amir Berkane",
            'lastName' => "TERKMANE",
        ],    
    ];

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::STUDENTS as $studentRef => $data) {
            $student = new Student();
            $student->setFirstName($data["firstName"])
                ->setLastName($data["lastName"])
                ->setSecretKey(substr(uniqid(rand(), true), 5, 3));

            $this->addReference($studentRef, $student);
            $manager->persist($student);

            $user = new User();
            $hash = $this->encoder->encodePassword($user, "metaverse");

            // Supprimer les espaces dans les noms de famille pour le username
            $newLastname = str_replace(" ", "", $data["lastName"]);
            // Première lettre du prenom + . + nom (sans espace) (exemple: t.mouchelet)
            $username = strtolower($data["firstName"][0] . "." . $newLastname);

            $user->setUsername($username)
                ->setPassword($hash)
                ->setStudent($student);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
