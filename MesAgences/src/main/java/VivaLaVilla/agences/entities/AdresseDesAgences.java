package VivaLaVilla.agences.entities;

public class AdresseDesAgences {

    private int id_adresse;
    private String region;
    private String avenue;
    private String n_rue;
    private String code_postal;
    private int id_agence;
    private int id_coordonnees;


    public AdresseDesAgences (){}

    public AdresseDesAgences(int id_adresse, String region, String avenue, String n_rue, String code_postal, int id_agence, int id_coordonnees) {
        this.id_adresse = id_adresse;
        this.region = region;
        this.avenue = avenue;
        this.n_rue = n_rue;
        this.code_postal = code_postal;
        this.id_agence = id_agence;
        this.id_coordonnees = id_coordonnees;
    }

    public AdresseDesAgences(String region, String avenue, String n_rue, String code_postal, int id_agence, int id_coordonnees) {
        this.region = region;
        this.avenue = avenue;
        this.n_rue = n_rue;
        this.code_postal = code_postal;
        this.id_agence = id_agence;
        this.id_coordonnees = id_coordonnees;
    }

    public int getId_adresse() {
        return id_adresse;
    }

    public void setId_adresse(int id_adresse) {
        this.id_adresse = id_adresse;
    }

    public String getRegion() {
        return region;
    }

    public void setRegion(String region) {
        this.region = region;
    }

    public String getAvenue() {
        return avenue;
    }

    public void setAvenue(String avenue) {
        this.avenue = avenue;
    }

    public String getn_rue() {
        return n_rue;
    }

    public void setn_rue(String n_rue) {
        this.n_rue = n_rue;
    }

    public String getCode_postal() {
        return code_postal;
    }

    public void setCode_postal(String code_postal) {
        this.code_postal = code_postal;
    }

    public int getId_agence() {
        return id_agence;
    }

    public void setId_agence(int id_agence) {
        this.id_agence = id_agence;
    }

    public int getid_coordonnees() {
        return id_coordonnees;
    }

    public void setid_coordonnees(int id_coordonnees) {
        this.id_coordonnees = id_coordonnees;
    }

    @Override
    public String toString() {
        return "AdresseDesles_agences{" +
                "id_adresse=" + id_adresse +
                ", region='" + region + '\'' +
                ", avenue='" + avenue + '\'' +
                ", n_rue='" + n_rue + '\'' +
                ", code_postal='" + code_postal + '\'' +
                ", id_agence=" + id_agence +
                ", id_coordonnees=" + id_coordonnees +
                '}';
    }}
