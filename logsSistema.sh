#!/bin/bash
#

function menu(){
	echo "LOGS DEL SISTEMA"
	echo "Eliga que logs quiere ver"
	echo "1 - Ver log: secure"
	echo "2 - Ver log: cron"
	echo "3 - Ver log: dnf.log"
	echo "4 - Ver log: boot.log"
	echo "5 - Ver log: mailog"
	echo "6 - Ver log: mariadb/mariadb.log"
	echo "7 - Ver log: samba/log.smbd"
	echo "8 - Ver log: httpd/error_log"
	echo "9 - Ver log: wtmp"
	echo "10 - Ver log: lastlog"
	echo "11 - Ver log: spool"
	echo "12 - Ver log: firewalld"
	echo "0 - Salir"
	echo "Seleccione una opcion: "
}

function opcion(){
	echo "Que desea hacer?"
	echo "1 - Ver todo el log"
	echo "2 - Buscar palabra en log"
	echo "Seleccione una opcion: "
}

opcion=0
fecha=$(date +%Y-%m-%d-%H:%M:%S)

##MENU

while [ $opcion -eq 0 ];
do
	menu
read opcion
echo "$fecha - $USER ejecuto el menu de logs." >> /root/logs/logsSistema.txt
clear
case $opcion in
	1)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/secure;
			echo "$fecha - $USER visualizo los logs de secure." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/secure | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de secure, buscando la palabra $palabra." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	2)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/cron;
			echo "$fecha - $USER visualizo los logs de cron." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/cron | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de cron, buscando la palabra $palabra." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	3)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/dnf.log;
			echo "$fecha - $USER visualizo los logs de dnf.log, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/dnf.log | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de dnf.log, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	4)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/boot.log;
			echo "$fecha - $USER visualizo los logs de boot.log." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/boot.log | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de boot.log, buscando la palabra $palabra." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	5)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/maillog;
			echo "$fecha - $USER visualizo los logs de maillog." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/maillog | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de maillog, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	6)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/mariadb/mariadb.log;
			echo "$fecha - $USER visualizo los logs de mariadb.log." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/mariadb/mariadb.log | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de mariadb.log, buscando la palabra $palabra." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	7)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/samba/log.smbd;
			echo "$fecha - $USER visualizo los logs de samba/log.smbd." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/samba/log.smbd | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de samba/log.smbd, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	8)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/httpd/error_log;
			echo "$fecha - $USER visualizo los logs de httpd/error_log." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/httpd/error_log | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de httpd/error_log, buscando la palabra $palabra." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	9)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/wtmp;
			echo "$fecha - $USER visualizo los logs de wtmp." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/wtmp | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de wtmp, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	10)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/lastlog;
			echo "$fecha - $USER visualizo los logs de lastlog." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/lastlog | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de lastlog, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	11)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/spool;
			echo "$fecha - $USER visualizo los logs de spool." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/spool | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de spool, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	12)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /var/log/firewalld;
			echo "$fecha - $USER visualizo los logs de firewalld." >> /root/logs/logsSistema.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /var/log/firewalld | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de firewalld, buscando la palabra $palabra ." >> /root/logs/logsSistema.txt;
		fi;
		read pause;;
	0)
		echo "Hasta la proxima";
		echo "$fecha - $USER Salio del scirpt de logs de sistema." >> /root/logs/logsSistema.txt;
		sleep 2;
		break ;;
	*) 
		echo "Opcion invalida";
		echo "$fecha - $USER Se equivoco en la ejecucion de el scirpt de logs de sistema ." >> /root/logs/logsSistema.txt;
		sleep 2;;
	esac
done




