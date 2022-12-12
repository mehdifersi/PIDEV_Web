package VivaLaVilla.agences.Controller;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import java.net.URL;
import java.util.ResourceBundle;

public class ajoutAgenceController implements Initializable {
    @FXML
    private TextField region_adresse;

    @FXML
    private TextField email_agence;

    @FXML
    private TextField site_agence;

    @FXML
    private TextField num_agence;

    @FXML
    private TextField avenue_agence;

    @FXML
    private TextField rue_adresse;

    @FXML
    private TextField postal_adresse;

    @FXML
    private Button ajout_agence ;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {

    }
    @FXML
    private void FxAjoutAgence(ActionEvent event){


    }
}
