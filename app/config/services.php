<?php
use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginacionBuilder;
use Phalcon\Http\Request;
use Phalcon\Filter;
use Phalcon\Http\Response;
use Phalcon\Mvc\Router;
use Phalcon\Http\Response\Cookies;
/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * We register the events manager
 */
$di->set('dispatcher', function () use ($di) {

    $eventsManager = new EventsManager;

    /**
     * Check if the user is allowed to access certain action using the SecurityPlugin
     */
    //$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

    /**
     * Handle exceptions and not-found exceptions using NotFoundPlugin
     */
    $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

    $dispatcher = new Dispatcher;
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlProvider();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});
/*$di->set('getbaseurl', function() use ($config){
    if (!file_exists(__DIR__ . '/' . $_SERVER['REQUEST_URI'])) {
    $_GET['_url'] = $_SERVER['REQUEST_URI'];
    echo $_GET['_url'];exit();
    }
    $url->setBaseUri('//my.domain.com/');
    //$url = new UrlProvider();
    //$url = $config->application->baseUri;
    //return $url;
}, true);*/

$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir(APP_PATH . $config->application->viewsDir);

    $view->registerEngines(array(
        ".volt" => 'volt'
    ));

    return $view;
});

/**
 * Setting up volt
 */
$di->set('volt', function ($view, $di) {
//echo'<pre>';print_r ($view);exit;
    $volt = new VoltEngine($view, $di);

    $volt->setOptions(array(
        "compiledPath" => APP_PATH . "cache/volt/"
    ));

    $compiler = $volt->getCompiler();
    $compiler->addFunction('is_a', 'is_a');

    return $volt;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    $config = $config->get('database')->toArray();
    $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
    unset($config['adapter']);
    return new $dbClass($config);
});

$di->set('dbcdata', function () use ($config) {
    $config = $config->get('dbcdata')->toArray();
    $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
    unset($config['adapter']);
    return new $dbClass($config);
});

