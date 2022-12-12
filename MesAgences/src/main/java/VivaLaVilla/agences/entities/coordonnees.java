package VivaLaVilla.agences.entities;

public class coordonnees {
    private int id_coordonnees ;
    private float latitude ;
    private float longitude ;
    private int id_agence ;
    private int id_adresse ;
    public coordonnees (){}

    public coordonnees(int id_coordonnees, float latitude, float longitude, int id_agence, int id_adresse) {
        this.id_coordonnees = id_coordonnees;
        this.latitude = latitude;
        this.longitude = longitude;
        this.id_agence = id_agence;
        this.id_adresse = id_adresse;
    }

    public coordonnees(float latitude, float longitude, int id_agence, int id_adresse) {
        this.latitude = latitude;
        this.longitude = longitude;
        this.id_agence = id_agence;
        this.id_adresse = id_adresse;
    }

    public int getId_coordonnees() {
        return id_coordonnees;
    }

    public void setId_coordonnees(int id_coordonnees) {
        this.id_coordonnees = id_coordonnees;
    }

    public float getLatitude() {
        return latitude;
    }

    public void setLatitude(float latitude) {
        this.latitude = latitude;
    }

    public float getLongitude() {
        return longitude;
    }

    public void setLongitude(float longitude) {
        this.longitude = longitude;
    }

    public int getId_agence() {
        return id_agence;
    }

    public void setId_agence(int id_agence) {
        this.id_agence = id_agence;
    }

    public int getId_adresse() {
        return id_adresse;
    }

    public void setId_adresse(int id_adresse) {
        this.id_adresse = id_adresse;
    }

    @Override
    public String toString() {
        return "coordonnees{" +
                "id_coordonnees=" + id_coordonnees +
                ", latitude=" + latitude +
                ", longitude=" + longitude +
                ", id_agence=" + id_agence +
                ", id_adresse=" + id_adresse +
                '}';
    }
}
