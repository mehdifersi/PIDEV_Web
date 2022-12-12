package VivaLaVilla.agences.entities;

public class Agence {
    private int id_agence;
    private String numTel_agence;
    private String email_agence;
    private String siteWeb_agence;
    private int id_adresse;
    private int id_coordonnees;

    public Agence() {
    };

    public Agence(String numTel_agence, String email_agence, String siteWeb_agence, int id_adresse, int id_coordonnees) {
        this.numTel_agence = numTel_agence;
        this.email_agence = email_agence;
        this.siteWeb_agence = siteWeb_agence;
        this.id_adresse = id_adresse;
        this.id_coordonnees = id_coordonnees;
    }

    public Agence(int id_agence, String numTel_agence, String email_agence, String siteWeb_agence, int id_adresse, int id_coordonnees) {
        this.id_agence = id_agence;
        this.numTel_agence = numTel_agence;
        this.email_agence = email_agence;
        this.siteWeb_agence = siteWeb_agence;
        this.id_adresse = id_adresse;
        this.id_coordonnees = id_coordonnees;
    }

    public int getId_agence() {
        return id_agence;
    }

    public void setId_agence(int id_agence) {
        this.id_agence = id_agence;
    }

    public String getNumTel_agence() {
        return numTel_agence;
    }

    public void setNumTel_agence(String numTel_agence) {
        this.numTel_agence = numTel_agence;
    }

    public String getEmail_agence() {
        return email_agence;
    }

    public void setEmail_agence(String email_agence) {
        this.email_agence = email_agence;
    }

    public String getSiteWeb_agence() {
        return siteWeb_agence;
    }

    public void setSiteWeb_agence(String siteWeb_agence) {
        this.siteWeb_agence = siteWeb_agence;
    }

    public int getId_adresse() {
        return id_adresse;
    }

    public void setId_adresse(int id_adresse) {
        this.id_adresse = id_adresse;
    }

    public int getId_coordonnees() {
        return id_coordonnees;
    }

    public void setId_coordonnees(int id_coordonnees) {
        this.id_coordonnees = id_coordonnees;
    }

    @Override
    public String toString() {
        return "Agence{" +
                "id_agence=" + id_agence +
                ", numTel_agence='" + numTel_agence + '\'' +
                ", email_agence='" + email_agence + '\'' +
                ", siteWeb_agence='" + siteWeb_agence + '\'' +
                ", id_adresse=" + id_adresse +
                ", id_coordonnees=" + id_coordonnees +
                '}';
    }
}