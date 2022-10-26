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
            'firstName' => "Jean-Baptiste",
            'lastName' => "AUDEBERT",
        ],
        'student2' => [
            'firstName' => "Julien",
            'lastName' => "BACQUE",
        ],
        'student3' => [
            'firstName' => "Pierre",
            'lastName' => "BODIN",
        ],
        'student4' => [
            'firstName' => "Teddy",
            'lastName' => "BREGEON",
        ],
        'student5' => [
            'firstName' => "Maxime",
            'lastName' => "BROUSSE",
        ],
        'student6' => [
            'firstName' => "Tom",
            'lastName' => "CAILLERES",
        ],
        'student7' => [
            'firstName' => "Morgane",
            'lastName' => "DE BARROS",
        ],
        'student8' => [
            'firstName' => "Vincent",
            'lastName' => "DULOU",
        ],
        'student9' => [
            'firstName' => "Armand",
            'lastName' => "DURING",
        ],
        'student10' => [
            'firstName' => "Anna",
            'lastName' => "FRONTIN",
        ],
        'student11' => [
            'firstName' => "Capucine",
            'lastName' => "HOUEE",
        ],
        'student12' => [
            'firstName' => "Margaux",
            'lastName' => "JAY",
        ],
        'student13' => [
            'firstName' => "Gabriel",
            'lastName' => "JOANNY",
        ],
        'student14' => [
            'firstName' => "Kaoutar",
            'lastName' => "JOUDI",
        ],
        'student15' => [
            'firstName' => "Oriane",
            'lastName' => "LARIK",
        ],
        'student16' => [
            'firstName' => "Jeremy",
            'lastName' => "LESPRIT",
        ],
        'student17' => [
            'firstName' => "Dorian",
            'lastName' => "LEVENT",
        ],
        'student18' => [
            'firstName' => "Victor",
            'lastName' => "LEY",
        ],
        'student19' => [
            'firstName' => "Laetitia",
            'lastName' => "MULLIER",
        ],
        'student20' => [
            'firstName' => "Clement",
            'lastName' => "RODE",
        ],
        'student21' => [
            'firstName' => "Marine",
            'lastName' => "SOULAN",
        ],
        'student22' => [
            'firstName' => "Manon",
            'lastName' => "VETAULT",
        ]
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