#!/bin/bash
#

function menu(){
        echo "LOGS PROPIOS"
        echo "Eliga que logs quiere ver"
        echo "1 - Ver log: GestionUsuarios"
        echo "2 - Ver log: GestionGrupo"
        echo "3 - Ver log: Firewall"
        echo "4 - Ver log: Firewalll red"
        echo "5 - Ver log: Firewall puertos"
        echo "6 - Ver log: RespaldosBD"
        echo "7 - Ver log: Configuracion red"
        echo "8 - Ver log: Logs sistema"
        echo "9 - Ver log: Logs script"
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
echo "$fecha - $USER ejecuto el menu de logs propios." >> /root/logs/logsScripts.txt
clear
case $opcion in
        1)
   		opcion;
		read opc;
		if [ $opc -eq 1 ];
                then
                        cat /root/logs/gestionUsuario.txt;
                        echo "$fecha - $USER visualizo los logs de Gestion Usuario." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/gestionUsuario.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de Gestion Usuario, buscando la palabra $palabra." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
	2)
		opcion;
		read opc;
		if [ $opc -eq 1 ];
		then
			cat /root/logs/gestionGrupo.txt;
			echo "$fecha - $USER visualizo los logs de Gestion Grupo." >> /root/logs/logsScripts.txt;
		fi;
		
		if [ $opc -eq 2 ];
	       	then
			echo "Ingrese palabra que desea buscar";
			read palabra;
			cat /root/logs/gestionGrupo.txt | grep "$palabra";
			echo "$fecha - $USER visualizo los logs de Gestion Grupo, buscando la palabra $palabra." >> /root/logs/logsScripts.txt;
		fi;
		read pause;;
        3)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/firewall.txt;
                        echo "$fecha - $USER visualizo los logs de firewall, buscando la palabra $palabra ." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/firewall.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de firewall, buscando la palabra $palabra ." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
        4)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/firewallR.txt;
                        echo "$fecha - $USER visualizo los logs de firewall red." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/firewallR.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de firewall red, buscando la palabra $palabra." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
        5)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/firewallP.txt;
                        echo "$fecha - $USER visualizo los logs de firewall puertos." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/firewallP.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de firewall puertos, buscando la palabra $palabra ." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
        6)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/respaldoBD.txt;
                        echo "$fecha - $USER visualizo los logs de respaldo de base de datos. " >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/respaldoBD.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de respaldo de base de datos, buscando la palabra $palabra." >> /root/logs/logsScripts.txt;
                fi;
               	read pause;;
        7)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/configuracionRed.txt;
                        echo "$fecha - $USER visualizo los logs de configuracion de red." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/configuracionRed.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de configuracion de red, buscando la palabra $palabra ." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
        8)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/logsScripts.txt;
                        echo "$fecha - $USER visualizo los logs de el script de logs." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/logsScripts.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de el script de logs, buscando la palabra $palabra." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;

        9)
                opcion;
                read opc;
                if [ $opc -eq 1 ];
                then
                        cat /root/logs/logsSistema.txt;
                        echo "$fecha - $USER visualizo los logs de el sistema." >> /root/logs/logsScripts.txt;
                fi;

                if [ $opc -eq 2 ];
                then
                        echo "Ingrese palabra que desea buscar";
                        read palabra;
                        cat /root/logs/logsSistema.txt | grep "$palabra";
                        echo "$fecha - $USER visualizo los logs de el sistema, buscando la palabra $palabra ." >> /root/logs/logsScripts.txt;
                fi;
                read pause;;
        0)
                echo "Hasta la proxima";
                echo "$fecha - $USER Salio del scirpt de logs de propios." >> /root/logs/logsScripts.txt;
                sleep 2;
                break ;;
        *)
                echo "Opcion invalida";
                echo "$fecha - $USER Se equivoco en la ejecucion de el scirpt de logs propios." >> /root/logs/logsScript.txt;
                sleep 2;;
        esac
done



