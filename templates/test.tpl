<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SICC | C&oacute;digo Limpio</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="./css/fonts/stylesheet.css" type="text/css" charset="utf-8">

<link rel="stylesheet" href="./css/themes/default/easyui.css" />
<link rel="stylesheet" href="./css/themes/icon.css" />

<link rel="stylesheet" href="./css/sesion.css" />
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/style.css">

<script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./js/js.base64.encrypt.js"></script>
<script type="text/javascript" src="./js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="./js/easyui/datagrid-filter.js"></script>
<script type="text/javascript" src="./js/locale/easyui-lang-es.js"></script>
<script type="text/javascript" src="./js/jSetup.js"></script>
<script type="text/javascript" src="./js/sicc/jReportes.js"></script>
<!--script type="text/javascript" src="./js/vendor/flot/jquery.flot.js"></script>
<script type="text/javascript" src="./js/vendor/flot/jquery.flot.canvas.js"></script>
<script type="text/javascript" src="./js/vendor/canvas2image.js"></script>
<script type="text/javascript" src="./js/vendor/flot/jquery.flot.saveAsImage.js"></script>
<script type="text/javascript" src="./js/vendor/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="./js/vendor/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="./js/vendor/flot/jquery.flot.resize.js"></script-->
<script src="./js/vendor/highcharts/highcharts.js" type="text/javascript"></script>
<script src="./js/vendor/highcharts/data.js" type="text/javascript"></script>
<script src="./js/vendor/highcharts/exporting.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/sicc/jGraph.js"></script>
        <link rel="stylesheet" href="./css/desktop/desktop.css" />
        <link rel="stylesheet" href="./css/desktop/menu.css" />
        <link rel="stylesheet" href="./css/desktop/tooltipster.css" />
        <link rel="stylesheet" href="./css/desktop/escritorio.css" />
        <link href="./js/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
        <script src="./js/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
        <script src="./js/jquery.cookie.js"></script>
        <script src="./js/js.base64.encrypt.js"></script>
        <script src="./js/jSetup.js"></script>
        <script src="./js/jquery.tooltipster.min.js"></script>
        <script src="./js/jquery.desktop.js"></script>
        <script src="./js/js.axLDCtn.js"></script>
        <script src="./js/js.buildMenuJsonHtml.js"></script>
        <script id="seguridad_js" src="./js/jquery.seguridad.js?_nu=10000"></script>
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/desktop/ie.css" />
        <![endif]-->
    </head>
    <body>
        <img id="wallpaper" src="images/misc/bg-map.png" />
        <div id="dvMuestraAdvertencia" style="padding:10px 20px">
            <div id="content_muestra_advertencia"></div>
        </div>
        <div id="dvContactame" style="padding:10px 20px"></div>
        <div class="abs" id="wrapper">

            <div id="header" class="abs">
                <div class="escritorio-header" id="bar_top">
                    <div class="logo-escritorio">
                        <a href="#">
                            <img src="images/logotipos/logo-CFE.png" />
                        </a>
                    </div>
                    <!-- Usuario Menu Configuracion -->
                    <ul class="escritorio-aux" id="menu-profile">
                        <li class="date-esc" id="clock"></li>
                        <li class="date-usr"><a href="#" class="drop" id="lnNombreCorto"></a>
                            <div class="dropdown_2columns align_right">
                                <div class="speech-bubble">
                                    <div class="usr-info">
                                        <img id="imgProfile">
                                        <p id="pFullName"></p>
                                        <ul>
                                            <li>
                                                <a class="ico-user" href="#" id="alAdministrador">
                                                    Administrador</a>
                                            </li>
                                            <li>
                                                <a class="ico-logout" href="#" id="alCerrarSesion">
                                                    Cerrar sesi&oacute;n</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Fin Usuario Menu -->
                </div>
            </div>

            <div id="desktop" class="abs">
                <div id="icons_desktop"></div>
            </div>

            <div class="abs" id="bar_bottom">
                <div class="ico-escritorio" id="show_desktop" >
                    <a href="#"></a>
                </div>
                <div class="copyright" id="dvVersionDesktop"></div>
            </div>

        </div>
    </body>
</html>