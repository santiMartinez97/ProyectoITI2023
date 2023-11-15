#!/bin/bash
#Matrix Mind
#Script inicial del servidor

##VARIABLES
opc=1

##FUNCIONES
function menu(){
	echo "MENÚ PRINCIPAL"
	echo "1- Gestión de usuarios"
	echo "2- Gestión de grupos"
	echo "3- Gestión de respaldo de base de datos"
	echo "4- Gestión de redes"
	echo "5- Gestión de firewall"
	echo "0- Salir"
}

##PROGRAMA
while [ $opc -ne 0 ];
do
	clear
	menu
	echo "Ingrese una opción: "
	read opc
	echo "$fecha - $USER Ejecuto el script de administrador." >> /root/logs/adminscript.txt;
	case $opc in
		1)
			sh GestionUsuarios.sh;
			echo "$fecha - $USER Ejecuto el script de GestionUsuarios." >> /root/logs/adminscript.txt;
		2)
			sh GestionGrupos.sh;
			echo "$fecha - $USER Ejecuto el script de GestionGrupos." >> /root/logs/adminscript.txt;;
		3)
			sh scriptRespaldo.sh;
			echo "$fecha - $USER Ejecuto el script de respaldos." >> /root/logs/adminscript.txt;;
		4)
			sh configuraciondered.sh;
			echo "$fecha - $USER Ejecuto el script de configuracion de red." >> /root/logs/adminscript.txt;;
		5)
			sh firewall.sh;
			echo "$fecha - $USER Ejecuto el script de firewall." >> /root/logs/adminscript.txt;;
		6)
			sh logsSistema.sh;
			echo "$fecha - $USER Ejecuto el script de logs." >> /root/logs/adminscript.txt;;
		0)
			echo "Saliendo del menú. Pulse ENTER para finalizar.";
			echo "$fecha - $USER Salio del menu de administrador." >> /root/logs/adminscript.txt;
			read pause;;
		*)
			echo "Opción no válida. Pulse ENTER para volver.";
			echo "$fecha - $USER Se equivoco en el menu de administrador." >> /root/logs/adminscript.txt;
			read pause;
			opc=1;;
	esac
done
