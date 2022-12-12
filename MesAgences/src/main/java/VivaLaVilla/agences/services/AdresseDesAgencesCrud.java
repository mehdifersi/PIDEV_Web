package VivaLaVilla.agences.services;

import VivaLaVilla.agences.entities.AdresseDesAgences;
import VivaLaVilla.agences.entities.Agence;
import VivaLaVilla.agences.utils.MyConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class AdresseDesAgencesCrud {

    public void ajouterAdresse2(AdresseDesAgences AD) {
        try {
            String requete2 = "INSERT INTO adresse_des_agences (region ,avenue ,n_rue,code_postal,id_agence,id_coordonnees) " + "VALUES (?,?, ? ,? ,?,?)";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete2);
            pst.setString(1, AD.getRegion());
            pst.setString(2, AD.getAvenue());
            pst.setString(3, AD.getn_rue());
            pst.setString(4, AD.getCode_postal());
            pst.setInt(5, AD.getId_agence());
            pst.setInt(6, AD.getid_coordonnees());
            pst.executeUpdate();
            System.out.println("votre adresse est ajoutée");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }

    }



    public List<AdresseDesAgences> afficherles_agences() {
        List<AdresseDesAgences> myList = new ArrayList<>();
        try {

            String requete2 = "SELECT * FROM adresse_des_agences";
            Statement st = new MyConnection().getCnx().createStatement();
            ResultSet rs = st.executeQuery(requete2);
            while (rs.next()) {
                AdresseDesAgences a = new AdresseDesAgences();
                a.setId_adresse(rs.getInt("id_adresse"));
                a.setRegion(rs.getString("region"));
                a.setAvenue(rs.getString("avenue"));
                a.setn_rue(rs.getString("n_rue"));
                a.setCode_postal(rs.getString("code_postal"));
                a.setId_agence(rs.getInt("id_agence"));
                a.setid_coordonnees(rs.getInt("id_coordonnees"));

                myList.add(a);
            }

        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        return myList;
    }

    public void ModifierAgence(AdresseDesAgences D) {

        try {

            String requete3 = "UPDATE `adresse_des_agences` SET `id_adresse`= ? ,`region`=?,`avenue`=?,`n_rue`= ?,`code_postal`=?,`id_agence`=?,`id_coordonnees`=? WHERE id_adresse= ?";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete3);
            pst.setInt(1, D.getId_adresse());
            pst.setString(2, D.getRegion());
            pst.setString(3, D.getAvenue());
            pst.setString(4, D.getn_rue());
            pst.setString(5, D.getCode_postal());
            pst.setInt(6, D.getId_agence());
            pst.setInt(7, D.getid_coordonnees());
            pst.setInt(8, D.getId_agence());

            pst.executeUpdate();
            System.out.println("Votre Adresse est modifie !!");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }

    public static void SupprimerAdresse(int id_agence) {
        try {
            String requete5 = "DELETE FROM adresse_des_agences WHERE id_agence= ?";
            PreparedStatement pst = new MyConnection().getCnx().prepareStatement(requete5);
            pst.setInt(1, id_agence);
            pst.executeUpdate();
            System.out.println("Votre adresse est supprime !!");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }

    public static List<AdresseDesAgences> RechercherAdresse( Integer id_agence ){
        List<AdresseDesAgences> myList = new ArrayList<>();
        try {

            String req8 = ("SELECT * from adresse_des_agences WHERE id_agence='" + id_agence  + "'");
            Statement st;
            Connection cnx = MyConnection.getInstance().getCnx();
            st = cnx.createStatement();




            ResultSet result = st.executeQuery(req8);
            while(result.next())
            {
                AdresseDesAgences a = new AdresseDesAgences();
                a.setId_adresse(result.getInt(1));
                a.setRegion(result.getString(2));
                a.setAvenue(result.getString(3));
                a.setn_rue(result.getString(4));
                a.setCode_postal(result.getString(5));
                a.setId_adresse(result.getInt(6));
                a.setId_adresse(result.getInt(7));


                myList.add(a);
                System.out.println(myList);
            }


        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        return myList;
    }
}