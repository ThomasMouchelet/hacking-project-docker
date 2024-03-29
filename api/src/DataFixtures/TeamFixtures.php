<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TeamFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function getDependencies()
    {
        return [StudentFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        // Replacer par le nombre total d'étudiants
        $totalStudents = 21;
        $studentWithTeam = [];

        // Replacer par le nombre total d'étudiants / 2
        for ($i = 0; $i < 7; $i++) {
            $team = new Team();
            $studentsInTeam = [];

            // Replacer par le nombre d'étudiants par groupe
            for ($s = 0; $s < 3; $s++) {
                $selectedStudent = null;

                while (in_array($selectedStudent, $studentWithTeam) || $selectedStudent === null) {
                    $selectedStudent = rand(1, $totalStudents);
                }
                if (!in_array($selectedStudent, $studentWithTeam)) {
                    $student = $this->getReference("student" . $selectedStudent);
                    
                    array_push($studentWithTeam, $selectedStudent);
                    array_push($studentsInTeam, $student);
                    $team->addStudent($student);

                    // Ajouter un quatrième étudiant pour le dernier groupe
                    if($i === 6){
                        $lastStudent = $this->getReference("student22");
                        array_push($studentWithTeam, 23);
                        array_push($studentsInTeam, $lastStudent);
                        $team->addStudent($lastStudent);
                    }
                }
            }

            $teamName = "";
            $teamSecret = "";
            foreach ($studentsInTeam as $key => $student) {
                $firsName = substr(strtolower(str_replace(" ", "", $student->getFirstName())), 0, 3);
                $teamName .= $firsName;
                $teamSecret .= substr($student->getSecretKey(), 0, 3);
            };
            $team->setName($teamName);
            $team->setSecretKey($teamSecret);

            $manager->persist($team);

            $user = new User();
            $hash = $this->encoder->encodePassword($user, "123");

            $user->setUsername($teamName)
                ->setPassword($hash)
                ->setTeam($team);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
