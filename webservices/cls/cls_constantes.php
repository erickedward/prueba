<?php
switch ($_SERVER["SERVER_ADDR"]) {
    case '150.188.27.20':
    case '150.188.27.21':
    case '150.188.27.22':
    case '150.188.27.23':
    	//$hostname = "150.187.96.6";//PRODUCCION INTERNO
		define("C_SERVIDOR_PRODUCCION_EXT","activo");   
    	$hostname = "150.188.27.30";
    	
    	//define("C_SERVIDOR_PRODUCCION_EXT_CENIT","activo");    	      
    break;
    case '172.17.1.42':
        $hostname = "172.17.1.45";
        define ("C_SERVIDOR_PRODUCCION_INT","activo");   	  	
    break;
    default:
    case '172.17.2.185':
    case '127.0.0.1':
		define ("C_SERVIDOR_PRUEBA","activo");
		$hostname = "ctsi-tecn-sv004";
    break;
    case '150.188.8.204':
    	$hostname = "150.188.27.30";
    break;
}

define ("C_SERVIDOR",$hostname);
define ("C_USUARIO","user_web");
define ("C_PASSWORD","DD2088F615E541791C6897382C79FA");
define ("C_BDATOS","administracion");

#Parametros conexi�n auditoria
define ("C_USUARIO_AUD","user_cfg");
define ("C_PASSWORD_AUD","41d8cd98f00b204e9800998ecf8427");

#Parametros de conexi�n de men�
define ("C_MENU_SERVIDOR",C_SERVIDOR);
define ("C_MENU_USUARIO","user_web");
define ("C_MENU_PASSWORD",C_PASSWORD);
define ("C_MENU_BDATOS",C_BDATOS);

//============== Mensajes de Errores
define ("C_ERROR_CNN_FALLIDA","Error: No se pudo hacer la conexion al servidor DB");
define ("C_ERROR_BD_FALLIDA","Error: No se pudo conectar a la base de datos");
define ("C_ERROR_QUERY","Error: No se pudo realizar la consulta");
define ("C_ERROR_CNN_FALLIDA_SISTEMA","Error: No se pudo hacer la conexion al servidor DB (Base de Datos de Sistema no Configurada)");

//============== Basicas
define ("C_SI",1);
define ("C_NO",2);

//============== Transacciones
define ("C_COMMIT",1);
define ("C_ROLLBACK",2);
define ("C_IGNORAR_TRANS",0);

//============== Tipos Metas:
define("C_TIPO_I","I");
define("C_TIPO_C","C");
define("C_TIPO_X","X");
define("C_TIPO_N","N");
define("C_TIPO_D","D");
define("C_TIPO_T","T");

//============== Parametros iniciales para la consulta
define("C_REG_INI",0);
define("C_REG_BLOQUE",5);

define("C_SEP_L",",");
define("C_SEP_Q",";");
define("C_SEP_V",":");

define("C_SEP_GRUPOS",";");
define("C_SEP_TITULOS",":");

//========================Formularios=============================
// Constantes para los Tipos de Control de Campos
define("C_CONTROL_NORMAL","0");
define("C_CONTROL_TEXTO","1");
define("C_CONTROL_TEXTAREA","2");
define("C_CONTROL_LISTA","3");
define("C_CONTROL_RADIOBUTTONS","4");
define("C_CONTROL_CHECKBOX","5");
define("C_CONTROL_LISTA_SET","6");
define("C_CONTROL_ARCHIVO","7");
define("C_CONTROL_IMAGEN","8");
define("C_CONTROL_HIDDEN","9");
define("C_CONTROL_PASSWORD","10");
define("C_CONTROL_BUTTON","11");
define("C_CONTROL_SUBMIT","12");
define("C_CONTROL_RESET","13");
define("C_CONTROL_CALENDAR","14");
define("C_CONTROL_TIMER","15");
define("C_CONTROL_EDITOR","16");
define("C_CONTROL_PASS_MD5","17");
define("C_CONTROL_FECHA_HOY","18");
define("C_CONTROL_CAMPO_INT","19");
define("C_CONTROL_CAMPO_FECHA","20");
define("C_CONTROL_CALENDAR_COMBO","21");
define("C_CONTROL_EDITOR_CONTROL","22");
define("C_CONTROL_CAMPO_DECIMAL","23");
define("C_CONTROL_TEXTO_CORTO","24");
define("C_CONTROL_CAMPO_FECHA_HORA","25");
define("C_CONTROL_CAMPO_TELEFONO","26");
//Constantes Varias clase Formularios
define ("C_ERROR_QUERY_NO_SELECT","Parametro de Consulta no valido (solo consultas)");
define ("C_TEXTO_PREF_LEYENDA","Ej:");
define ("C_SEP_LEYENDA",";");
define ("C_SEP_PAR",";");
define ("C_SEP_PAR_TEXTO",":");
define ("C_ANNIO_INICIO_COMBO","2000");

