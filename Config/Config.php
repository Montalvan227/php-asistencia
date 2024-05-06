<?php
// const BASE_URL = "https://iepmariajosesimebarbadillo.org/";
const BASE_URL = "http://asistencia-palacios.test/";

//Zona horaria
date_default_timezone_set('America/Lima');

//Datos de conexión a Base de Datos
const DB_HOST = "localhost";
const DB_NAME = "asistencia-palacios";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_CHARSET = "utf8";

//Para envío de correo
const ENVIRONMENT = 1; // Local: 0, Produccón: 1;

//Deliminadores decimal y millar Ej. 24,1989.00
const SPD = ".";
const SPM = ",";

//Api PayPal
//SANDBOX PAYPAL
const URLPAYPAL = "https://api-m.sandbox.paypal.com";
const IDCLIENTE = "";
const SECRET = "";
//LIVE PAYPAL
//const URLPAYPAL = "https://api-m.paypal.com";
//const IDCLIENTE = "";
//const SECRET = "";

//Datos envio de correo
const NOMBRE_REMITENTE = "MARIA JOSE SIME BARBADILLO";
const EMAIL_REMITENTE = "iep.ips.simebarbadillo@gmail.com";
const NOMBRE_EMPESA = "MARIA JOSE SIME BARBADILLO";
const WEB_EMPRESA = "www.iepmariajosesimebarbadillo.org";

const DESCRIPCION = "Software de Asistencia y Gestiòn de Notas.";
const SHAREDHASH = "Software";

//Datos Empresa
const DIRECCION = "Miguel Graú N°888, Jayanca";
const TELEMPRESA = "(+51) 961620781";
const WHATSAPP = "+51961620781";
const EMAIL_EMPRESA = "iep.ips.simebarbadillo@gmail.com";
const EMAIL_CONTACTO = "iep.ips.simebarbadillo@gmail.com";

//Datos para Encriptar / Desencriptar
const KEY = 'softwarecolegio';
const METHODENCRIPT = "AES-128-ECB";

//Módulos
const MDASHBOARD = 1;
const MUSUARIOS = 2;
const MDOCENTES = 3;
const MALUMNOS = 5;

//Páginas
const PINICIO = 1;
const PTIENDA = 2;
const PCARRITO = 3;
const PNOSOTROS = 4;
const PCONTACTO = 5;
const PPREGUNTAS = 6;
const PTERMINOS = 7;
const PSUCURSALES = 8;
const PERROR = 9;

//Roles
const RADMINISTRADOR = 1;
const RSUPERVISOR = 2;
const RDOCENTES = 3;

const STATUS = array('Asistio', 'Falto');

//REDES SOCIALES
const FACEBOOK = "https://www.facebook.com/";
const INSTAGRAM = "https://www.instagram.com/";
