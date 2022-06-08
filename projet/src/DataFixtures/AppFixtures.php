<?php

namespace App\DataFixtures;

use App\Entity\Conseillers;
use App\Entity\Creneau;
use App\Entity\RDV;
use App\Entity\ResponsableCons;
use App\Entity\Langue;
use App\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Langue
        $langue1 = new Langue();
        $langue1->setLangage("Français");
        $manager->persist($langue1);
        $langue2 = new Langue();
        $langue2->setLangage("Anglais");
        $manager->persist($langue2);
        $langue3 = new Langue();
        $langue3->setLangage("Chinois");
        $manager->persist($langue3);
        $langue4 = new Langue();
        $langue4->setLangage("Allemand");
        $manager->persist($langue4);

        //Specialité
        $specialite1 = new Specialite();
        $specialite1->setDomaine("Sport");
        $manager->persist($specialite1);
        $specialite2 = new Specialite();
        $specialite2->setDomaine("Evenement");
        $manager->persist($specialite2);
        $specialite3 = new Specialite();
        $specialite3->setDomaine("Musée");
        $manager->persist($specialite3);
        $specialite4 = new Specialite();
        $specialite4->setDomaine("Randonnée");
        $manager->persist($specialite4);

        //Conseil
        $conseil1 = new Conseillers();
        $conseil1->setNom('Pierre');
        $conseil1->setPrenom('Jean');
        $conseil1->setDateDeNaissance(new \DateTime('1997-03-27'));
        $conseil1->setEmail('pierre.jean@conseiller.fr');
        $conseil1->setTel("0607070707");

        $conseil1->addLangue($langue1);
        $conseil1->addLangue($langue2);

        $conseil1->addDomaine($specialite1);
        $conseil1->addDomaine($specialite3);
        $manager->persist($conseil1);

        $conseil2 = new Conseillers();
        $conseil2->setNom('Christe');
        $conseil2->setPrenom('Jesus');
        $conseil2->setDateDeNaissance(new \DateTime('0000-12-25'));
        $conseil2->setEmail('christe.jesus@conseiller.fr');
        $conseil2->setTel("0608080808");

        $conseil2->addLangue($langue1);
        $conseil2->addLangue($langue3);
        $conseil2->addLangue($langue4);

        $conseil2->addDomaine($specialite2);
        $conseil2->addDomaine($specialite4);
        $manager->persist($conseil2);

        $conseil3 = new Conseillers();
        $conseil3->setNom('Mbacler');
        $conseil3->setPrenom('Killian');
        $conseil3->setDateDeNaissance(new \DateTime('1998-12-20'));
        $conseil3->setEmail('mbacler.Killian@conseiller.fr');
        $conseil3->setTel("0609080909");

        $conseil3->addLangue($langue1);
        $conseil3->addLangue($langue2);
        $conseil3->addLangue($langue4);

        $conseil3->addDomaine($specialite1);
        $conseil3->addDomaine($specialite2);
        $conseil3->addDomaine($specialite4);
        $manager->persist($conseil3);

        $conseil4 = new Conseillers();
        $conseil4->setNom('Dupont');
        $conseil4->setPrenom('Jean-Marie');
        $conseil4->setDateDeNaissance(new \DateTime('1970-09-11'));
        $conseil4->setEmail('jeanmarie@hotmail.com');
        $conseil4->setTel('0666881109');
        $conseil4->addDomaine($specialite3);
        $conseil4->addLangue($langue1);
        $conseil4->addLangue($langue2);
        $manager->persist($conseil4);

        //Responsable des Conseillers
        $respCons = new ResponsableCons();
        $respCons->setNom('Saint');
        $respCons->setPrenom('Valentin');
        $respCons->setTel('0102030405');
        $respCons->setImageFile('defaultImageProfileRespCons.jpeg');
        $respCons->setEmail('saintValentin@gmail.com');
        $respCons->setPassword('password');
        $manager->persist($respCons);

        //Creneaux
        $creneau8h_10h = new Creneau();
        $creneau8h_10h->setTitre('Jesus Christe (Distanciel)');
        $creneau8h_10h->setHeureDebut(new \DateTime('2022-01-17 08:00'));
        $creneau8h_10h->setHeureFin(new \DateTime('2022-01-17 10:00'));
        $creneau8h_10h->setBackgroundColor('#345eeb');
        $creneau8h_10h->setBorderColor('#ffffff');
        $creneau8h_10h->setTextColor('#ffffff');
        $creneau8h_10h->addConseiller($conseil2);
        $manager->persist($creneau8h_10h);

        $creneau10h_12h = new Creneau();
        $creneau10h_12h->setTitre('Jesus Christe (Distanciel)');
        $creneau10h_12h->setHeureDebut(new \DateTime('2022-01-18 10:00'));
        $creneau10h_12h->setHeureFin(new \DateTime('2022-01-18 12:00'));
        $creneau10h_12h->setBackgroundColor('#345eeb');
        $creneau10h_12h->setBorderColor('#ffffff');
        $creneau10h_12h->setTextColor('#ffffff');
        $creneau10h_12h->addConseiller($conseil2);
        $manager->persist($creneau10h_12h);

        $creneau9h_12h = new Creneau();
        $creneau9h_12h->setTitre('Jean-Marie Dupont (Distanciel)');
        $creneau9h_12h->setHeureDebut(new \DateTime('2022-01-20 09:00'));
        $creneau9h_12h->setHeureFin(new \DateTime('2022-01-20 12:00'));
        $creneau9h_12h->setBackgroundColor('#ff0000');
        $creneau9h_12h->setBorderColor('#ffffff');
        $creneau9h_12h->setTextColor('#ffffff');
        $creneau9h_12h->addConseiller($conseil4);
        $manager->persist($creneau9h_12h);

        //RDV
        $RDV10h00_10h15 = new RDV();
        $RDV10h00_10h15->setTitre('RDV touriste');
        $RDV10h00_10h15->setDescription('Touriste : Quentin Marot');
        $RDV10h00_10h15->setStatus('AF');
        $RDV10h00_10h15->setHeureDebut(new \DateTime('2022-01-20 10:00'));
        $RDV10h00_10h15->setHeureFin(new \DateTime('2022-01-20 10:15'));
        $RDV10h00_10h15->setBackgroundColor('#ff0000');
        $RDV10h00_10h15->setBorderColor('#ffffff');
        $RDV10h00_10h15->setTextColor('#ffffff');
        $RDV10h00_10h15->setCreneau($creneau9h_12h);
        $RDV10h00_10h15->setConseillers($conseil4);
        $manager->persist($RDV10h00_10h15);

        $manager->flush();
    }
}
