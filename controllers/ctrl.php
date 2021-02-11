<?php
/*ini_set('session_cache_limiter', 'private');
session_cache_limiter(false);*/

session_start();

use \IlihoAlain\App_recomd\Models\DatabaseManager\UsersManager;

/* 15-05-2020 */

require_once('models/UsersManager.php');
require_once('PHPMAILER/PHPMailerAutoload.php');

class Ctrl {
	/**
	* @var $_dbManager UsersManager, the db manager
	*/
	private $_dbManager;

	/**
     * password for sending mails
     * @var   string
     */
    const PASSWORD = '';

    /**
     * email for sending mails
     * @var   string
     */
    const FROM = '';

    /**
     * @brief all action $_GET
     * @var $_actions
     */
    private $_actions = array
    (
    	'check_login_type', 'about', 'user_pat_active', 'user_med_active', 'cf_new_prof',
		'pr_rdv', 'profile_pat', 'search_spec', 'prf_rdv', 'cf_rdv', 'showRdv', 'list_suggested',
		'show_more', 'pr_rdv_apart', 'ch_prof_pat', 'sh_med_lang', 'set_up_pat', 'set_up_pat_cf',
		'delete_user_pat', 'sheachrdv', 'profile_med', 'set_tranch', 'get_tranch', 'up_tranche',
		'add_agenda', 'mes_rdv_med', 'more_pat_about', 'set_up_med', 'set_up_med_cf',
		'delete_user_med', 'rdv_conf', 'add_consul', 'consul_info', 'add_agendaf',
		'ch_prof_form', 'admin', 'admin_sign', 'admin_check', 'check_admin_type',
		'admin_interface', 'admin_log_out', 'all_patients', 'all_medecins', 'help_message',
		'help_list', 'delete_message', 'inscription_med', 'inscription_patient', 'user_auth',
		'add_medecin', 'add_patient', 'user_sign', 'logout_pat', 'logout_med', 'home'
	);

	public function __construct() { $this->_dbManager = new UsersManager(); }

	/* ====== Start Action Function ====== */
	/*
	*Inscritption med
	*/
	public function inscriptionMedAction() { require('views/InscriptionMedView.php'); }
	/*
	*Inscription pat
	*/
	public function inscriptionPatientAction() { require('views/InscriptionPatientView.php'); }
	/*
	*Ajout d'un médecin
	*/
	public function addMedecinAction()
	{
		$uniqueKeyMed = md5(uniqid(mt_rand()));
		$medecinInfos = array();
		if (isset($_POST['nom_med']) && !empty($_POST['nom_med']))
		{
			$medecinInfos[0] = htmlspecialchars($_POST['nom_med']);
		}
		if (isset($_POST['prenom_medecin']) && !empty($_POST['prenom_medecin']))
		{
			$medecinInfos[1] = htmlspecialchars($_POST['prenom_medecin']);
		}
		if(isset($_POST['date_medecin']) && !empty($_POST['date_medecin']))
		{
			$medecinInfos[2] = $_POST['date_medecin'];
		}
		if (isset($_POST['telephone']) && !empty($_POST['telephone']))
		{
			$medecinInfos[3] = htmlspecialchars($_POST['telephone']);
		}
		if (isset($_POST['email_medecin']) && !empty($_POST['email_medecin']))
		{
			$medecinInfos[4] = htmlspecialchars($_POST['email_medecin']);
		}
		if (isset($_POST['adresse_med']) && !empty($_POST['adresse_med']))
		{
			$medecinInfos[5] = htmlspecialchars($_POST['adresse_med']);
		}
		if (isset($_POST['ville_medecin']) && !empty($_POST['ville_medecin']))
		{
			// Cas de la ville
			$ville = ("public/ville.txt");
			$handle = fopen($ville, "r");
			$counter = 1;
			$ville_med = "";
			while ($line = fgets($handle)) {

				if ($_POST['ville_medecin'] == $counter)
				{
					$ville_med = $line;
					break;
				}
				$counter+=1;
			}
			$medecinInfos[6] = $_POST['ville_medecin'];
			fclose($handle);
		}
		if (isset($_POST['langue']) && !empty($_POST['langue']))
		{
			$medecinInfos[7] = htmlspecialchars($_POST['langue']);
		}
		if (isset($_POST['specialite']) && !empty($_POST['specialite']))
		{
			// Cas de la specialite
			$specialite = ("public/specialite.txt");
			$handle = fopen($specialite, "r");
			$compteur = 1;
			while ($line = fgets($handle)) {

				if ($_POST['specialite'] == $compteur)
				{
					$specialite = $line;
					break;
				}
				$compteur+=1;
			}
			$medecinInfos[8] = $specialite;
			fclose($handle);
		}
		if (isset($_POST['centre_sante']) && !empty($_POST['centre_sante']))
		{
			$medecinInfos[9] = htmlspecialchars($_POST['centre_sante']);
		}
		if (isset($_POST['user_medecin']) && !empty($_POST['user_medecin']))
		{
			$medecinInfos[10] = htmlspecialchars($_POST['user_medecin']);
		}
		if (isset($_POST['pass_medecin']) && !empty($_POST['pass_medecin']))
		{
			$medecinInfos[11] = md5(htmlspecialchars($_POST['pass_medecin']));
		}
		$medecinInfos[12] = $uniqueKeyMed;
		$medecinInfos[13] = $_POST['lat_medecin'];
		$medecinInfos[14] = $_POST['long_medecin'];

		/* Email Part To Doctors */
        $to = htmlspecialchars($_POST['email_medecin']);

        $theme = 'Compte Care';
        $subject = 'Création de compte';
        $content = "Bonjour,<br>Mercri d'avoir créer votre compte sur Care.
        <br>Veuillez confirmer votre compte pour profiter des services <strong><em>Care</em></strong><br>
        <a href='localhost/app_recomd/index.php?action=user_med_active&med_key=$uniqueKeyMed'>Cliquer ici pour confirmer votre compte</a>".
        "<br><h4>Care</h4><em>Votre Santé entre Vos Mains</em>";

		/*
		* Check if doctor added
		*/
		if ($this->_dbManager->addMedecin($medecinInfos) == true)
		{
			// Experience Part
			$med_id = $this->_dbManager->getMedecinId()->fetchColumn();
			$experiences = array();
			if (isset($_POST['nb_exprs']) && !empty($_POST['nb_exprs']))
			{
				for ($counter = 1; $counter <= (int)$_POST['nb_exprs']; $counter++)
				{
					$experiences[$counter-1] = array($_POST['expr'.$counter], $med_id);
				}
				$this->_dbManager->addExeperience($experiences);
			}
			$this->sendEmails($to, $theme, $subject, $content, self::FROM, self::PASSWORD);

			header('Location:index.php?action=user_auth&added_user='.true);
		} else {
			header('Location:index.php?action=inscription_med&not='.true);
		}
	}

	/**
	 * @brief Ajouter un patient
	*/
	public function addPatientAction()
	{
		$uniqueKeyPat = md5(uniqid(mt_rand()));
		$patientInfo = array(
			htmlspecialchars($_POST['nomPatient']),
			htmlspecialchars($_POST['prenomPatient']),
			htmlspecialchars($_POST['dateNaissanceP']),
			htmlspecialchars($_POST['telephonePatient']),
			htmlspecialchars($_POST['emailPatient']),
			htmlspecialchars($_POST['adressePatient']),
			htmlspecialchars($_POST['villePatient']),
			htmlspecialchars($_POST['loginPatient']),
			md5(htmlspecialchars($_POST['passwordPatient'])),
			$uniqueKeyPat
		);

		/* Email Part To Patients */
        $to = htmlspecialchars($_POST['emailPatient']);

        $theme = 'Compte Care';
        $subject = 'Création de compte';
        $content = "Bonjour,<br>Mercri d'avoir créer votre compte sur Care.
        <br>Veuillez confirmer votre compte pour profiter des services <strong><em>Care</em></strong><br>
        <a href='localhost/app_recomd/index.php?action=user_pat_active&pat_key=$uniqueKeyPat'>Cliquer ici pour confirmer votre compte</a>".
        "<br><h4>Care</h4><em>Votre Santé entre Vos Mains</em>";

		// Add to db Step
		if ($this->_dbManager->addPatient($patientInfo) == true)
		{
			$this->sendEmails($to, $theme, $subject, $content, self::FROM, self::PASSWORD);
			header('Location:index.php?action=user_auth&added_user='.true);
		} else {
			header('Location:index.php?action=inscription_patient&not='.true);
		}
	}
	/**
	 * @brief User Authentification Page
	*/
	public function userAuthAction() { require_once ('views/userAuthView.php');}
	/*
	* Afficher le profil du patient
	*/
	public function profilePatAction()
	{
		if ($this->patientLoggedIn())
		{
			require('views/pat_views/userProfilePatView.php');
		} else {
			header('Location:index.php?action=user_auth');
		}

	}

