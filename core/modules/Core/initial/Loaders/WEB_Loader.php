<?php

namespace Core\initial\Loaders;

use Core\initial\CAPP;
use Core\initial\Classes\CFiles;
use Core\initial\Classes\CSecurity;
use Core\initial\exceptions\ExceptionLevel;
use Core\initial\exceptions\ManagerLoadedException;
use Core\initial\exceptions\UnexpectedUriTokenException;

final class WEB_Loader {
    private string $machineType;
    private string $viewType;
    private string $placement = "page";

    private string $page;
    private string $header = "";
    private string $footer = "";

    /**
     * Startup the Page class
     * @param string $homepage The homepage of the website
     */
    private function __construct(string $homepage) {
        if (!isset($_GET['url'])) $_GET['url'] = $homepage;
        if ($_GET['url'] === 'index.php') $_GET['url'] = $homepage;
        $this->accessArray = json_decode(file_get_contents(CFiles::DATA_SECURE.'secure_access_data.json'), TRUE);
        $this->updatePage($_GET['url']);
    }
    /**
     * Initiate the class
     * @throws ManagerLoadedException thrown when the manager is already loaded into the CAPP class
     */
    public static function init(string $homepage): self {
        if (isset(CAPP::$LOADER)) throw new ManagerLoadedException('Core', 'WEBLoader', ExceptionLevel::ERROR,"WEBLoader is already loaded", 1);
        return new self($homepage);
    }
    /**
     * Update the page to an error page
     * @param string $page The name of the error page
     * @return void
     */
    public function errorPage(string $page): void {
        $this->updatePage('err/'.$page);
    }

    /**
     * Update the page after checking the input
     * @param string $page The new page
     * @return void
     */
    private function updatePage(string $page): void {
        $this->handleUrl($page);
        try {
            CSecurity::checkUserFileInput($page);
        } catch (UnexpectedUriTokenException $e) {
            CAPP::$LOG->logFileAccessError($e, 'Page.updatePage', $page);
            $this->errorPage('422');
            return;
        }
        $this->page = $page;
        CAPP::$LANG->setPageLang($this->page);
    }

    /**
     * do a redirect to a new page with the option to do a full redirect of the client page
     * @param string $redirect the page that is to e redirected to
     * @param bool $doWebRedirect force a full redirect default to internal(false)
     * @param int $httpCode the http code tobe send along standard set to http 200 OK
     * @return void
     */
    private function redirect(string $redirect, bool $doWebRedirect = false, int $httpCode = 200): void {
        // TODO: implement this method
        if ($doWebRedirect) {

        }
        $this->updatePage($redirect);

    }

    private array $accessArray;
    private array $currentAccess;

    /**
     * @param string $page
     * @return void
     */
    private function handleUrl(string $page): void {
        $this->currentAccess = $this->accessArray;
        $urlArray = explode('/', $page);
        if (count($urlArray) > 1) {
            for ($i = 0; $i < count($urlArray); $i++) {
                if (is_array($this->currentAccess["subGroups"]) && isset($this->currentAccess["subGroups"][$urlArray[$i]]))
                    $this->currentAccess = $this->currentAccess["subGroups"][$urlArray[$i]];
            }
        }
        if (!$this->currentAccess["open"] && CAPP::$USER->hasAccess($urlArray)) {
            $this->redirect($this->currentAccess["redirect"], true);
        }
    }


    //TODO continue filling in the function and the rest of the route to a final page

    public function buildPage(): void {
        //        if (strpos($_GET['url'], '/') !== false) {// if the url acceses a sub folder of the views map check if a special header and footer are needed
//            $versionName = substr($_GET['url'], 0, strpos($_GET['url'], '/'));
//            $pageName = substr($_GET['url'], strpos($_GET['url'], '/') + 1, strlen($_GET['url']));
//            if (in_array($versionName, PAGES)) {
//                if (file_exists(ABSPATH. "elements/".$versionName."_header_element.php"))
//                    $headerVersion = $versionName. "_";
//                if (file_exists(ABSPATH. "elements/".$versionName."_footer_element.php"))
//                    $footerVersion = $versionName. "_";
//            }
//        }
//
        //        public function headerAndFooter() {
//            if (strpos($_GET['url'], '/') !== false) {// if the url acceses a sub folder of the views map check if a special header and footer are needed
//                $this->versionName = substr($_GET['url'], 0, strpos($_GET['url'], '/'));
//                $this->pageName = substr($this->page, strpos($this->page, '/') + 1, strlen($this->page));
//                if (in_array($this->versionName, PAGES)) {
//                    if (file_exists(FILES['ABSPATH']. "elements/".$this->versionName."_header_element.php"))
//                        $this->headerVersion = $this->versionName. "_";
//                    if (file_exists(FILES['ABSPATH']. "elements/".$this->versionName."_footer_element.php"))
//                        $this->footerVersion = $this->versionName. "_";
//                }
//            } else {//set the page name correct because otherwise some esthetic stuff do not work correctly
//                $this->pageName = $this->page;
//            }
//            return;
//        }

        //        /**
//         * build the page itself
//         */
//        public function buildPage() {
//            global $script, $language, $pages, $user, $controller, $language, $database, $data;
//            //start building the page out of the files required
//            //get the header for this pageGroup
//            require_once(FILES['ABSPATH']. "elements/".$this->headerVersion."header_element.php");
//            //if the view does not exist then redirect to the 404 page
//            require_once(FILES['ABSPATH']. "views/" .(file_exists(FILES['ABSPATH']. "views/" .$this->page. "_page.php") ? $this->page : '404'). "_page.php");
//            //get the footer for this pageGroup
//            require_once(FILES['ABSPATH']. "elements/".$this->footerVersion."footer_element.php");
//            return;
//        }
//        require_once(ABSPATH. "elements/".$headerVersion."header_element.php"); //start building the page out of the files required
//        require_once(ABSPATH. "views/" .(file_exists(ABSPATH. "views/" .$page. "_page.php") ? $page : '404'). "_page.php");
//        require_once(ABSPATH. "elements/".$footerVersion."footer_element.php");
    }









}