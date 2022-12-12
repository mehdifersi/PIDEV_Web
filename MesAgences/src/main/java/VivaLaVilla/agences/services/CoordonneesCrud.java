package VivaLaVilla.agences.services;

import VivaLaVilla.agences.entities.AdresseDesAgences;
import VivaLaVilla.agences.entities.Agence;
import VivaLaVilla.agences.entities.coordonnees;
import VivaLaVilla.agences.utils.MyConnection;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class CoordonneesCrud {


    public void ajouterCoordonnees2(coordonnees c) {
        try {
            String requete2 = "INSERT INTO les_coordonnes (latitude ,longitude ,id_agence,id_adresse ) " + "VALUES (?,?,?,?)";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete2);
            pst.setFloat(1, c.getLatitude());
            pst.setFloat(2, c.getLongitude());
            pst.setInt(3, c.getId_agence());
            pst.setInt(4, c.getId_adresse());



            pst.executeUpdate();
            System.out.println("votre agence est ajoutée");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }


    public List<coordonnees> afficherCoordonnees() {
        List<coordonnees> myList = new ArrayList<>();
        try {

            String requete3 = "SELECT * FROM les_coordonnes";
            Statement st = new MyConnection().getCnx().createStatement();
            ResultSet rs = st.executeQuery(requete3);
            while (rs.next()) {
                coordonnees a = new coordonnees();
                a.setId_coordonnees(rs.getInt("id_coordonnees"));
                a.setLatitude(rs.getFloat("latitude"));
                a.setLongitude(rs.getFloat("longitude"));
                a.setId_agence(rs.getInt("id_agence"));
                a.setId_adresse(rs.getInt("id_adresse"));


                myList.add(a);
            }

        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        return myList;
    }

    public void ModifierAgence(coordonnees D) {

        try {

            String requete3 = "UPDATE `Les_coordonnes` SET `id_coordonnees`= ? ,`latitude`=?,`longitude`=?,`id_agence`=?,`is_adresse`=? WHERE id_coordonnees= ?";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete3);
            pst.setInt(1, D.getId_coordonnees());
            pst.setFloat(2, D.getLongitude());
            pst.setFloat(3, D.getLongitude());
            pst.setInt(4, D.getId_coordonnees());


            pst.executeUpdate();
            System.out.println("Votre Adresse est modifie !!");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }

    public static void SupprimerAgence(int id_coordonnees) {
        try {
            String requete5 = "DELETE FROM Les_coordonnes WHERE id_coordonnees= ?";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete5);
            pst.setInt(1, id_coordonnees);
            pst.executeUpdate();
            System.out.println("Votre coordonnees est supprime !!");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }
}