	/*
	*Prise de rendez-vous
	*/
	public function prendreRdvAction()
	{
		if ($this->patientLoggedIn())
		{
			$medTranchH = $this->_dbManager->getTranche(array($_GET['_idmed']));
            if( $medTranchH->fetchAll() == NULL )
            {
                echo "<h2 class='text-secondary text-center'>L`agenda de ce médecin n'est pas encore disponible !</h2 class='text-center'>";
                $medTranchH->closeCursor();
            } else {
                $medTranchH = $this->_dbManager->getTranche(array($_GET['_idmed']));
                $datesArray = $this->getRdvDatesAction();
                require('views/prendreRendezVous.php');
            }

		} else {
			header('Location:index.php?action=user_auth');
		}
	}
	/*======================================================
	* GetRdvDatesAction
	*/
	public function getRdvDatesAction()
	{
		if ($this->patientLoggedIn())
		{
			$dates = $this->_dbManager->getRdvDates();
			$datesArray = array(); $counter = 0;
			while ($data = $dates->fetch(PDO::FETCH_NUM))
			{
				$datesArray[$counter] = $data[0];
				$counter +=1;
			}
			return $datesArray;
		} else {
			header('Location:index.php?action=user_auth');
		}
	}
	/*
	*GetRdvHeuresAction
	*/
	public function getRdvHeuresAction($date)
	{
		if ($this->patientLoggedIn())
		{
			$hours = $this->_dbManager->getRdvHeures($date);
			$hoursArray = array(); $counter = 0;

			while ($data = $hours->fetch(PDO::FETCH_NUM))
			{
				$hoursArray[$counter] = date('H:i', strtotime($data[0]));
				$counter +=1;
			}
			return $hoursArray;
		} else {
			header('Location:index.php?action=user_auth');
		}
	}

    /**
     * @brief prendreFormeRdvAction
     */
	public function prendreFormeRdvAction()
	{
		if ($this->patientLoggedIn())
		{
			require_once('views/prendreRendezVousViewForm.php');
		} else {
			header('Location:index.php?action=user_auth');
		}
	}
    /**
     * @brief Confirmer le rdv
     */
	public function cfRendezVousAction()
	{
        if ($this->patientLoggedIn())
        {
			$rdvArr = array();
			if (isset($_POST['motif_rdv']) && !empty($_POST['motif_rdv']))
			{
				$rdvArr[0] = $_POST['motif_rdv'];
				if (isset($_POST['date_rdv']) && !empty($_POST['date_rdv']))
				{
					$rdvArr[1] = date('Y-m-d', strtotime($_POST['date_rdv']));
				}
				if (isset($_GET['user_med']) && !empty($_GET['user_med']))
				{
					$rdvArr[2] = (int)$_GET['user_med'];
				}
				if (isset($_GET['user_pat']) && !empty($_GET['user_pat']))
				{
					$rdvArr[3] = (int)$_GET['user_pat'];
				}
				if (isset($_POST['heure_rdv']) && !empty($_POST['heure_rdv']))
				{
					$rdvArr[4] = date('H:i', strtotime($_POST['heure_rdv']));
				}

				$rdvTakenTime = getdate()['year'].'-'.getdate()['mon'].'-'.getdate()['mday'];
				$rdvArr[5] = $rdvTakenTime;

				/* Email Part To Patients */
				$email = $this->_dbManager->getPatientEmail(htmlspecialchars($_GET['user_pat']));
	            $to = $email->fetchColumn();

	            $theme = 'Care Appointment';
	            $subject = 'Appointment Taken';
	            $content = "Bonjour,<br>Mercri d'avoir pris votre rendez-vous sur Care.<br>
	            Votre rendez-vous pour ".htmlspecialchars($_POST['motif_rdv'])."<br> pris pour le ".htmlspecialchars($_POST['date_rdv'])." à ".htmlspecialchars($_POST['heure_rdv'])."
	            été confirmé !<br><h1>Care</h1><br><strong>Consultez la liste de vos rendez-vous sur care</strong><br>
	            <em>Votre Santé entre Vos Mains</em>";

	            /* Email Part To Doctors */
				$emailToMed = $this->_dbManager->getMedecinEmail(htmlspecialchars($_GET['user_med']));
	            $toMed = $emailToMed->fetchColumn();

	            $subjectToMed = 'Booked Appointment';
	            $contentToMed = "Bonjour,<br>Un rendez-vous a été pris par un patient sur <strong>Care</strong> pour vous.<br>Briève description du motif :<em>".htmlspecialchars($_POST['motif_rdv'])."</em><br>Pour le ".htmlspecialchars($_POST['date_rdv'])." à ".htmlspecialchars($_POST['heure_rdv'])."<br><strong>Consultez la liste de vos rendez-vous sur care</strong><br><em>Votre Santé entre Vos Mains</em>";

				if ($this->_dbManager->addRendezVous($rdvArr) == true) {

	                $this->sendEmails($to, $theme, $subject, $content, self::FROM, self::PASSWORD);
	                $this->sendEmails($toMed, $theme, $subjectToMed, $contentToMed, self::FROM, self::PASSWORD);
					header('Location:index.php?action=profile_pat');
				}
			} else { echo "<h2> Informations non renseignées !</h2>"; }
		} else {
			header('Location:index.php?action=user_auth');
		}

	}

