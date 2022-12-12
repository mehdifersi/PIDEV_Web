module com.example.mesagences {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.sql;


    opens com.example.mesagences to javafx.fxml;
    exports com.example.mesagences;
}