package VivaLaVilla.agences.tests;

import VivaLaVilla.agences.entities.AdresseDesAgences;
import VivaLaVilla.agences.entities.Agence;
import VivaLaVilla.agences.entities.coordonnees;
import VivaLaVilla.agences.services.AdresseDesAgencesCrud;
import VivaLaVilla.agences.services.AgenceCrud;
import VivaLaVilla.agences.services.CoordonneesCrud;
import VivaLaVilla.agences.utils.MyConnection;

public class MainClass {

    public static void main(String[] args){
        MyConnection mc = new MyConnection();

        //AdresseDesAgencesCrud pcd = new AdresseDesles_agencesCrud();
        //AdresseDesAgences ADR = new AdresseDesles_agences(3,5,"nabeul","inkhilet",111,8555);
        //pcd.ModifierAgence(ADR);

        //Agence_location three = new Agence_location("hedi",12,8080,"hammamet");

        //AgenceCrud pcd = new AgenceCrud();


        //System.out.println(pcd.RechercherAdresse(1));
        // System.out.println(pcd.afficherCoordonnees());

        //Agence AGC = new Agence ("2","h","ww", 1,3);
        // pcd.ajouterAgence2(AGC);
        CoordonneesCrud pcd = new CoordonneesCrud();
        coordonnees AGC = new coordonnees(5,3,4,2);
        pcd.ajouterCoordonnees2(AGC);



        //CoordonneesCrud pcd = new CoordonneesCrud ();
        // coordonnees AGC = new coordonnees ( 1, 12.3f ,15.33f );
        //pcd.ajouterCoordonnees2(AGC);
        //System.out.println(pcd.afficherCoordonnees());


        // pcd.SupprimerAdresse(3);


        //pcd.RechercherAgence(1);




    }
}
