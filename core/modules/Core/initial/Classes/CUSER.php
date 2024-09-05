<?php

namespace Core\initial\Classes;

use Core\initial\CAPP;
use Core\initial\exceptions\ExceptionLevel;
use Core\initial\exceptions\ManagerLoadedException;

final class CUSER implements \Serializable {

    private string $username;
    private \DateTime $authTime;
    private \DateTime $lastActive;
    private bool $authorized;

    private function __construct() {
        $this->lastActive = new \DateTime();
        $this->authorized = FALSE;
    }

    /**
     * Initiate the class
     * @throws ManagerLoadedException thrown when the manager is already loaded into the CAPP class
     */
    public static function load(): self {
        if (isset(CAPP::$USER)) throw new ManagerLoadedException('Core', 'CUSER', ExceptionLevel::ERROR, "CUSER is already loaded", 1);
        if (isset($_SESSION['CMS_CORE_USER'])) {
            var_dump($_SESSION);
            return (new CUSER)->unserialize($_SESSION['CMS_CORE_USER']);
        }
        return new self();
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool {
        //    global $pages, $language, $database;
//    try {
//        $stmt = $database->select('user', ['*'])->where(['name'], [trim($_POST["username"])])->excecuteStatement();
//
//        if(count($stmt) == 1) {
//            if (password_verify(md5($password), $stmt[0]["password"])) {
//                // Store data in session variables
//                $_SESSION['login']["loggedin"] = 1;
//                $_SESSION['login']["id"] = $stmt[0]["ID"];
//                $_SESSION['login']["username"] = $stmt[0]["name"];
//                $_SESSION['login']["adminLevel"] = $stmt[0]['adminLevel'];
//                $pages->page = $_POST['target'];//and then redirect to the targeted page
//                $language->succes['login'] = 'loggedIn';
//                return TRUE;//Houston we have found the spoon!
//            } else {
//                // give of an error if the password is wrong
//                $language->errors['login'] = 'passwordWrong';
//                return FALSE;
//            }
//        } else {
//            // give of an error if no acount is found
//            $language->errors['login'] = 'usernameUnknown';
//            return FALSE;
//        }
//    } catch (Exception $exception) {
//        //give of an error because of an exception
//        $language->errors['database'] = ['login', $exception->getMessage()];
//        return FALSE;
//    }
//    return TRUE;
        return FALSE; //TODO: implement the login function
    }

    /**
     * @param array $urlArray
     * @return bool
     */
    public function hasAccess(array $urlArray): bool {
        return true; //TODO: implement the access detector
//      //prevent the user from accesing folders he has no acces to
//            if (strpos($_GET["url"], '/') !== 0 && in_array(substr($_GET["url"], 0, strpos($_GET["url"], '/')), LOCKEDAREAS)) {
//                if (!in_array($_SESSION['login']['adminLevel'], ACCESLEVEL[substr($_GET["url"], 0, strpos($_GET["url"], '/'))])) {
//                    if (!is_array(LOCKEDAREAALLOWEDPAGES[substr($_GET["url"], 0, strpos($_GET["url"], '/'))]) && !in_array($_GET['url'], LOCKEDAREAALLOWEDPAGES[substr($_GET["url"], 0, strpos($_GET["url"], '/'))])) {
//                        $this->page = LOCKEDAREAREDIRECTPAGE[substr($_GET["url"], 0, strpos($_GET["url"], '/'))];
//                    }
//                }
//            }
//
    }

    /**
     * @throws \Exception
     */
    public function __destruct() {
        $_SESSION['CMS_CORE_USER'] = $this->serialize();
    }


    public function unserialize(string $data): self { $this->__unserialize(json_decode($data, true)); return $this;}

    public function __unserialize(array $data): void {
        $this->authorized = $data['authorized'];
        $date = new \DateTime();
        if (isset($data['authTime'])) $this->authTime = $date->setTimestamp($data['authTime']);
        $this->lastActive = $date->setTimestamp($data['lastActive']);
        if (isset($data['username'])) $this->username = $data['username'];
    }

    public function serialize(): string { return json_encode($this->__serialize()); }

    public function __serialize(): array {
        $serialArray = [
            "lastActive" => $this->lastActive->getTimestamp(),
            "authorized" => $this->authorized
        ];
        if (isset($this->username)) $serialArray['username'] = $this->username;
        if (isset($this->authTime)) $serialArray["authTime"] = $this->authTime->getTimestamp();
        return $serialArray;
    }
}


//
//function getUser($ID) {// get the user whit the correct ID
//    global $language, $database;
//    try {
//        return $database->select('user', ['*'])->where(['ID'], [$ID])->excecuteStatement();
//    } catch (Throwable $th) {
//        $language->errors['database'] = ['getUser', $th->getMessage()];
//        return FALSE;
//    }
//}
//
//function getUsers() {// get all the users from the user table
//    global $language, $database;
//    try {
//        return $database->select('user', ['*'])->excecuteStatement();
//    } catch (Exception $exception) {
//        //give of an error because of an exception
//        $language->errors['database'] = ['getUsers', $exception->getMessage()];
//        return FALSE;
//    }
//}
//
//function checkUser($name) {// check whether or not the user exist
//    global $language, $database;
//    try {
//        $boolean = (count($database->select('user', ['*'])->where(['name'], [$name])->excecuteStatement()) === 1);
//        return $boolean;
//    } catch (Exception $exception) {
//        //give of an error because of an exception
//        $language->errors['database'] = ['checkUser', $exception->getMessage()];
//        return FALSE;
//    }
//}
//
//function getAdminLevel($ID) {//get the adminLevel as set in the database
//    global $language, $database;
//    try {
//        $adminLevel = $database->select('user', ['adminLevel'])->where(['ID'], [$ID])->excecuteStatement();
//        return $adminLevel[0]['adminLevel'];
//    } catch (Exception $exception) {
//        //give of an error because of an exception
//        $language->errors['database'] = ['getAdminLevel', $exception->getMessage()];
//        return FALSE;
//    }
//}
//
//function userRegister($username, $password, $adminLevel) {//register the user in the database
//    global $language, $database;
//    try {
//        $hased_password = password_hash(md5($password), PASSWORD_DEFAULT);
//        $database->insert('user', ['name', 'password', 'adminLevel'], [$username, $hased_password, $adminLevel])->excecuteStatement();
//        $language->succes['register'] = "registerd";
//        return TRUE;
//    } catch (Exception $exception) {
//        //give of an error because of an exception
//        $language->errors['database'] = ['register', $exception->getMessage()];
//        return FALSE;
//    }
//}
//function userDelete($ID) {
//    global $language, $database;
//    try {
//        $database->delete('user')->where(['ID'], [$ID])->excecuteStatement();
//        return TRUE;
//    } catch (Throwable $th) {
//        $language->errors['database'] = ['userDelete', $th->getMessage()];
//        return FALSE;
//    }
//}
//
//
//function userLogout($redirect) {
//    global $pages, $language;
//    // Unset all of the login session variables
//    unset($_SESSION['login']);
//    //set the loggedin and adminLevel to zero so nothing crashes because of a unset variable
//    $_SESSION['login']['loggedin'] = 0;
//    $_SESSION['login']['adminLevel'] = 0;
//    // Redirect to home page
//    $pages->page = $redirect;
//    $language->succes['logout'] = 'loggedOut';
//    return TRUE;
//}
//