$di->set('dbtrd', function () use ($config) {
    $config = $config->get('dbtrd')->toArray();
    $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
    unset($config['adapter']);
    return new $dbClass($config);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaData();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

$di->set('cookies', function () {
        $cookies = new Cookies();
        $cookies->useEncryption(false);
        return $cookies;
    }
);
/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new FlashSession(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});

/**
 * Register a user component
 */

/*************   TO configure the google calendar api ***********/
 $di->set('capi', function () {
    return new Googlecalendarapi();
});
/************* End of TO configure the google calendar api ***********/

$di->set('elements', function () {
    return new Elements();
});
$di->set('htmlelements', function () {
    return new Htmlelements();
});
$di->set('emailer', function () {
    return new Email();
});
$di->set('devicedetect', function () {
    return new Devicedetect();
});
$di->set('validationcommon', function () {
    return new Validationcommon();
});//
$di->set('initialdeclarationcommon', function () {
    return new Initialdeclarationcommon();
});
$di->set('annualdeclarationcommon', function () {
    return new Annualdeclarationcommon();
});
$di->set('automailercommon', function () {
    return new Automailercommon();
});
$di->set('adminaccesscommon', function () {
    return new Adminaccesscommon();
});//
$di->set('approvelperinfocommon', function () {
    return new Approvelperinfocommon();
});//
$di->set('sharecapitalcommon', function () {
    return new Sharecapitalcommon();
});//
$di->set('relholdingsummarycommon', function () {
    return new Relholdingsummarycommon();
});


$di->set('encryptdecryptcommon', function () {
    return new Encryptdecryptcommon();
});//

$di->set('upsicommon', function () {
    return new Upsicommon();
});
$di->set('adminmodulecommon', function () {
    return new Adminmodulecommon();
});
$di->set('tradingrequestcommon', function () {
    return new Tradingrequestcommon();
});
$di->set('miscommon', function () {
    return new Miscommon();
});
$di->set('exceptionreqcommon', function () {
    return new Exceptionreqcommon();
});
/*###################### Important Query Files #####################################################*/

$di->set('sharescreencommon', function () {
    return new Sharescreencommon();
});
$di->set('dsccommon', function () {
    return new Dsccommon();
});
$di->set('querybrucecommon', function () {
    return new Querycommon();
});
$di->set('commonquerycommon', function () {
    return new Commonquerycommon();
});

$di->set('dompdfgen', function () {
    return new Dompdfgen();
});
$di->set('browsecompanycommon', function () {
    return new Browsecompanycommon();
});
$di->set('searchcommon', function () {
    return new Searchcommon();
});

$di->set('changepasswordcommon', function () {
    return new Changepasswordcommon();
});
$di->set('logincommon', function () {
    return new Logincommon();
});
$di->set('phpimportexpogen', function () {
    return new Phpimportexpogen();
});
$di->set('usercommon', function () {
    return new Usercommon();
});

$di->set('homecommon', function () {
    return new Homecommon();
});
$di->set('companymastercommon', function () {
    return new Companymastercommon();
});
$di->set('departmentmastercommon', function () {
    return new Departmentmastercommon();
});// 
$di->set('portfoliocommon', function () {
    return new Portfoliocommon();
});
$di->set('employeemodulecommon', function () {
    return new Employeemodulecommon();
});
$di->set('insidercommon', function () {
    return new Insidercommon();
});
$di->set('notificationcommon', function () {
    return new Notificationcommon();
});
$di->set('companymodulecommon', function () {
    return new Companymodulecommon();
});
$di->set('restrictedcompanycommon', function () {
    return new Restrictedcompanycommon();
});
$di->set('holdingstatementcommon', function () {
    return new Holdingstatementcommon();
});
$di->set('termsandconditionscommon', function () {
    return new Termsandconditionscommon();
});
$di->set('sensitiveinformationcommon', function () {
    return new Sensitiveinformationcommon();
});
$di->set('holdingsummarycommon', function () {
    return new Holdingsummarycommon();
});
$di->set('blackoutperiodcommon', function () {
    return new Blackoutperiodcommon();
});
$di->set('tradingplancommon', function () {
    return new Tradingplancommon();
});
$di->set('declarationformcommon', function () {
    return new Declarationformcommon();
});
$di->set('reconcilationcommon', function () {
    return new Reconcilationcommon();
});
$di->set('uploadholdingcommon', function () {
    return new Uploadholdingcommon();
});
$di->set('continuousdisclosurecommon', function () {
    return new Continuousdisclosurecommon();
});
$di->set('esopcommon', function () {
    return new Esopcommon();
});
$di->set('randomrequestcommon', function () {
    return new Randomrequestcommon();
});
$di->set('randomexceptioncommon', function () {
    return new Randomexceptioncommon();
});
$di->set('sebicommon', function () {
    return new Sebicommon();
});
$di->set('coicommon', function () {
    return new Coicommon();
});
/*###################### Important Query Files End #####################################################*/


$di->set('timecommon', function () {
    return new Timecommon();
});
$di->set('imagecommon', function () {
    return new Imagecommon();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});
$di->set('filter', function() {
    $filter = new Filter();
    return $filter;
});
$di->set('request', function() {
    $request = new Request();
    return $request;
});
$di->set('response', function() {
    $response = new Response();
    return $response;
});
$di->set('jsmin', function() {
    $response = new Phalcon\Assets\Filters\Jsmin();
    return $response;
});
$di->set('cssmin', function() {
    $response = new Phalcon\Assets\Filters\Cssmin();
    return $response;
});
//echo __DIR__ ;exit;
$di->set('router', function () {
    return require __DIR__.'/routes.php';
});
$di->set('createrouter', function () {
    $router = new Router();
    return $router;
});

/*###################### Important Config Directory URL  #####################################################*/

$di->set('basekdir', function () use ($config) {
    $createviewsdir = $_SERVER["DOCUMENT_ROOT"].$config->application->baseUri;
    return $createviewsdir;
});

$di->set('createviewsdir', function () use ($config) {
    $createviewsdir = $config->application->viewsDir;
    return $createviewsdir;
});
$di->set('createlibrarydir', function () use ($config) {
    $createviewsdir = $config->application->libraryDir;
    return $createviewsdir;
});
$di->set('createlanguagedir', function () use ($config) {
    $createviewsdir = $config->application->languageDir;
    return $createviewsdir;
});

/*###################### Important Config Directory URL  /-#####################################################*/

/*###################### Important Directory URL  #####################################################*/
$di->set('userdocdir', function () use ($config) {
    $homethemedir = $config->imgdir->userdocDir;
    return $homethemedir;
});
$di->set('sharescreendir', function () use ($config) {
    $homethemedir = $config->imgdir->sharescreenDir;
    return $homethemedir;
});
$di->set('dscdir', function () use ($config) {
    $homethemedir = $config->imgdir->dscDir;
    return $homethemedir;
});
$di->set('declarationDir', function () use ($config) {
    $homethemedir = $config->imgdir->declarationDir;
    return $homethemedir;
});
$di->set('cmpmodule', function () use ($config) {
    $homethemedir = $config->imgdir->cmpmodule;
    return $homethemedir;
});
$di->set('holdingstatement', function () use ($config) {
    $homethemedir = $config->imgdir->holdingstatement;
    return $homethemedir;
});
$di->set('recipientupload', function () use ($config) {
    $homethemedir = $config->imgdir->recipientupload;
    return $homethemedir;
});
$di->set('infoshareattachment', function () use ($config) {
    $homethemedir = $config->imgdir->infoshareattachment;
    return $homethemedir;
});
$di->set('myinfiDir', function () use ($config) {
    $homethemedir = $config->imgdir->myinfiDir;
    return $homethemedir;
});
$di->set('reconcilationDir', function () use ($config) {
    $homethemedir = $config->imgdir->reconcilationDir;
    return $homethemedir;
});
$di->set('holdingDir', function () use ($config) {
    $homethemedir = $config->imgdir->holdingDir;
    return $homethemedir;
});
$di->set('esopDir', function () use ($config) {
    $homethemedir = $config->imgdir->esopDir;
    return $homethemedir;
});
$di->set('sebiDir', function () use ($config) {
    $homethemedir = $config->imgdir->sebiDir;
    return $homethemedir;
});
$di->set('upsiconnectedDPDir', function () use ($config) {
    $homethemedir = $config->imgdir->upsiconnectedDPDir;
    return $homethemedir;
});
$di->set('coiDir', function () use ($config) {
    $homethemedir = $config->imgdir->coiDir;
    return $homethemedir;
});

/*###################### Important Directory URL End #####################################################*/


// Start the session the first time when some component request the session service
/*$di->setShared('session', function () {
    $session = new Session();
    $session->start();
    return $session;
});*/