/*
#Estilos para Formularios
#Ruta: css_template.css
define ("C_ESTILO_TABLA_CAPTION","caption_tabla");
define ("C_ESTILO_TABLA_CAPTION2","caption_tabla2");
define ("C_ESTILO_TIT_FORM","titulo_form");
define ("C_ESTILO_TIT_FORM_2","titulo_form_2");
define ("C_ESTILO_TEXTO_FORM","texto_form");
define ("C_ESTILO_LEY_FORM","leyenda_form");
define ("C_ESTILO_CALENDAR_FORM","calendario");
*/
/*
#Estilos Tablas de Consultas
#Ruta: css_template.css
define("C_ESTILO_TABLA_CONSULTA","tabla_consulta");//gris en el fondo de la tabla
define("C_ESTILO_TABLA_TEXTO","contenido_td");//color a la celda (blanco), contenido de la tabla
define("C_ESTILO_TABLA_TEXTO2","contenido_td2");//color a la celda (gris), contenido de la tabla
define("C_ESTILO_TABLA_TEXTO_RED","contenido_td_red");
define("C_ESTILO_TABLA_EDITAR","edit_td");//Para link de tabla estilo a la celda y al contenido
define("C_ESTILO_TABLA_EDITAR2","edit_td2");//gris a la celda con el texto azul
define("C_ESTILO_TABLA_EDITAR_OVER","edit_td_over");//blanco a la celda con el texto negro
define("C_ESTILO_TABLA_EDITAR_OVER2","edit_td_over2");//gris a la celda con el texto negro
define("C_ESTILO_TABLA_TIT_COLS","titulo_th");//titulo 
define("C_ESTILO_TABLA_TIT_COLS2","titulo_th2");
define("C_ESTILO_TABLA_DIVISOR","divisor_tabla_consulta");
*/
//===================Imagenes del Portal======================
//define ("C_IMG_BANNER","bannerestudiante.jpg");
//define ("C_IMG_REG_LINEA","registroenlinea.jpg");

/*
//=======================Estilos Portal=======================
define("C_ESTILO_BANNER","banner");
define("C_ESTILO_PORTAL_INF_INT","infodeintereslink");
define("C_ESTILO_PORTAL_INF_INT_OVER","infodeinteresover");
define("C_ESTILO_PORTAL_TIT_INF_INT","tit_infodeinteres");
define("C_ESTILO_PORTAL_TIT_INF_INT_OVER","tit_infodeinteresover");
*/

define("C_PREFIJO_PORTAL_INFOINTERES","url_portal_infointeres");
define("C_PREFIJO_PORTAL_ENLACES","url_footer");
define("C_PREFIJO_PORTAL_PENSAMIENTO","msj_portal_pensamiento");

/*
//=======================Estilos Eventos==========================
define("C_ESTILO_TEXTO_EVENTOS","descripevento");
define("C_ESTILO_DURACION_EVENTOS","duracion_evento");
define("C_ESTILO_DESC_EVENTOS","descripevento");
define("C_ESTILO_DESC_EVENTOS_OVER","descripevento_over");
*//*
define("C_IMG_VINETA_EVENTOS","flechaeventos.gif");
define("C_ESTILO_SECCION_EVENTOS","eventos_titulo");
define("C_ESTILO_SECCION_EVENTOS_OVER","eventos_titulo_over");
define("C_ESTILO_DETALLES_EVENTOS","detalles_eventos");
*/
//=======================Estilos Genrales========================
define("C_ESTILO_SEP_COLUMNA","separador_col");
define("C_RUTA_IMG_GENERAL","/imagenes/general/");
//=======================Estilos de Secciones "Pesta�as"========================
define("C_ESTILO_SEC_PEST","seccion_pestana_link");
define("C_ESTILO_SEC_PEST_OVER","seccion_pestana_link_over");

#Constante de tablas y bases de datos de administracion
define("C_BD_ADMINISTRACION","administracion");
define("C_BD_ADM_TB_CFG_AUDITORIA","administracion.cfg_auditoria");
define("C_BD_ADM_TB_CFG_CAMPOS","administracion.cfg_campos");
define("C_BD_ADM_TB_CFG_TABLAS","administracion.cfg_tablas");
define("C_BD_ADM_TB_CFG_SISTEMAS","administracion.cfg_sistemas");
define("C_BD_ADM_TB_CFG_BASE_DATOS","administracion.cfg_base_datos");
define("C_BD_ADM_TB_CFG_CLAVES","administracion.cfg_claves");
define("C_BD_ADM_TB_CFG_USUARIOS","administracion.cfg_usuarios");define("C_BD_ADM_TB_CFG_USUARIO_GRUPO","administracion.cfg_usuario_grupo");define("C_BD_ADM_TB_CFG_GRUPO_MENU","administracion.cfg_grupo_menu");define("C_BD_ADM_TB_CFG_MENUES","administracion.cfg_menues");define("C_BD_ADM_TB_CFG_ITEMS","administracion.cfg_items");define("C_BD_ADM_TB_CFG_ITEM_MENU","administracion.cfg_item_menu");define("C_BD_ADM_TB_CFG_MENU_SISTEMA","administracion.cfg_menu_sistema");

define("C_CODIGOS_TELEFONICOS","0212;0412;0414;0424;0416;0426;
											0234;0235;0237;0238;
											0239;0240;0241;0242;
											0243;0244;0245;0246;
											0247;0248;0249;0251;
											0252;0253;0254;0255;
											0256;0257;0258;0259;
											0260;0261;0262;0263;
											0264;0265;0266;0267;
											0268;0269;0271;0272;
											0273;0274;0275;0276;
											0277;0278;0279;0281;
											0282;0283;0284;0285;
											0286;0287;0288;0289;
											0291;0292;0293;0294;0295");
?>