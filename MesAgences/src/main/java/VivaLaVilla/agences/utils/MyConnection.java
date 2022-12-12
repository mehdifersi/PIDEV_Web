package VivaLaVilla.agences.utils;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class MyConnection {
    public static MyConnection instance;

    public String url="jdbc:mysql://localhost:3306/mavilla";
    public String login="root";
    public String pwd="";
    Connection cnx ;

    public MyConnection() {
        try {
            cnx = DriverManager.getConnection(url,login,pwd);
            System.out.println("Connexion made!");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }

    public static MyConnection getInstance() {
        if (instance == null)
        {
            instance = new MyConnection();
        }
        return instance;

    }


    public Connection getCnx (){
        return cnx;
    }
}