    /**
     * @brief Pour les rendez-vous d'un patients
     */
	public function showRdvAction()
	{

		if ($this->patientLoggedIn())
		{
			if (isset($_GET['_idpat']) && !empty($_GET['_idpat']))
			{
				$id_pat = (int)htmlspecialchars($_GET['_idpat']);
				$gotRdv = $this->_dbManager->getRendezVPatient($id_pat);
				if ($gotRdv->fetchAll() == NULL)
				{
					echo "<h3 class='text-center'>Vous n'avez pas encore pris de rendez-vous</h3>";
				} else {
					$gotRdv = $this->_dbManager->getRendezVPatient($id_pat);
					require_once('views/pat_views/listRendezVousView.php');
				}
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
	}

    /**
     * @brief Show infos of rendez Patient Side
     */
	public function ShowEachRdvAction()
	{
		if ($this->patientLoggedIn())
		{	if (isset($_GET['user_med']) && !empty($_GET['user_med']))
			{
				$med_id = (int)$_GET['user_med'];
				$medecin = $this->_dbManager->getMedecinUsingId($med_id);
				$data = $medecin->fetch(PDO::FETCH_ASSOC);
				require_once('views/ShEachRdvView.php');
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
	}

    /**
     * @brief Deconnexion d'un patient
     */
	public function logoutPatientAction()
	{
		session_destroy();
		unset(
			$_SESSION['login'], $_SESSION['nom'], $_SESSION['prenom'],
			$_SESSION['email'], $_SESSION['tel'], $_SESSION['adresse'],
			$_SESSION['ville'], $_SESSION['id_pat'], $_SESSION['url'],
			$_SESSION['data_n']
		);
		header('Location:index.php?action=user_auth');
	}

    /**
     * @brief Deconnexion du medecin
     */
	public function logoutMedecinAction()
	{
		// session_destroy();
		unset(
			$_SESSION['login_med'], $_SESSION['LAT'], $_SESSION['nom_med'],
			$_SESSION['prenom_med'], $_SESSION['email_med'], $_SESSION['ad_med'],
			$_SESSION['tel_med'],$_SESSION['cste_med'], $_SESSION['ville_med'],
			$_SESSION['date_med'], $_SESSION['spe_med'],$_SESSION['recomd_t'],
			$_SESSION['lg_med'], $_SESSION['picture'], $_SESSION['idMedecin'],
			$_SESSION['date_med']
		);
		header('Location:index.php?action=user_auth');
	}

    /**
     * @brief Home Action
     */
	public function homeAction() { require('views/HomeView.php'); }

    /**
     * @brief When research is done from user profile(search_spec)
     */
	public function searchSpecialiteAction()
	{
		if ($this->patientLoggedIn())
		{
			if (isset($_GET['specialite']) && !empty($_GET['specialite']))
			{
				$medNames = $this->_dbManager->getMedFullName($_GET['specialite']);
				require('views/specSearchView.php');
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
	}

	/*
	*set_tranch
	*/
	public function setTrancheAction()
	{
		if ($this->medecinLoggedIn())
		{
			$med_tranche = $this->_dbManager->getTranche(array($_GET['_idmed']));
			if ($med_tranche->fetchAll() == NULL) {
				echo "<h1 class='text-center bg-danger'>Votre agenda est pour le moment vide !</h1>";
			} else {
				$med_tranche = $this->_dbManager->getTranche(array($_GET['_idmed']));
				require('views/setTrancheView.php');
			}
		}
	}

    /**
     * @brief getTrancheAction
     */
	public function getTrancheAction()
	{
		if ($this->medecinLoggedIn())
		{
			if (isset($_GET['_idmed']) && !empty($_GET['_idmed']))
			{
				$med_tranche = $this->_dbManager->getTranche(array($_GET['_idmed']));
				if ($med_tranche->fetchAll() == NULL)
				{
					echo "<h3>Votre agenda est pour le moment vide !</h3>"."<br><em>Veuillez l'ajouter</em>";
				} else {
					$med_tranche = $this->_dbManager->getTranche(array($_GET['_idmed']));
					require('views/medTrancheView.php');
				}
			}
			else { echo 'No tranche !';}
		}
	}

    /**
     * @brief Validate tranche set up
     */
	public function upTrancheAction()
	{
		if ($this->medecinLoggedIn())
		{
			if (isset($_POST['checkbtn']))
			{
				$lundi = array(date('Y-m-d', strtotime($_POST['date_lu'])), $_POST['start_lu'], $_POST['end_lu'], $_POST['_lu']);
				$mardi = array(date('Y-m-d',strtotime($_POST['date_ma'])), $_POST['start_ma'], $_POST['end_ma'], $_POST['_ma']);
				$mercredi = array(date('Y-m-d',strtotime($_POST['date_me'])), $_POST['start_me'], $_POST['end_me'], $_POST['_me']);
				$jeudi = array(date('Y-m-d',strtotime($_POST['date_je'])), $_POST['start_je'], $_POST['end_je'], $_POST['_je']);
				$vendredi = array(date('Y-m-d',strtotime($_POST['date_ve'])), $_POST['start_ve'], $_POST['end_ve'], $_POST['_ve']);
				$samedi = array(date('Y-m-d',strtotime($_POST['date_sa'])), $_POST['start_sa'], $_POST['end_sa'], $_POST['_sa']);
				$dimanche = array(date('Y-m-d',strtotime($_POST['date_di'])), $_POST['start_di'], $_POST['end_di'], $_POST['_di']);

				$all_tranche = array($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi, $dimanche);

				$up_data = $this->_dbManager->updateTranche($all_tranche);
				if ($up_data == true) { $this->profileMedAction(); }
				else { echo 'Not updated !';}
			}
			else { echo 'Nothing has been changed !f'; }
		}
	}

    /**
     * @brief  addAgendaFormAction
     */
	public function addAgendaFormAction()
	{
		if ($this->medecinLoggedIn()) { require('views/addAgendaFormView.php'); }
	}

    /**
     * @brief addAgendaAction
     */
	public function addAgendaAction()
	{
		/*idTranche`, `jourTranche`, `dateTranche`, `heureDebut`, `heureFin`, tranches.idMedecin*/
		if ($this->medecinLoggedIn())
		{
			if (isset($_GET['_medId']) && !empty($_GET['_medId']))
			{
	            /* Lundi */
				$lu_arr = array();
				if (isset($_POST['lu_date']) && !empty($_POST['lu_date']))
				{
					$lu_arr[0] = 'Lundi';
					$lu_arr[1] = $_POST['lu_date'];
					if(isset($_POST['lu_h_d']) && !empty($_POST['lu_h_d']))
					{
						$lu_arr[2] = $_POST['lu_h_d'];
					}
					if(isset($_POST['lu_h_f']) && !empty($_POST['lu_h_f']))
					{
						$lu_arr[3] = $_POST['lu_h_f'];
					}
					$lu_arr[4] = $_GET['_medId'];
				}

				/* Mardi */
				$ma_arr = array();
				if (isset($_POST['ma_date']) && !empty($_POST['ma_date']))
				{
					$ma_arr[0] = 'Mardi';
					$ma_arr[1] = $_POST['ma_date'];
					if(isset($_POST['ma_h_d']) && !empty($_POST['ma_h_d']))
					{
						$ma_arr[2] = $_POST['ma_h_d'];
					}
					if(isset($_POST['ma_h_f']) && !empty($_POST['ma_h_f']))
					{
						$ma_arr[3] = $_POST['ma_h_f'];
					}
					$ma_arr[4] = $_GET['_medId'];
				}
				/* Mercredi */
				$me_arr = array();
				if (isset($_POST['me_date']) && !empty($_POST['me_date']))
				{
					$me_arr[0] = 'Mercredi';
					$me_arr[1] = $_POST['me_date'];
					if(isset($_POST['me_h_d']) && !empty($_POST['me_h_d']))
					{
						$me_arr[2] = $_POST['me_h_d'];
					}
					if(isset($_POST['me_h_f']) && !empty($_POST['me_h_f']))
					{
						$me_arr[3] = $_POST['me_h_f'];
					}
					$me_arr[4] = $_GET['_medId'];
				}
				/* Jeudi */
				$je_arr = array();
				if (isset($_POST['je_date']) && !empty($_POST['je_date']))
				{
					$je_arr[0] = 'Jeudi';
					$je_arr[1] = $_POST['je_date'];
					if(isset($_POST['je_h_d']) && !empty($_POST['je_h_d']))
					{
						$je_arr[2] = $_POST['je_h_d'];
					}
					if(isset($_POST['je_h_f']) && !empty($_POST['je_h_f']))
					{
						$je_arr[3] = $_POST['je_h_f'];
					}
					$je_arr[4] = $_GET['_medId'];

				}
				/* Vendredi */
				$ve_arr = array();
				if (isset($_POST['ve_date']) && !empty($_POST['ve_date']))
				{
					$ve_arr[0] = 'Vendredi';
					$ve_arr[1] = $_POST['ve_date'];
					if(isset($_POST['ve_h_d']) && !empty($_POST['ve_h_d']))
					{
						$ve_arr[2] = $_POST['ve_h_d'];
					}
					if(isset($_POST['ve_h_f']) && !empty($_POST['ve_h_f']))
					{
						$ve_arr[3] = $_POST['ve_h_f'];
					}
					$ve_arr[4] = $_GET['_medId'];
				}
				/* Samedi */
				$sa_arr = array();
				if (isset($_POST['sa_date']) && !empty($_POST['sa_date']))
				{
					$sa_arr[0] = 'Samedi';
					$sa_arr[1] = $_POST['sa_date'];
					if(isset($_POST['sa_h_d']) && !empty($_POST['sa_h_d']))
					{
						$sa_arr[2] = $_POST['sa_h_d'];
					}
					if(isset($_POST['sa_h_f']) && !empty($_POST['sa_h_f']))
					{
						$sa_arr[3] = $_POST['sa_h_f'];
					}
					$sa_arr[4] = $_GET['_medId'];
				}
				/* Dimanche */
				$di_arr = array();
				if (isset($_POST['di_date']) && !empty($_POST['di_date']))
				{
					$di_arr[0] = 'Dimanche';
					$di_arr[1] = $_POST['di_date'];
					if(isset($_POST['di_h_d']) && !empty($_POST['di_h_d']))
					{
						$di_arr[2] = $_POST['di_h_d'];
					}
					if(isset($_POST['di_h_f']) && !empty($_POST['di_h_f']))
					{
						$di_arr[3] = $_POST['di_h_f'];
					}
					$di_arr[4] = $_GET['_medId'];
				}
				$agendaArr = array($lu_arr, $ma_arr, $me_arr, $je_arr, $ve_arr, $sa_arr, $di_arr);
				//print_r($agendaArr);
				if ($this->_dbManager->addTrancheMed($agendaArr) == true)
				{
					// header('ctrl.php?action=profile_pat');
					$this->profileMedAction();
				}
			} else {
				echo 'OH ! id_med non reçu !';
			}
		}
	}
	/*
	* ch_prof_form
	*/
	public function changeprofFormAction() {require_once('views/chprofFormView.php');}
	/**
	 * @brief cf_new_prof picture
	*/
	public function confirmerNewprofileAction()
	{
		if ($this->medecinLoggedIn())
		{
			$extensions = array('image/jpg', 'image/jpeg', 'image/png');
			if ($_FILES['new_profile_ph']['size'] > 0 )
			{
				// cf_new_prof med_prof
				if (in_array($_FILES['new_profile_ph']['type'], $extensions))
				{
					$source = $_FILES['new_profile_ph']['tmp_name'];
					$extension = explode('.', $_FILES['new_profile_ph']['name']);
					$extension = end($extension);
					$url = uniqid(mt_rand());
					$newUrl = array($url.'.'.$extension, htmlspecialchars($_POST['med_prof']));
					if ($this->_dbManager->addUrlMedecin($newUrl) == true)
					{
						$targetDir = './public/images/'.$url.'.'.$extension;
						move_uploaded_file($source, $targetDir);
						$this->userSignAction();
					} else {
						echo "not inserted";
					}
				}
			}
		}

	}

	/**
	 * @brief recommandation function
	 * @details recommand doctors to the patient using latiude & longitude or city of th patient
	 */
    public function listSuggestedDocAction()
    {
    	if ($this->patientLoggedIn())
    	{
	        if (isset($_GET['patVille']) && !empty($_GET['patVille']))
	        {
	        	/**
	        	 * @brief latitude longitude
	        	 */
	        	if (isset($_GET['latitude']) && !empty($_GET['latitude']))
	        	{
	        		$latPat =(double)htmlspecialchars($_GET['latitude']);
	        		$longPat = (double)htmlspecialchars($_GET['longitude']);

	        		$medLatLong = $this->_dbManager->getMedecinLatLong(1);
	        		if ($medLatLong == true)
	        		{
								$distances = array();
	        			while ($coords = $medLatLong->fetch(PDO::FETCH_BOTH))
	        			{
	        				$distances[$coords[0]] = $this->calculatePatMedDist($latPat, $longPat, $coords[1], $coords[2]);
	        			}
	        			asort($distances);		// Sorting distances
	        			$medLogin = array_keys($distances);		// Getting indexes(login) for displaying

	        			$medecins = $this->_dbManager->getMedecinValid(1);
        				require('views/pat_views/listSuggestedDocGeolView.php');
	        		}else {
								echo "<h3>La liste de médecins recommandés est pour le momont vide !<h3>";
							}
	        	}
	        	/**
	        	 * @brief no latitute and longitude
	        	 */
	        	else
	        	{
		            $ville = htmlspecialchars($_GET['patVille']);
		            if ($this->_dbManager->getSuggestedDocs($ville)->fetch(PDO::FETCH_NUM) == NULL)
		            {
		            	echo "<h3>La liste de médecins recommandés est pour le moment vide !</h3>";
		            } else {
		            	$suggestedDoc = $this->_dbManager->getSuggestedDocs($ville);
		            	require('views/pat_views/listSuggestedDocView.php');
		            }
		        }
	        }
	        else { echo "<h3>La liste de médecins recommandés est pour le moment vide !</h3>";}
	    } else {
	    	header('Location:index.php?action=user_auth');
	    }
    }

    /**
     * @brief User Authentification Check
     */
	public function userSignAction()
	{
		if((isset($_POST['user_login']) && isset($_POST['user_passw'])) && (!empty($_POST['user_login']) && !empty($_POST['user_passw'])))
		{
			$user_infos_auth = array(
				htmlspecialchars($_POST['user_login']),
				md5($_POST['user_passw'])
			);

			// Cas d'un medecin
			if (isset($_POST['med_check']) && !empty($_POST['med_check']))
			{
				$medecin = $this->_dbManager->userSignMedecin($user_infos_auth)->fetchAll();
				if ($medecin[0][0] == 1)
				{
					// Check Account Activation
					$user_login = $user_infos_auth[0];
					if($this->_dbManager->medecinCheckActivation($user_login)->fetchColumn() == 1)
					{
						$login_med = $user_login;
						$medecin = $this->_dbManager->getMedecin(array($login_med));
	                    $data = $medecin->fetch(PDO::FETCH_ASSOC);
						$_SESSION['login_med'] = $login_med;
						$_SESSION['LAT'] = time();
						$_SESSION['nom_med'] = $data['nomMedecin'];
						$_SESSION['prenom_med'] = $data['prenomMedecin'];
						$_SESSION['email_med'] = $data['emailMedecin'];
						$_SESSION['ad_med'] = $data['adresseMedecin'];
						$_SESSION['tel_med'] = $data['telephoneMedecin'];
						$_SESSION['cste_med'] = $data['centreSante'];
						$_SESSION['ville_med'] = $data['villeMedecin'];
						$_SESSION['date_med'] = $data['dateNaissanceM'];
						$_SESSION['spe_med'] = $data['specialite'];
						$_SESSION['recomd_t'] = $data['tauxRecomd'];
						$_SESSION['lg_med'] = $data['langue'];
						$_SESSION['picture'] = $data['url'];
						$_SESSION['idMedecin'] = $data['idMedecin'];
						$_SESSION['date_med'] = $data['dateNaissanceM'];

						header('Location:index.php?action=profile_med&user='.strtolower($_SESSION['nom_med'].'_'.$_SESSION['prenom_med']));

					} else {header('Location:index.php?action=user_auth&active=3');}
				}
				else { header('Location:index.php?action=user_auth&error=1'); }
			}

			else // Cas d'un patient
			{
				$patient = $this->_dbManager->userSignPatient($user_infos_auth)->fetchAll();
				if ($patient[0][0] == 1)
				{
					// Patient checkAccountActivated
					$user_login = $user_infos_auth[0];
					if($this->_dbManager->patientCheckActivation($user_login)->fetchColumn() == 1)
					{
						$patient = $this->_dbManager->getPatient(array($user_login));
						$data = $patient->fetch(PDO::FETCH_ASSOC);

						$_SESSION['login'] = $_POST['user_login'];
						$_SESSION['nom'] = $data['nomPatient'];
						$_SESSION['prenom'] = $data['prenomPatient'];
						$_SESSION['email'] = $data['emailPatient'];
						$_SESSION['tel'] = $data['telephonePatient'];
						$_SESSION['adresse'] = $data['adressePatient'];
						$_SESSION['ville'] = $data['villePatient'];
						$_SESSION['id_pat'] = $data['idPatient'];
						$_SESSION['url'] = $data['url'];
						$_SESSION['data_n'] = $data['dateNaissanceP'];

						header('Location:index.php?action=profile_pat&user='.strtolower($_SESSION['nom'].'_'.$_SESSION['prenom']));

					} else {header('Location:index.php?action=user_auth&active=3');}
				}
				else { header('Location:index.php?action=user_auth&error=1'); }
			}
		}
		else { $this->userAuthAction(); }
	}

	/**
     * @brief Afficher le profil du medecin
     */
	public function profileMedAction()
	{
		if ($this->medecinLoggedIn())
		{
			require('views/userProfileViewMed.php');
		}
	}
	/**
     * @brief Show more infos about on plus click
     */
	public function showMoreMedInfosAction()
	{
		if ($this->patientLoggedIn())
		{	if (isset($_GET['idMedMore']) && !empty($_GET['idMedMore']))
			{
				$idMedecin = (int)htmlspecialchars($_GET['idMedMore']);
				$medecin = $this->_dbManager->getMedecinUsingId($idMedecin);
				require('views/med_views/moreAboutDocView.php');
			}
			else
			{
				echo "<h3>Informations non existantes</h3>";
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
	}

    /**
     * @brief  prendreRdvApartAction : book by speciality
     */
	public function prendreRdvApartAction()
	{
		if ($this->patientLoggedIn())
		{
			$medTranchH = $this->_dbManager->getTranche(array($_GET['_idmed']));
			if( $medTranchH->fetchAll() == NULL )
			{
				require_once('views/notExistRequestedView.php');
			}
			else {
				$medTranchH = $this->_dbManager->getTranche(array($_GET['_idmed']));
				$datesArray = $this->getRdvDatesAction();
				require('views/pat_views/prendreRdvApartView.php');
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
	}
    /**
     * @brief Sending email confirming account booked Appointment
     * @param $to string the recipient
     * @param $theme string type of email
     * @param $subject string the subject
     * @param $content string the boy of email
     * @param $from string the sender email
     * @param $password string sender email password
     * @return bool
     */
	public function sendEmails($to, $theme, $subject, $content, $from, $password) {

		$mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;

    $mail->setFrom($from, $theme);
    $mail->addAddress($to);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $content;
    return $mail->send();
	}

	/**
     * @brief index.php?action=mes_rdv_med&identif
     */
    public function mesRdvmedecinAction()
    {
    	if ($this->medecinLoggedIn())
	    {
	    	if (isset($_GET['identif']) && !empty($_GET['identif']))
	    	{
	    		$identif = (int)htmlspecialchars($_GET['identif']);
	    		$med_rdvQ = $this->_dbManager->getRendezVMedecin($identif);

	    		if ($med_rdvQ->fetchAll() == NULL)
	    		{
	    			echo "<h3 class='text-center'>La liste des rendez-vous pris par les patients est pour le moment vide !</h3>";
	    			$med_rdvQ->closeCursor();
	    		} else {
	    			$med_rdvQ = $this->_dbManager->getRendezVMedecin($identif);
	    			require('views/med_views/mesRdvView.php');
	    		}
	    	}
	    }
    }

    /**
     * @brief more_pat_&identifPat
     */
    public function moreAboutPatAction()
    {
    	if ($this->medecinLoggedIn())
    	{
	    	if (isset($_GET['user_pat_id']) && !empty($_GET['user_pat_id']))
	    	{
	    		$identifPat = (int)htmlspecialchars($_GET['user_pat_id']);
	    		$patient = $this->_dbManager->getPatientInfos($identifPat);
	    		require_once('views/med_views/moreAboutPatView.php');
	    	} else {
	    		if (isset($_GET['user_patId']) && !empty($_GET['user_patId']))
	    		{
	    			$patient = $this->_dbManager->getPatientInfos((int)$_GET['user_patId']);
	    			require_once('views/med_views/moreAboutPatViewAside.php');
	    			// print_r($patient->fetchAll());
	    		}
	    	}
	    }
    }

    /**
     * @brief changeProfilPatAction
     */
    public function changeProfilPatAction()
    {
    	if ($this->patientLoggedIn())
	    {	if (isset($_GET['pat_profil']) && !empty($_GET['pat_profil']))
	    	{
	    		$extensions = array('image/jpg', 'image/jpeg', 'image/png');
				if ($_FILES['new_profile_ph']['size'] > 0 )
				{
					if (in_array($_FILES['new_profile_ph']['type'], $extensions))
					{
						$source = $_FILES['new_profile_ph']['tmp_name'];
						$extension = explode('.', $_FILES['new_profile_ph']['name']);
						$extension = end($extension);
						$url = uniqid(mt_rand());
						$newUrl = array($url.'.'.$extension, htmlspecialchars($_GET['pat_profil']));
						if ($this->_dbManager->addUrlPatient($newUrl) == true)
						{
							$targetDir = './public/images/'.$url.'.'.$extension;
							move_uploaded_file($source, $targetDir);
							$this->userSignAction();
						}
					}
				}
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
    }

    /**
     * @brief shMedLangueAction
     */
    public function shMedLangueAction()
    {
    	if ($this->patientLoggedIn())
    	{
	    	if (isset($_GET['lang_sel']) && !empty($_GET['lang_sel']))
	    	{
	    		$langue = "";
	    		$indexLang = (int)htmlspecialchars($_GET['lang_sel']);
	    		if ($indexLang == 1 ) {$langue = 'Français';}
	    		elseif ($indexLang == 2 ) {$langue = 'Arabe';}
	    		else {$langue = 'Anglais';}

	    		$medNames = $this->_dbManager->getMedFullNameLang($langue);
				require('views/specSearchView.php');
	    	}
	    } else {
	    	header('Location:index.php?action=user_auth');
	    }
    }

    /**
     * @brief checkLoginTypeAction check_login_type entered_val
     */
    public function checkLoginTypeAction()
    {
    	if (isset($_GET['entered_val']) && !empty($_GET['entered_val']))
    	{
    		$enteredVal = htmlspecialchars($_GET['entered_val']);
    		$queryResult = $this->_dbManager->getMatchLoginType($enteredVal);
    		if ($queryResult['med']->fetchColumn() == $enteredVal || $queryResult['pat']->fetchColumn() == $enteredVal ) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }
    /**
     * @brief setUpPatientFormAction
     */
    public function setUpPatientFormAction()
    {
    	if ($this->patientLoggedIn())
	    {
	    	if (isset($_GET['up_pat']) && !empty($_GET['up_pat']))
	    	{
	    		$up_pat = (int)htmlspecialchars($_GET['up_pat']);
	    		$patient = $this->_dbManager->getPatientInfos($up_pat);
	    		require_once('views/pat_views/setUpPatientViewForm.php');
	    	}
	    } else {
	    	header('Location:index.php?action=user_auth');
	    }
    }
    /**
     * @brief setUpPatientConfirmAction
     */
    public function setUpPatientConfirmAction()
    {
    	if ($this->patientLoggedIn())
    	{
    		if (isset($_POST['idPatient']) && !empty($_POST['idPatient']))
	    	{
	    		$idPatient = (int)htmlspecialchars($_POST['idPatient']);

		    	$patientInfo = array();
				if (isset($_POST['nomPatient']) && !empty($_POST['nomPatient']))
				{
					$patientInfo[0] = htmlspecialchars($_POST['nomPatient']);
				}
				if (isset($_POST['prenomPatient']) && !empty($_POST['prenomPatient']))
				{
					$patientInfo[1] = htmlspecialchars($_POST['prenomPatient']);
				}
				if (isset($_POST['dateNaissanceP']) && !empty($_POST['dateNaissanceP']))
				{
					$patientInfo[2] = htmlspecialchars($_POST['dateNaissanceP']);
				}
				if (isset($_POST['telephonePatient']) && !empty($_POST['telephonePatient']))
				{
					$patientInfo[3] = htmlspecialchars($_POST['telephonePatient']);
				}
				if (isset($_POST['emailPatient']) && !empty($_POST['emailPatient']))
				{
					$patientInfo[4] = htmlspecialchars($_POST['emailPatient']);
				}
				if (isset($_POST['adressePatient']) && !empty($_POST['adressePatient']))
				{
					$patientInfo[5] = htmlspecialchars($_POST['adressePatient']);
				}
				if (isset($_POST['villePatient']) && !empty($_POST['villePatient']))
				{
					$patientInfo[6] = htmlspecialchars($_POST['villePatient']);
				}
				if (isset($_POST['loginPatient']) && !empty($_POST['loginPatient']))
				{
					$patientInfo[7] = htmlspecialchars($_POST['loginPatient']);
				}
				$patientInfo[8] = $idPatient;

				if ($this->_dbManager->updatePatientInfos($patientInfo) == true)
				{ header('Location:index.php?action=user_auth'); }
				else {
					header('Location:index.php?action=set_up_pat&up_pat='.$idPatient);
				}
			}
			else {
				echo "Identifiant non défini";
			}
		} else {
			header('Location:index.php?action=user_auth');
		}
    }

    /**
     * @brief setUpMedecinFormAction set_up_med up_med
     */
    public function setUpMedecinFormAction()
    {
    	if ($this->medecinLoggedIn())
	   	{
	   		if (isset($_GET['up_med']) && !empty($_GET['up_med']))
	    	{
	    		$idMedecin = (int)htmlspecialchars($_GET['up_med']);
	    		$medecin = $this->_dbManager->getMedecinUsingId($idMedecin);
	    		require_once('views/med_views/setUpMedecinFormView.php');
	    	}
	    }
    }
    /**
     * @brief public function setUpMedecinConfirmction()
     */
    public function setUpMedecinConfirmction()
    {
    	if ($this->medecinLoggedIn())
    	{
	    	if(isset($_POST['med_up_cf']) && !empty($_POST['med_up_cf']))
	    	{
	    		$up_med_id = (int)htmlspecialchars($_POST['med_up_cf']);
	    		$medecinInfos = array();

				if (isset($_POST['nom_med']) && !empty($_POST['nom_med']))
				{
					$medecinInfos[0] = htmlspecialchars($_POST['nom_med']);
				}
				if (isset($_POST['prenom_medecin']) && !empty($_POST['prenom_medecin']))
				{
					$medecinInfos[1] = htmlspecialchars($_POST['prenom_medecin']);
				}
				if(isset($_POST['date_medecin']) && !empty($_POST['date_medecin']))
				{
					$medecinInfos[2] = $_POST['date_medecin'];
				}
				if (isset($_POST['telephone']) && !empty($_POST['telephone']))
				{
					$medecinInfos[3] = htmlspecialchars($_POST['telephone']);
				}
				if (isset($_POST['email_medecin']) && !empty($_POST['email_medecin']))
				{
					$medecinInfos[4] = htmlspecialchars($_POST['email_medecin']);
				}
				if (isset($_POST['adresse_med']) && !empty($_POST['adresse_med']))
				{
					$medecinInfos[5] = htmlspecialchars($_POST['adresse_med']);
				}
				if (isset($_POST['ville_medecin']) && !empty($_POST['ville_medecin']))
				{
					$medecinInfos[6] =htmlspecialchars($_POST['ville_medecin']);
				}
				if (isset($_POST['langue']) && !empty($_POST['langue']))
				{
					$medecinInfos[7] = htmlspecialchars($_POST['langue']);
				}
				if (isset($_POST['centre_sante']) && !empty($_POST['centre_sante']))
				{
					$medecinInfos[8] = htmlspecialchars($_POST['centre_sante']);
				}
				if (isset($_POST['user_medecin']) && !empty($_POST['user_medecin']))
				{
					$medecinInfos[9] = htmlspecialchars($_POST['user_medecin']);
				}
				$medecinInfos[10] = $up_med_id;
				if ($this->_dbManager->updateMedecinInfos($medecinInfos) == true)
				{
					header('Location:index.php?action=user_auth');
				} else {
					header('Location:index.php?action=set_up_med&up_med='.$up_med_id);
				}
	    	}
	    }
    }

    /**
     * @brief deletePatientAction
     * @param identifPat int
     */
   	public function deletePatientAction($identifPat)
   	{
   		if (isset($identifPat) && !empty($identifPat))
   		{
   			/* Email Part To Patients */
	        $to = $this->_dbManager->getPatientEmail($identifPat)->fetchColumn();

	        $theme = 'Care Account deletion';
	        $subject = 'Account deleted';

   			$message = "";
   			if ($this->_dbManager->getRendezVPatient($identifPat)->fetchAll() != NULL){
   				// Enlever les rendez-vous
   				$this->_dbManager->deletePatientRdv($identifPat);
   			}
   			if ($this->_dbManager->getQuestionsPatient($identifPat)->fetchAll() != NULL){
   				// Enlever les questions
				$this->_dbManager->deletePatientQuestions($identifPat);
			}
   			if ($this->_dbManager->getConsultationsPatient($identifPat)->fetchAll() != NULL){
   				// Enlever les consultations
				$this->_dbManager->deletePatientConsultations($identifPat);
			}
			if ($this->_dbManager->deletePatient($identifPat) == true)
			{
				$this->logoutPatientAction();
				$message = "Votre compte a été  supprimé et<br>
				Nous sommes navrés de ne plus vous avoir parmi nous!";
				$this->sendEmails($to, $theme, $subject, $message, self::FROM, self::PASSWORD);

				header('Location:index.php?action=home&deleted_user=1');
			}else {
				$message = "Votre compte n'a  pas été supprimé<br>
				Suite à une erreur interne.<br>Merci de vous connecter et de contacter le service d'aide !";
				$this->sendEmails($to, $theme, $subject, $message, self::FROM, self::PASSWORD);

				header('Location:index.php?action=home&deleted_user=2');
			}
   		}

   	}

   	/**
   	 * [deleteMedecinAction description]
   	 * @param  int $idMedecin
   	 * @return bool
   	 */
   	public function deleteMedecinAction($idMedecin)
   	{
   		if (isset($idMedecin) && !empty($idMedecin))
   		{
   			$idMedecin = (int)htmlspecialchars($idMedecin);
   			//echo $idMedecin;
   			/* Email Part To Patients */
	        $to = $this->_dbManager->getMedecinEmail($idMedecin)->fetchColumn();

	        $theme = 'Care Account deletion';
	        $subject = 'Account deleted';

   			$message = "";
   			if ($this->_dbManager->getCommentairesMedecin($idMedecin)->fetchAll() != NULL){

   				$this->_dbManager->deleteMedecinComents($idMedecin);
   			}
   			if ($this->_dbManager->getReponsesMedecin($idMedecin)->fetchAll() != NULL){

				$this->_dbManager->deleteMedecinReponses($idMedecin);
			}
   			if ($this->_dbManager->getExperiencesMedecin($idMedecin)->fetchAll() != NULL){

				$this->_dbManager->deleteMedecinExperiences($idMedecin);
			}
			if ($this->_dbManager->getTrancheMedecin($idMedecin)->fetchAll() != NULL){

   				$this->_dbManager->deleteMedecinTranche($idMedecin);
   			}
   			if ($this->_dbManager->getRendezVMedecin($idMedecin)->fetchAll() != NULL)
   			{
   				$this->_dbManager->deleteRdvMedecin($idMedecin);
   			}
			if ($this->_dbManager->deleteMedecin($idMedecin) == true)
			{
				$this->logoutMedecinAction();
				$message = "Votre compte a été  supprimé et<br>
				Nous sommes navrés de ne plus vous avoir parmi nous!";
				$this->sendEmails($to, $theme, $subject, $message, self::FROM, self::PASSWORD);

				header('Location:index.php?action=home&deleted_user=1');
			}else {
				$message = "Votre compte n'a  pas été supprimé<br>
				Suite à une erreur interne.<br>Merci de vous connecter et de contacter le service d'aide !";
				$this->sendEmails($to, $theme, $subject, $message, self::FROM, self::PASSWORD);

				header('Location:index.php?action=home&deleted_user=2');
			}
		}

   	}
   	/**
   	 * @brief Admin
   	 * [adminAuthAction description]
   	 */
   	public function adminAuthAction() { require_once('admin/adminAuthForm.php');}

   	public function adminSigninAction($checkAdmin)
   	{
   		if (isset($checkAdmin) && !empty($checkAdmin))
   		{
   			$admin = array(
   				htmlspecialchars($_POST['admin_login']),
   				md5(htmlspecialchars($_POST['admin_passw']))
   			);
   			if ($this->_dbManager->adminSignin($admin)->fetchColumn() == 1)
   			{
   				$_SESSION['admin_session'] = htmlspecialchars($_POST['admin_login']);
   				header('Location:index.php?action=admin_interface&login='.$_POST['admin_login']."&logged=".md5($_SESSION['admin_session']));
   			} else {
   				header('Location:index.php?action=admin&error=2');
   			}
   		} else {
   			header('Location:index.php?action=admin&error=1');
   		}
   	}
   	/**
     * @brief checkLoginTypeAction check_login_type entered_val
     */
    public function checkAdminType()
    {
    	if (isset($_GET['entered_val']) && !empty($_GET['entered_val']))
    	{
    		$enteredVal = htmlspecialchars($_GET['entered_val']);
    		$queryResult = $this->_dbManager->getAdminType(array($enteredVal));
    		if ($queryResult->fetchColumn() == $enteredVal)
    		{
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function adminLoggedIn()
    {
    	if (!empty($_SESSION['admin_session']))
    	{return true;} else {return false;}
    }

    /**
     * [adminInterfaceViewAction description]
     */
    public function adminInterfaceViewAction()
    {
    	if ($this->adminLoggedIn())
    	{
    		require_once('admin/adminInterfaceView.php');
    	} else {
    		header('Location:index.php?action=admin&error=3');
    	}
    }
    public function adminLogOut()
    {
    	// session_destroy();
    	unset($_SESSION['admin_session']);
    	header('Location:index.php?action=admin&logged_outa=1');
    }
    public function allPatientsAction()
    {
    	if ($this->adminLoggedIn())
    	{
	    	$all_patients = $this->_dbManager->getAllPatients();
	    	if ($all_patients->fetchAll() == NULL)
	    	{
	    		echo '<h1><em>La liste des patients est pour le moment vide !</em><h1>';
	    	} else {
	    		$all_patients = $this->_dbManager->getAllPatients();
	    		require_once('admin/listPatientsView.php');
	    	}
	    } else {
	    	header('Location:index.php?action=admin&error=3');
	    }
    }
    public function allMedecinsAction()
    {
    	if ($this->adminLoggedIn())
    	{
	    	$all_medecins = $this->_dbManager->getAllMedecins();
	    	if ($all_medecins->fetchAll() == NULL)
	    	{
	    		echo '<h1><em>La liste des médecins est pour le moment vide !</em><h1>';
	    	} else {
	    		$all_medecins = $this->_dbManager->getAllMedecins();
	    		require_once('admin/listMedecinsView.php');
	    	}
	    } else {
	    	header('Location:index.php?action=admin&error=3');
	    }
    }

    /**
     * @brief Admin
     */

    /**
     * Accounts Validation by emails
     */
    public function patientActivateAccountAction()
    {
    	if (isset($_GET['pat_key']) && !empty($_GET['pat_key']))
    	{
    		$userPatKey = htmlspecialchars($_GET['pat_key']);
    		if ($this->_dbManager->patCheckKeyExist($userPatKey)->fetch(PDO::FETCH_NUM)[0] != NULL)
    		{
    			if ($this->_dbManager->patientActivateAccount(array($userPatKey)) == true)
	    		{
	    			header('Location:index.php?action=user_auth&active=1');
	    		}else {
	    			header('Location:index.php?action=user_auth&active=2');
	    		}
	    	} else {
	    		header('Location:index.php?action=user_auth&active=4');
	    	}
    	}
    }
    public function medecinActivationAccountAction()
    {
    	if (isset($_GET['med_key']) && !empty($_GET['med_key']))
    	{
    		$userMedKey = htmlspecialchars($_GET['med_key']);
    		if ($this->_dbManager->medCheckKeyExist($userMedKey)->fetch(PDO::FETCH_NUM)[0] != NULL)
    		{
    			if ($this->_dbManager->medecinActivateAccount($userMedKey) == true)
	    		{
	    			header('Location:index.php?action=user_auth&active=1');
	    		}else {
	    			header('Location:index.php?action=user_auth&active=2');
	    		}
    		}
    		else {
    			header('Location:index.php?action=user_auth&active=4');
    		}
    	}
    }
    /**
     * Accounts Validation by emails
     */

    /**
     * @brief helpMessageAction
     */
    public function helpMessageAction()
    {
    	if (isset($_POST['help_email']) && !empty($_POST['help_email']))
    	{
    		$dateMessages = getdate()['year'].'-'.getdate()['mon'].'-'.getdate()['mday'];
    		$heuresMessages = getdate()['hours'].':'.getdate()['minutes'].':'.getdate()['seconds'];
    		$message = array(
    			htmlspecialchars($_POST['help_content']),
    			$dateMessages,
    			$heuresMessages,
    			htmlspecialchars($_POST['help_email'])
    		);
    		if ($this->_dbManager->addhelpMessage($message) == true)
    		{
    			header('Location:index.php?action=home&help_mess_answer=1');
    		}
    	} else {
    		header('Location:index.php?action=home&help_mess_answer=2');
    	}
    }

    public function helpMessageListAction()
    {
    	if ($this->_dbManager->getHelpMessages()->fetchAll() == NULL)
		{
			echo "<h3><em>La liste des messages d'aide  est vide !</em></h3>";
		} else {
			$messages = $this->_dbManager->getHelpMessages();
			require_once('admin/helpMessagesView.php');
		}
    }

    public function deleteHelpMessageAction()
    {
		if ($this->adminLoggedIn())
	    {
	    	if (isset($_GET['delete_hepl_message']) && !empty($_GET['delete_hepl_message']))
	    	{
	    		if ($this->adminLoggedIn())
	    		{
	    			$help_message_to_delete = htmlspecialchars($_GET['delete_hepl_message']);
		    		if ($this->_dbManager->deleteHelpMessage($help_message_to_delete) == true)
		    		{
		    			echo '<script async defer>
		    			alert("Message supprimé avec succès !");
		    			</script>';
		    			header('Location:index.php?action=admin_interface&deleted_help=1');
		    		} else {
		    			echo '<script async defer>
		    			alert("Message non supprimé !");
		    			</script>';
		    			header('Location:index.php?action=admin_interface&deleted_help=0');
		    		}
		    	} else {

		    	}
	    	}
	    }
	}
    /**
     * @brief helpMessageAction
     */

    public function rdvConfirmationAction()
	{
		if ($this->medecinLoggedIn())
		{
			if (isset($_GET['rdv_concern']) && !empty($_GET['rdv_concern']) && isset($_GET['user_pat']))
			{
				$rdvId = (int)htmlspecialchars($_GET['rdv_concern']);
				$patId = (int)htmlspecialchars($_GET['user_pat']);

				$rdvInfos = $this->_dbManager->getRdvInformations($rdvId)->fetch(PDO::FETCH_ASSOC);
				$theme = 'Care Appointment';
	            $subject = 'Appointment Confirmation';

	            $content = "Bonjour,<br>Mercri d'avoir pris votre rendez-vous sur Care.<br>
	            Votre rendez-vous pour ".$rdvInfos['motifRdv']."<br> pris pour le ".date("d-m-Y", strtotime($rdvInfos['dateRdv']))." à ".date("H:i", strtotime($rdvInfos['heureRdv']))."
	            été confirmé par le Médecin!<br><h1>Care</h1><br><strong>Consultez la liste de vos rendez-vous sur care</strong><br>
	            <em>Votre Santé entre Vos Mains</em>";
	            $to = $this->_dbManager->getPatientEmail($patId)->fetchColumn();

	            if ($this->_dbManager->confirmerRdv($rdvId) == true)
	            {
	            	$this->sendEmails($to, $theme, $subject, $content, self::FROM, self::PASSWORD);
	            	header('Location:index.php?action=profile_med');
	            } else {
					header('Location:index.php?action=profile_med');
				}

			} else {
				header('Location:index.php?action=profile_med');
			}
		}
	}

	/**
	 * @brief Consultation Side
	 */

	/**
	 * Adds a consultation action.
	 */
	public function addConsultationAction()
	{
		if ($this->medecinLoggedIn())
		{
			if (isset($_POST['rdv_id']) && !empty($_POST['rdv_id']))
			{
				$consul = array(
					htmlspecialchars($_POST['motif_consul']),
					date('Y-m-d', strtotime($_POST['date_consul'])),
					(int)$_POST['user_med_id'],
					(int)$_POST['user_pat_id'],
					(int)$_POST['rdv_id']
				);

				$to = $this->_dbManager->getPatientEmail(htmlspecialchars($_POST['user_pat_id']));
				$theme = "Care Consultations";
				$subject = "Consultation ajoutée";
				$content = "Bonjour,<br>Les informations relatives à votre<br>Consultation du <strong><em>".date("d-m-Y", strtotime(htmlspecialchars($_POST['date_consul'])))."</em></strong>
				ont ajouté sur Care par le Médecin.<br>Veuillez les consulter dès à présent sur compte
				<br>Dans la partie <em>Mes consultations.<br><strong>Care<em>Votre Santé entre vos Mains</em></strong>";


				if ($this->_dbManager->addConsul($consul) == true && $this->_dbManager->upDateRdvConsul($_POST['rdv_id']) == true)
				{
					$this->sendEmails($to, $theme, $subject, $content, self::FROM, self::PASSWORD);
					header('Location:index.php?action=profile_med');
				} else {
					header('Location:index.php?action=profile_med');
				}
			} else {
				header('Location:index.php?action=profile_med');
			}
		}
	}

	public function consulPatInfosAction()
	{
		if ($this->patientLoggedIn())
		{
			if (isset($_GET['user_conc']) && !empty($_GET['user_conc']))
			{
				$userPatId = (int)$_GET['user_conc'];
				$consultations = $this->_dbManager->getPatientConsult($userPatId);
				require_once('views/pat_views/listConsulPatView.php');

			} else {
				require_once('views/notExistRequestedView.php');
			}
		} else {

		}
	}

	/**consultations
	 * @brief Consultation Side
	 */

	/**
	 * Security Side Start
	 */
	public function patientLoggedIn()
	{
		if (!empty($_SESSION['login']) && !empty($_SESSION['nom'])) { return true; }
		else { return false; }

	}

	public function medecinLoggedIn()
	{
		if (!empty($_SESSION['login_med']) && !empty($_SESSION['nom_med'])) { return true; }
		else { return header('Location:index.php?action=user_auth'); }
	}

	/**
	 * Security Side
	*/

	/**
	 * @brief calculate distance between two points using longitude & latitude
	 * @param double $latitudeFrom departure point
	 * @param double $longitudeFrom departure point
	 * @param double $lattitudeTo destination point
	 * @param double $longitudeTo destination point
	 * @return double $miles in miles
	 */
	public function calculatePatMedDist($latitudeFrom, $longitudeFrom, $lattitudeTo, $longitudeTo)
	{
		if (($latitudeFrom == $lattitudeTo) && ($longitudeFrom == $longitudeTo))
		{
		    return 0;
	 	}
		else
		{
			$theta = $longitudeFrom - $longitudeTo;
			$distance = (sin(deg2rad($latitudeFrom)) * sin(deg2rad($lattitudeTo))) +  (cos(deg2rad($latitudeFrom)) * cos(deg2rad($lattitudeTo)) * cos(deg2rad($theta)));
			$distance = acos($distance);
			$distance = rad2deg($distance);

			$miles = $distance * 60 * 1.1515*1.609344;    // The ditance in miles
			return $miles;
		}
	}

	/**
     * @brief Router
     */
	public function action()
    {

    	if (isset($_GET['action']) && !empty($_GET['action']))
		{
			try
			{
				if (in_array($_GET['action'], $this->_actions))
				{
					if ($_GET['action'] == 'inscription_med')
	                {
	                    $this->inscriptionMedAction();
	                }
	                elseif ($_GET['action'] == 'inscription_patient')
	                {
	                    $this->inscriptionPatientAction();
	                }
	                elseif ($_GET['action'] == 'user_auth')  // User Authentification
	                {
	                    // $this->userAuthAction();
	                    require_once ('views/userAuthView.php');
	                }
	                elseif ($_GET['action'] == 'add_medecin')
	                {
	                    $this->addMedecinAction();
	                }
	                elseif ($_GET['action'] == 'add_patient')
	                {
	                    $this->addPatientAction();
	                }
	                elseif ($_GET['action'] == 'user_sign')
	                {
	                    $this->userSignAction();
	                }
	                elseif ($_GET['action'] == 'logout_pat')
	                {
	                    $this->logoutPatientAction();
	                }
	                elseif ($_GET['action'] == 'logout_med')
	                {
	                    $this->logoutMedecinAction();
	                }
	                elseif ($_GET['action'] == 'home')
	                {
	                    $this->homeAction();
	                }
	                elseif ($_GET['action'] == 'check_login_type')
	                {
	                	$this->checkLoginTypeAction();
	                	//check_login_type entered_val
	                }
	                elseif ($_GET['action'] == 'about')
		            {
		            	require_once('views/aboutView.php');
		            }

		            elseif ($_GET['action'] == 'user_pat_active') // Patient Account Email Confirmation
	             	{
	             		$this->patientActivateAccountAction();
	             	}
	             	elseif ($_GET['action'] == 'user_med_active')	// Medecin Account Email Confirmation
	             	{
	             		$this->medecinActivationAccountAction();
	             	}
	             	elseif ($_GET['action'] == 'cf_new_prof')
	                {
	                    $this->confirmerNewprofileAction();
	                }


	                /**
	                 * Patients Side Start
	                 */

	            	elseif ($_GET['action'] == 'pr_rdv')
	                {
	                    $this->prendreRdvAction();
	                }
	                elseif ($_GET['action'] == 'profile_pat')
	                {
	                	$this->profilePatAction();
	                }
	                elseif ($_GET['action'] == 'search_spec')		// Seach_specialite
	                {
	                    $this->searchSpecialiteAction();
	                }
	                elseif ($_GET['action'] == 'prf_rdv')
	                {
	                    $this->prendreFormeRdvAction();
	                }
	                elseif ($_GET['action'] == 'cf_rdv')
	                {
	                    $this->cfRendezVousAction();
	                }
	                elseif ($_GET['action'] == 'showRdv')
	                {
	                    $this->showRdvAction();
	                }
	                elseif ($_GET['action'] == 'list_suggested')
	                {
	                    $this->listSuggestedDocAction();
	                }
	                elseif ($_GET['action'] == 'show_more')
	                {
	                    $this->showMoreMedInfosAction();
	                }
	                elseif ($_GET['action'] ==  'pr_rdv_apart')
	                {
	                    $this->prendreRdvApartAction();
	                }
	                elseif ($_GET['action'] == 'ch_prof_pat')
	                {
	                	$this->changeProfilPatAction();
	                }
	                elseif ($_GET['action'] == 'sh_med_lang')
	                {
	                	$this->shMedLangueAction();
	                }
	                elseif ($_GET['action'] == 'set_up_pat')
	                {
	                	$this->setUpPatientFormAction();
	                }
	                elseif ($_GET['action'] == 'set_up_pat_cf')
	                {
	                	$this->setUpPatientConfirmAction();
	                }
	                elseif ($_GET['action'] == "delete_user_pat")
	                {
	                	$this->deletePatientAction($_GET['pat_id']);
	                }
	             	elseif ($_GET['action'] == 'sheachrdv')
	                {
	                    $this->ShowEachRdvAction();
	                }
	                /**
	                 * Patients Side End
	                 */

	                /**
	                 * Medecins Side Start
	                 */
	                elseif ($_GET['action'] == 'profile_med')
	                {
	                    $this->profileMedAction();
	                }
	                elseif ($_GET['action'] == "set_tranch")
	                {
	                    $this->setTrancheAction();
	                }
	                elseif ($_GET['action'] == "get_tranch")
	                {
	                    $this->getTrancheAction();
	                }
	                elseif ($_GET['action'] == "up_tranche")
	                {
	                    $this->upTrancheAction();
	                }
	                elseif ($_GET['action'] == 'add_agenda')
	                {
	                    $this->addAgendaAction();
	                }
	                elseif ($_GET['action'] == 'mes_rdv_med')
	                {
	                    $this->mesRdvmedecinAction();
	                }
	                elseif ($_GET['action'] == 'more_pat_about')
	                {
	                    $this->moreAboutPatAction();
	                }
	                elseif ($_GET['action'] == 'set_up_med')
	                {
	                	$this->setUpMedecinFormAction();
	                	//set_up_med up_med
	                }
	                elseif ($_GET['action'] == 'set_up_med_cf')
	                {
	                	$this->setUpMedecinConfirmction();
	                }

	                elseif($_GET['action'] == 'delete_user_med')
	             	{
	             		$this->deleteMedecinAction($_GET['med_id']);
	             	}
	             	elseif ($_GET['action'] == 'rdv_conf')
	             	{
	             		$this->rdvConfirmationAction();
	             	}
	             	elseif ($_GET['action'] == 'add_consul')
	             	{
	             		$this->addConsultationAction();
	             	}
	             	elseif ($_GET['action'] == 'consul_info')
	             	{
	             		$this->consulPatInfosAction();
	             	}
	             	elseif ($_GET['action'] == 'add_agendaf') // 21/07/2020
	                {
	                    $this->addAgendaFormAction();
	                }
	                elseif ($_GET['action'] == 'ch_prof_form')
	                {
	                    $this->changeprofFormAction();
	                }
	                /**
	                 * Medecins Side End
	                 */

	             	/**
	             	 * @brief Admin Start
	             	 */
	             	elseif ($_GET['action'] == 'admin')
	             	{
	             		$this->adminAuthAction();
	             	}
	             	elseif ($_GET['action'] == 'admin_sign')
	             	{
	             		$this->adminSigninAction($_POST['admin_check']);
	             	}
	             	elseif ($_GET['action'] == 'check_admin_type')
	             	{
	             		$this->checkAdminType();
	             	}
	             	elseif ($_GET['action'] == 'admin_interface')
	             	{
	             		$this->adminInterfaceViewAction();
	             	}
	             	elseif ($_GET['action'] == 'admin_log_out')
	             	{
	             		$this->adminLogOut();
	             	}
	             	elseif ($_GET['action'] == 'all_patients')
	             	{
	             		$this->allPatientsAction();
	             	}
	             	elseif ($_GET['action'] == 'all_medecins')
	             	{
	             		$this->allMedecinsAction();
	             	}
	             	/**
	             	 * @brief Admin End
	             	 */

	             	/**
	             	 * @brief help Start
	             	 */
	             	elseif ($_GET['action'] == 'help_message')
	             	{
	             		$this->helpMessageAction();
	             	}
	             	elseif ($_GET['action'] == 'help_list')
	             	{
	             		$this->helpMessageListAction();
	             	}
	             	elseif ($_GET['action'] == 'delete_message')
	             	{
	             		$this->deleteHelpMessageAction();
	             	}
	             	/**
	             	 * @brief help End
	             	*/
	            }
	            else
	            {
	            	header('Location:index.php?action=home');
	            }
			}
			catch (Exception $e)
			{
				die(' Erreur => '.$e->getMessage());
			}
		}
		else
		{
            $this->homeAction();
        }
    }
	/* ====== End router ====== */
}
