<?php

namespace IlihoAlain\App_recomd\Models\DatabaseManager;
use \PDO;

/**
 * La classe(UserManager) de gestion de medecins de l'application care
 * Le traitement des données relatives aux medecins est dedie à cette classe 
 */
class UsersManager
{
	/**
	* @var $_db PDO connexion à la base de donnes
	*/
	private $_db;
	/**
	* @var USER const string le nom d'utilisateur
	*/
	const USER = 'root';
	/**
	* @var PASS const string le nom d'utilisateur
	*/
	const PASS = '';
	/**
	 * @var   array ERROR
	 */
	const ERROR = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	public function __construct()
	{
		try
		{
			$this->_db = new PDO('mysql:host=localhost;dbname=app_recomd;charset=utf8',
				self::USER, self::PASS, self::ERROR);
		}
		catch (Exception $e)
		{
			die(" Erreur Manager => ".$e->getMessage());
		}
	}
	/**
	* @brief Chercher à travers la specialite
	* @param $saisie string la specialite saisie
	* @return $request PDO resultat de la requete
	*/
	public function getMedecins($saisie)
	{
		$request = $this->_db->query(" SELECT * FROM medecins WHERE specialite LIKE '%$saisie%' ");
		return $request;

	}
	/**
	* @brief Ajout d'un medecin
	* @param $medecin array infos du medecin à ajouter
	* @return $query PDO le resultat de la requêt
	*/
	public function addMedecin(array $medecin)
	{
		$query = $this->_db->prepare(" INSERT INTO medecins (nomMedecin, prenomMedecin, dateNaissanceM, telephoneMedecin, emailMedecin, adresseMedecin, villeMedecin, langue, specialite, centreSante, loginMedecin, passwordMedecin, medecinCle, latitudeMedecin, longitudeMedecin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		return $query->execute($medecin);

	}
	/**
	*  @brief Ajout des experiences du medecin
	*  @param  $medExperience array experience du medecin
	*  @return $request PDO resultat de la requete
	*/
	public function addExeperience(array $medExperience)
	{
		$insertQuery = $this->_db->prepare("INSERT INTO experiences (idExp, contenuExp, experiences.idMedecin) VALUES (NULL, ? , ?);");
		for ($i=0; $i < count($medExperience) ; $i++)
		{ 
			$insertQuery->execute($medExperience[$i]);
		}
		return $insertQuery;
	}
	/**
	* @brief Authentification du medecin
	* @param  $medLogin array login du medecin
	* @return $request PDO resultat de la requete
	*/
	public function userSignMedecin(array $medLogin)
	{
		$query = $this->_db->prepare(" SELECT COUNT(*) FROM medecins WHERE (loginMedecin = ? AND passwordMedecin = ?) ");
		$query->execute($medLogin);
		return $query;
	}

	/**
	* @brief Get doctor all infos using login
	* @param  $medLogin array login du medecin
	* @return $request PDO resultat de la requete
	*/
	public function getMedecin($login)
	{
		$query = $this->_db->prepare(" SELECT * FROM medecins WHERE loginMedecin = ? ");
		$query->execute($login);
		return $query;
	}
	/**
	* @brief Add of a patient in database
	* @param  $patient array data of new patient
	* @return $request PDO resultat de la requete
	*/
	public function addPatient(array $patient)
	{
		$query = $this->_db->prepare(" INSERT INTO patients (idPatient, nomPatient, prenomPatient, dateNaissanceP, telephonePatient, emailPatient, adressePatient, villePatient, loginPatient, passwordPatient, patientCle) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		return $query->execute($patient);
	}
	/**
	* @brief Authentification of a patient
	* @param  $patLogin array login
	* @return $request PDO resultat de la requete
	*/
	public function userSignPatient(array $patLogin)
	{
		$query = $this->_db->prepare(" SELECT COUNT(*) FROM patients WHERE (loginPatient = ? AND passwordPatient = ?) ");

		$query->execute($patLogin);
		return $query;
	}
	/**
	* @brief Get all infos  of a patient
	* @param  $login array login
	* @return $request PDO resultat de la requete
	*/
	public function getPatient(array $login)
	{
		$query = $this->_db->prepare(" SELECT * FROM patients WHERE loginPatient = ? ");
		$query->execute($login);
		return $query;
	}
	/**
	* @brief Get the agenda of a doctor
	* @param  $idMedecin array 
	* @return $request PDO resultat de la requete
	*/
	public function getTranche(array $idMedecin)
	{
		$request = $this->_db->prepare(" SELECT idTranche as idPat, jourTranche AS jour , DATE_FORMAT(heuredebut, '%H:%i') AS heure_d, DATE_FORMAT(heureFin, '%H:%i') AS heure_f, dateTranche as dateT FROM tranches WHERE tranches.idMedecin = ? ");
		$request->execute($idMedecin);
		return $request;
	}
	
	/**
	* @brief Get doctor using its speciality
	* @param $enteredVal string
	* @return $request PDO result;
	*/
	public function getMedFullName($enteredVal)
	{
		$request = $this->_db->query(" SELECT idMedecin, nomMedecin, prenomMedecin,specialite, adresseMedecin, villeMedecin FROM medecins WHERE specialite LIKE '%$enteredVal%' ");
		return $request;
	}

	/**
	* @brief Get doctor infos for taking an appointment
	* @param $id_medecin array doctor identifier in db
	* @return $request PDO result
	*/
	public function medRdvInfo(array $id_medecin)
	{
		$request = $this->_db->prepare(" SELECT nomMedecin, prenomMedecin,specialite,telephoneMedecin, emailMedecin,centreSante, adresseMedecin FROM medecins WHERE idMedecin = ?");
		$request->execute($id_medecin);
		return $request;
	}
	/**
	* @brief Get patient identifier in db
	* @param $data array contains login
	* @return $request PDO result
	/*/
	public function getPatId(array $data)
	{
		$request = $this->_db->prepare(" SELECT idPatient FROM patients WHERE loginPatient = ? ");
		$request->execute($data);
		return $request;
	}
	/**
	* @brief Update doctor agenda
	* @param $arData new doctor agenda
	* @return $reqUpdate PDO result
	*/
	public function updateTranche(array $arData)
	{
		$reqUpdate = $this->_db->prepare("UPDATE `tranches` SET `dateTranche` = ?, `heureDebut` = ?, `heureFin` = ? WHERE `tranches`.`idTranche` = ? ");
		for ($i=0; $i < count($arData) ; $i++) { 
			$reqUpdate->execute($arData[$i]);
		}
		return $reqUpdate;
	}
	/**
	* @brief et hours appointment for data parsed as param
	* @param $date date
	* @return $request PDO result
	*/
	public function getRdvHeures($date)
	{
		$request = $this->_db->prepare("SELECT heureRdv FROM rendezvous WHERE dateRdv = ?");
		$request->execute(array($date));
		return $request;
	}
	/**
	* @brief Get all appointment dates
	* @return $request PDO result
	*/
	public function getRdvDates()
	{
		$request = $this->_db->query("SELECT DISTINCT dateRdv FROM rendezvous; ");
		return $request;
	}
	/**
	* @brief Add a new appointment in database
	* @param $rdvArr array 
	* @return $adRequest PDO result
	*/
	public function addRendezVous(array $rdvArr)
	{
		$adRequest = $this->_db->prepare("INSERT INTO rendezvous (idRdv, motifRdv, dateRdv,  	idMedecin, idPatient, heureRdv, dateRdvPrise) VALUES (null, ? , ?, ?, ?, ?, ?) ");
		$adRequest->execute($rdvArr);
		return $adRequest;
	}
	/**
	* @brief Get patients appointments
	* @param $idPat int 
	* @return  getRequest PDO result
	*/
	public function getRendezVPatient($idPat)
	{
		$getRequest = $this->_db->prepare("SELECT rdvConsul, rdvConfirmation, motifRdv AS motif, dateRdv AS rdvDate, rendezvous.idMedecin AS userMed, rendezvous.idPatient AS userPat, heureRdv AS rdvh, dateRdvPrise as datPrise FROM rendezvous WHERE rendezvous.idPatient = ? ORDER BY dateRdvPrise DESC");
		$getRequest->execute(array($idPat));
		return $getRequest;
	}
	/**
	* @brief Get rdv informations
	* @param $rdvDate array
	* @return getRequest PDO result
	*/
	public function getRendezVInfos(array $rdvhDate)
	{
		$getRequest = $this->_db->prepare("SELECT * FROM `rendezvous` WHERE dateRdv = ? AND heureRdv = ? ");
		$getRequest->execute($rdvhDate);
		return $getRequest;
	}
	/**
	* @brief Get doctor infos  using idmed
	* @param $medId int
	* @return getMedRequest PDO result
	*/
	public function getMedecinUsingId($medId)
	{
		$getMedRequest = $this->_db->prepare("SELECT nomMedecin AS n_med, prenomMedecin AS pre_med, emailMedecin AS email_med, telephoneMedecin AS tel_med, centreSante AS ste_med, adresseMedecin AS ad_med, specialite AS spe_med, url, langue as lang_med, dateNaissanceM as date_med, villeMedecin as ville_med, loginMedecin as log_med FROM medecins WHERE idMedecin = ? ");
		$getMedRequest->execute(array($medId));
		return $getMedRequest;
	}
	/**
	* @bief Get doctor id after added to database
	* @return $getIdReq PDO result
	*/
	public function getMedecinId()
	{
		$getIdReq = $this->_db->query("SELECT MAX(idMedecin) FROM medecins");
		return $getIdReq;
	}
	/**
	* @brief Add agenda of a doctor to db
	* @param $tranchesMed
	* @return $insertQuery PDO result
	*/
	public function addTrancheMed(array $tranchesMed)
	{
		$insertQuery = $this->_db->prepare(" INSERT INTO `tranches` (`idTranche`, `jourTranche`, `dateTranche`, `heureDebut`, `heureFin`, tranches.idMedecin) VALUES (NULL, ?, ?, ?, ?, ?) ");
		for ($i=0; $i < count($tranchesMed) ; $i++)
		{ 
			$insertQuery->execute($tranchesMed[$i]);
		}
		return $insertQuery;
	}

	/**
	* @brief Insertion of url
	* @param $urlIdMed array contains the name of new profile picture and doc id
	* @return $addQuery PDO result
	*/
	public function addUrlMedecin(array $urlIdMed)
	{
		$addQuery = $this->_db->prepare(" UPDATE `medecins` SET `url` = ? WHERE medecins.idMedecin = ? ");
		$addQuery->execute($urlIdMed);
		return $addQuery;
	}
    
    /**
     * @brief get recommanded doctors
     * @param $ville string city of recommanded doctor
     * @return $addQuery PDO result.
     */
    public function getSuggestedDocs($ville)
    {
        
        $request = $this->_db->query(" SELECT idMedecin as idMed, nomMedecin AS n_med, prenomMedecin AS pre_med, emailMedecin AS email_med, telephoneMedecin AS tel_med, centreSante AS ste_med, adresseMedecin AS ad_med, specialite AS spe_med, villeMedecin as city, url FROM medecins WHERE villeMedecin LIKE '%$ville%' ");
		return $request;
    }
    
    /**
     * @brief get email of a patient
     * @param $idPate int id of a patient
     * @return $query PDO result.
     */
    public function getPatientEmail($idPat)
    {
    	$query = $this->_db->prepare(" SELECT emailPatient  FROM patients  WHERE idPatient = ? ");
		$query->execute(array($idPat));
		return $query;
    }

    /**
     * @brief Get doctors appointments
     * @param $identif doctor id
     * @return getRequest PDO result
     */
	public function getRendezVMedecin($identif)
	{
		$getRequest = $this->_db->prepare("SELECT rdvConsul, idRdv, rdvConfirmation AS rdv_cf, motifRdv AS motif, dateRdv AS rdvDate, rendezvous.idPatient AS userPat, heureRdv AS rdvh FROM rendezvous WHERE rendezvous.idMedecin = ? ORDER BY  dateRdv DESC");
		$getRequest->execute(array($identif));
		return $getRequest;
	}

	 /**
     * @brief get patient infos
     * @param $identif doctor id
     * @return getRequest PDO result
     */
	public function getPatientInfos($identif)
	{
		$getRequest = $this->_db->prepare("SELECT nomPatient as nom_pat, prenomPatient AS pre_pat, villePatient AS ville_pat, adressePatient AS ad_pat, emailPatient AS email_pat, telephonePatient as tel_pat, url,dateNaissanceP as date_pat,loginPatient as login_pat FROM patients WHERE patients.idPatient = ? ");
		$getRequest->execute(array($identif));
		return $getRequest;
	}

	/**
     * @brief get email of a doctor
     * @param $idPate int id of a patient
     * @return $query PDO result.
     */
    public function getMedecinEmail($idPat)
    {
    	$query = $this->_db->prepare(" SELECT emailMedecin  FROM medecins  WHERE idMedecin = ? ");
		$query->execute(array($idPat));
		return $query;
    }

    /**
	* @brief Insertion of url
	* @param $urlIdMed array contains the name of new profile picture and doc id
	* @return $addQuery PDO result
	*/
	public function addUrlPatient(array $urlIdMed)
	{
		$addQuery = $this->_db->prepare(" UPDATE `patients` SET `url` = ? WHERE patients.idPatient = ? ");
		$addQuery->execute($urlIdMed);
		return $addQuery;
	}

	/**
	* @brief Get doctor using its speciality
	* @param $selectedLang string
	* @return $request PDO result
	*/
	public function getMedFullNameLang($selectedLang)
	{
		$request = $this->_db->query(" SELECT idMedecin, nomMedecin, prenomMedecin,specialite, adresseMedecin, villeMedecin FROM medecins WHERE langue LIKE '%$selectedLang%' ");
		return $request;
	}

	/**
	 * Getting matching logins
	 * @param $enteredVal string  
	 * @return $query PDO result
	 */
	public function getMatchLoginType($enteredVal)
	{
		$queryMed = $this->_db->prepare("SELECT loginMedecin FROM medecins WHERE loginMedecin = ? ");
		$queryMed->execute(array($enteredVal));

		$queryPat = $this->_db->prepare("SELECT loginPatient FROM patients WHERE loginPatient = ? ");
		$queryPat->execute(array($enteredVal));

		$arrayResult = array('med'=>$queryMed,'pat'=>$queryPat);
		return $arrayResult;
	}

	/**
	 * @brief update Patient info
	 * @param $patientInfo array new info
	 * @return PDO updateRequest result
	 */
	public function updatePatientInfos(array $patientInfo)
	{
		$updateRequest = $this->_db->prepare("UPDATE patients SET nomPatient = ?, prenomPatient = ?, dateNaissanceP = ?, telephonePatient = ?, emailPatient = ?, adressePatient = ?,   villePatient = ?, loginPatient = ? WHERE patients.idPatient = ? ");

		$updateRequest->execute($patientInfo);
		return $updateRequest;
	}

	/**
	 * @brief updateMedecinInfos
	 * @param  array  $medecinInfo new med info
	 * @return PDO updateRequest result
	 */
	public function updateMedecinInfos(array $medecinInfo)
	{
		$updateRequest = $this->_db->prepare("UPDATE medecins SET nomMedecin = ?, prenomMedecin = ?, dateNaissanceM = ?, telephoneMedecin = ?, emailMedecin = ?, adresseMedecin = ?,   villeMedecin = ?, langue = ?, centreSante = ?, loginMedecin = ? WHERE medecins.idMedecin = ? ");

		$updateRequest->execute($medecinInfo);
		return $updateRequest;
	}
	/**
	 * @brief getQuestionsPatient description
	 * @param  int $idPatient [description]
	 * @return bool
	 */
	public function getQuestionsPatient($idPatient)
	{
		$getRequest = $this->_db->prepare("SELECT * FROM questions WHERE questions.idPatient = ? ");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	/**
	 * @brief getConsultationsPatient description
	 * @param  int $idPatient [description]
	 * @return bool
	 */
	public function getConsultationsPatient($idPatient)
	{
		$getRequest = $this->_db->prepare("SELECT * FROM consultations WHERE consultations.idPatient = ?");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	/**************************************************************************/
	/**
	 * @brief deletePatientRdv description
	 * @param  int $idPatient [description]
	 * @return bool
	 */
	public function deletePatientRdv($idPatient)
	{
		$getRequest = $this->_db->prepare("DELETE FROM rendezvous WHERE rendezvous.idPatient = ?");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	/**
	 * @brief deletePatientQuestions description
	 * @param  int $idPatient [description]
	 * @return bool
	 */
	public function deletePatientQuestions($idPatient)
	{
		$getRequest = $this->_db->prepare("DELETE FROM questions WHERE questions.idPatient = ?");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	/**
	 * @brief deletePatientConsultations description
	 * @param  int $idPatient [description]
	 * @return bool
	 */
	public function deletePatientConsultations($idPatient)
	{
		$getRequest = $this->_db->prepare("DELETE FROM consultations WHERE consultations.idPatient = ?");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	/**
	 * deletePatient suppression du compte d'un patient
	 * @param  int $idPatient its unique id
	 * @return bool
	 */
	public function deletePatient($idPatient) 
	{
		$getRequest = $this->_db->prepare("DELETE FROM patients WHERE patients.idPatient = ?");
		$getRequest->execute(array($idPatient));
		return $getRequest;
	}

	//******************************************************
	/**
	 * [getCommentairesMedecin description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function getCommentairesMedecin($idMedecin)
	{
		$getRequest = $this->_db->prepare("SELECT * FROM commentaires WHERE commentaires.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}
   	/**
   	 * [getReponsesMedecin description]
   	 * @param  [type] $idMedecin [description]
   	 * @return [type]            [description]
   	 */
   	public function getReponsesMedecin($idMedecin)
   	{
   		$getRequest = $this->_db->prepare("SELECT * FROM reponses WHERE reponses.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
   	}

   	/**
   	 * [getExperiencesMedecin description]
   	 * @param  [type] $idMedecin [description]
   	 * @return [type]            [description]
   	 */
   	public function getExperiencesMedecin($idMedecin)
   	{
   		$getRequest = $this->_db->prepare("SELECT * FROM experiences WHERE experiences.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
   	}

   	/**
   	 * [getTrancheMedecin description]
   	 * @param  [type] $idMedecin [description]
   	 * @return [type]            [description]
   	 */
	public function getTrancheMedecin($idMedecin)
	{
		$getRequest = $this->_db->prepare("SELECT * FROM tranches WHERE tranches.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}
	/**
	 * [deleteMedecinComents description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteMedecinComents($idMedecin)
	{
		$getRequest = $this->_db->prepare("DELETE FROM commentaires WHERE commentaires.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}

	/**
	 * [deleteMedecinReponses description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteMedecinReponses($idMedecin)
	{
		$getRequest = $this->_db->prepare("DELETE FROM reponses WHERE reponses.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}

	/**
	 * [deleteMedecinExperiences description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteMedecinExperiences($idMedecin)
	{
		$getRequest = $this->_db->prepare("DELETE FROM experiences WHERE experiences.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}

	/**
	 * [deleteMedecinTranche description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteMedecinTranche($idMedecin)
	{
		$getRequest = $this->_db->prepare("DELETE FROM tranches WHERE tranches.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}

	/**
	 * [deleteRdvMedecin description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteRdvMedecin($idMedecin)
	{
		$getRequest = $this->_db->prepare("DELETE FROM rendezvous WHERE rendezvous.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}

	/**
	 * [deleteMedecin description]
	 * @param  [type] $idMedecin [description]
	 * @return [type]            [description]
	 */
	public function deleteMedecin($idMedecin) 
	{
		$getRequest = $this->_db->prepare("DELETE FROM medecins WHERE medecins.idMedecin = ?");
		$getRequest->execute(array($idMedecin));
		return $getRequest;
	}
	
	/**
	 * @brief Admin 
	 * [adminSignin description]
	 * @param  array  $adminLogin
	 * @return bool
	 */
	public function adminSignin(array $adminLogin)
	{
		$query = $this->_db->prepare("SELECT COUNT(*) FROM admins WHERE ( _admin_login = ? AND _admin_password = ? )");
		$query->execute($adminLogin);
		return $query;
	}

	/**
	 * [getAdminType description]
	 * @param  array  $adminLogin [description]
	 * @return bool             [description]
	 */
	public function getAdminType(array $adminLogin)
	{
		$adminQuery = $this->_db->prepare("SELECT _admin_login FROM admins WHERE _admin_login = ? ");
		$adminQuery->execute($adminLogin);
		return $adminQuery;
	}

	public function getAllPatients()
	{
		$adminQuery = $this->_db->query("SELECT * FROM patients");
		return $adminQuery;
	}
	public function getAllMedecins()
	{
		$adminQuery = $this->_db->query("SELECT * FROM medecins");
		return $adminQuery;
	}
	/**
	 * @brief Admin 
	 */
	
	/**
	 * [patientActivateAccount description]
	 * @param  array  $userPatKey [description]
	 * @return [type]             [description]
	 */
	public function patientActivateAccount(array $userPatKey)
	{
		$activateQuery = $this->_db->prepare("UPDATE patients SET patientValide = 1 WHERE patientCle = ? ");
		$activateQuery->execute($userPatKey);
		return $activateQuery;
	}

	/**
	 * [patientCheckActivation description]
	 * @param  [type] $userPaLogin [description]
	 * @return [type]              [description]
	 */
	public function patientCheckActivation($userPaLogin)
	{
		$query = $this->_db->prepare("SELECT patientValide FROM patients WHERE loginPatient = ?");
		$query->execute(array($userPaLogin));
		return $query;
	}

	/**
	 * [medecinActivateAccount description]
	 * @param  [type] $userMedKey [description]
	 * @return [type]             [description]
	 */
	public function medecinActivateAccount($userMedKey)
	{
		$activateQuery = $this->_db->prepare("UPDATE medecins SET medecinValide = 1 WHERE medecinCle = ? ");
		$activateQuery->execute(array($userMedKey));
		return $activateQuery;
	}

	/**
	 * [medecinCheckActivation description]
	 * @param  [type] $userMedLogin [description]
	 * @return [type]               [description]
	 */
	public function medecinCheckActivation($userMedLogin)
	{
		$query = $this->_db->prepare("SELECT medecinValide FROM medecins WHERE loginMedecin = ?");
		$query->execute(array($userMedLogin));
		return $query;
	}

	// SELECT latitudeMedecin, longitudeMedecin FROM medecins WHERE (latitudeMedecin !=0 AND longitudeMedecin !=0);
	/**
	 * [getMedecinLatLong description]
	 * @return bool
	 */
	public function getMedecinLatLong($valid = 1)
	{
		$query = $this->_db->prepare("SELECT loginMedecin, latitudeMedecin, longitudeMedecin FROM medecins WHERE ((latitudeMedecin !=0 AND longitudeMedecin !=0 ) AND medecinValide = ? )");
		$query->execute(array($valid));
		return $query;
	}

	/**
	 * [addhelpMessage description]
	 * @param  array  $helpMessage [description]
	 * @return [type]              [description]
	 */
	public function addhelpMessage(array $helpMessage)
	{
		$query = $this->_db->prepare("INSERT INTO `messages` (`idMessages`, `contenuMessages`, `dateMessages`, `heuresMessages`, `emailMessage`) VALUES (NULL, ?, ?, ?, ?);");
		$query->execute($helpMessage);
		return $query;
	}

	/**
	 * [getHelpMessages description]
	 * @return [type] [description]
	 */
	public function getHelpMessages()
	{
		$query = $this->_db->query("SELECT idMessages AS idHelp, contenuMessages AS content, dateMessages AS dateHelp, heuresMessages AS heure, emailMessage AS email FROM messages");
		return $query;
	}

	/**
	 * [deleteHelpMessage description]
	 * @param  [type] $idHelpMessage [description]
	 * @return [type]                [description]
	 */
	public function deleteHelpMessage($idHelpMessage)
	{
		$query  = $this->_db->prepare("DELETE FROM messages WHERE idMessages = ?");
		$query->execute(array($idHelpMessage));
		return $query;
	}

	/**
	 * [getRdvInformations description]
	 * @param  [type] $rdvIdToGet [description]
	 * @return [type]             [description]
	 */
	public function getRdvInformations($rdvIdToGet)
	{
		$query = $this->_db->prepare("SELECT * FROM rendezvous WHERE idRdv = ? ");
		$query->execute(array($rdvIdToGet));
		return $query;

	}

	/**
	 * Confirmation of a taken appointment
	 *
	 * @param      <int>  $rdvIdToUpdate  The rdv identifier to update
	 *
	 * @return     <bool>  
	 */
	public function confirmerRdv(int $rdvIdToUpdate)
	{
		$query = $this->_db->prepare("UPDATE rendezvous SET rdvConfirmation = 1 WHERE idRdv = ?");
		$query->execute(array($rdvIdToUpdate));
		return $query;
	}

	/**
	 * Consultation Side
	 */

	/**
	 * Adds a consul
	 *
	 * @param      arry    $consulInfos  The consul infos
	 *
	 * @return     bool  
	 */
	public function addConsul(array $consulInfos)
	{
		$query = $this->_db->prepare("INSERT INTO `consultations` (`idConsul`, `motifConsul`, `dateConsul`, `idMedecin`, `idPatient`, `idRdv`) VALUES (NULL, ?, ?, ?, ?, ?)");
		$query->execute($consulInfos);
		return $query;
	}

	/**
	 * Mark an appointment got a rdvConsul
	 *
	 * @param      int     $rdvIdToUpdate  The rdv identifier to update
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public function upDateRdvConsul(int $rdvIdToUpdate)
	{
		$query = $this->_db->prepare("UPDATE rendezvous SET rdvConsul = 1 WHERE idRdv = ?");
		$query->execute(array($rdvIdToUpdate));
		return $query;
	}

	/**
	 * Gets the patient consult.
	 *
	 * @param      <type>  $userPat  The user pattern
	 *
	 * @return     <type>  The patient consult.
	 */
	public function getPatientConsult($userPat)
	{
		$query = $this->_db->prepare("SELECT * FROM consultations WHERE consultations.idPatient = ?");
		$query->execute(array($userPat));
		return $query;
	}

	/**
	 * Consultation Side
	 */

	/**
	 * CheckKeyValueExist
	 */

	/**
	 * { medCheckKeyExist }
	 *
	 * @param      string $userMedKey  The user median key
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public function medCheckKeyExist($userMedKey)
	{
		$query = $this->_db->prepare("SELECT medecinCle FROM medecins WHERE medecinCle = ? ");
		$query->execute(array($userMedKey));
		return $query;
	}
	/**
	 * { patCheckKeyExist }
	 *
	 * @param      string  $userPatKey  The user pattern key
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public function patCheckKeyExist($userPatKey)
	{
		$query = $this->_db->prepare("SELECT patientCle FROM patients WHERE patientCle = ? ");
		$query->execute(array($userPatKey));
		return $query;
	}
	/**
	 * CheckKeyValueExist
	 */
	/**
	 * @details getMedecinValid
	 * @param int $valid
	 * @return bool 
	 */
	public function getMedecinValid($valid = 1)
	{
		$query = $this->_db->prepare("SELECT idMedecin as idMed, nomMedecin AS n_med, prenomMedecin AS pre_med, emailMedecin AS email_med, telephoneMedecin AS tel_med, centreSante AS ste_med, adresseMedecin AS ad_med, specialite AS spe_med, villeMedecin as city, url, loginMedecin FROM medecins WHERE medecinValide = ? ");
		$query->execute(array($valid));
		return $query;
	}
}
