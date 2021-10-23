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
            'firstName' => "Alexander",
            'lastName' => "ALLAOU",
        ],
        'student2' => [
            'firstName' => "Vincent",
            'lastName' => "BERRERE",
        ],
        'student3' => [
            'firstName' => "Nassime",
            'lastName' => "BEL HAJ",
        ],
        'student4' => [
            'firstName' => "Aymane",
            'lastName' => "BENYAKHLEF",
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
            $hash = $this->encoder->encodePassword($user, "bootstrap");

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
