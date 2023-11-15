#!/bin/bash
##
opc=0
fecha=$(date +%Y%m%d-BackUP-BD)

function menu(){
	echo "MENU GESTION DE BASE DE DATOS"
	echo "1 - Realizar respaldo compelto"
	echo "2 - Respaldar la estructura de la base de datos"
	echo "3 - Respaldo de manera remota"
	echo "4 - Restaurar base de datos"
	echo "5 - Realizar consulta personalizada"
	echo "6 - SALIR "
}

function respaldoCompleto() {
	echo "Ingrese nombre de la base de datos a respaldar"
	read nombreBD
	echo "show databases;" | mysql -u root -proot > bd.sql	
	existe=$(cat bd.sql | grep -c $nombreBD )
	if [ $existe -eq 1 ] 
	then	
		mysqldump --opt --events --routines --triggers --default-character-set=utf8 -u root -proot $nombreBD > $nombreBD.sql
	      tar -czvf $fecha.tar.gz $nombreBD.sql
		echo "$fecha - $USER Respaldo toda la base de datos: '$nombreBD'." >> /root/logs/respaldoBD.txt;
      mv $fecha.tar.gz /home/usuario/Desktop/respaldosCompletos/
rm $nombreBD.sql
rm bd.sql
	else 
		echo "La base de datos no existe, presione enter para continuar"
		echo "$fecha - $USER Quiso respaldar: '$nombreBD', pero esta no existia ." >> /root/logs/respaldoBD.txt;
		read pause
	fi
}

function respaldarEstructuraBD(){
	echo "Ingrese nombre de la base de datos a respaldar"
	read nombreBD
	echo "show databases;" | mysql -u root -proot > bd.sql	
	existe=$(cat bd.sql | grep -c $nombreBD )
	if [ $existe -eq 1 ] 
	then	
		mysqldump -v --opt --no-data --default-character-set=utf8 -u root -proot $nombreBD > $nombreBD.sql
	      tar -czvf $fecha.tar.gz $nombreBD.sql
		echo "$fecha - $USER Respaldo la estructura de: '$nombreBD'." >> /root/logs/respaldoBD.txt;
      mv $fecha.tar.gz /home/usuario/Desktop/respaldosEstructurados/
rm $nombreBD.sql
rm bd.sql
	else 
		echo "La base de datos no existe, presione enter para continuar"
		echo "$fecha - $USER Quiso reustarar la estructura de '$nombreBD', pero la base de datos no existia." >> /root/logs/respaldoBD.txt;
		read pause
	fi
}

function respaldoRemoto(){

	echo "Ingrese nombre de la base de datos a respaldar"
	read nombreBD
	echo "show databases;" | mysql -u root -proot > bd.sql	
	existe=$(cat bd.sql | grep -c $nombreBD )
	if [ $existe -eq 1 ] 
	then	
		mysqldump -v --opt -h localhost -P 3306 --compress --events --routines --triggers --default-character-set=utf8 -u root -proot $nombreBD > $nombreBD.sql
	      tar -czvf $fecha.tar.gz $nombreBD.sql
		echo "$fecha - $USER Respaldo remotamente la base de datos: '$nombreBD'." >> /root/logs/respaldoBD.txt;
      mv $fecha.tar.gz /home/usuario/Desktop/respaldosRemoto/
rm $nombreBD.sql
rm bd.sql
	else 
		echo "La base de datos no existe, presione enter para continuar"
		echo "$fecha - $USER Quiso respaldar remotamente la base de datos: '$nombreBD', pero esta no existia." >> /root/logs/respaldoBD.txt;
		read pause
	fi

}

function restaurarBD(){
	echo "Ingrese nombre de la base de datos a restaurar"
	read nombreBD
	echo "show databases;" | mysql -u root -proot > bd.sql	
	existe=$(cat bd.sql | grep -c $nombreBD )
	if [ $existe -eq 1 ] 
	then	
	echo "use $nombreBD; source /home/usuario/Desktop/respaldosCompletos/$nombreBD.sql;" | mysql -u root -proot
		echo "$fecha - $USER Restauro la base de datos '$nombreBD' ." >> /root/logs/respaldoBD.txt;
rm bd.sql
	else 
		echo "La base de datos no existe, presione enter para continuar"
		echo "$fecha - $USER Quiso restaurar la base de datos '$nombreBD', pero no existia." >> /root/logs/respaldoBD.txt;
		read pause
	fi
} 

function realizarConsulta(){
	echo "Ingrese la consulta que desea hacer" 
	read consulta
	echo "$consulta" | mysql -u root -proot
	echo "Presione enter cuando desee salir"
	read pause
	echo "$fecha - $USER Realizo esta consulta: '$consulta'." >> /root/logs/respaldoBD.txt;
}



while [ $opc -ne 6 ] 
do
	clear
	menu
	echo "Ingrese una opcion: "
	read opc
      	clear	
	echo "$fecha - $USER Ejecuto el script de respaldos de base de datos." >> /root/logs/respaldoBD.txt;

	case $opc in 
		1)respaldoCompleto ;;
		2)respaldarEstructuraBD;;
		3)respaldoRemoto;;
		4)restaurarBD;;
		5)realizarConsulta ;;	
		6)echo "Hasta la proxima";
	break;; 
		 *)echo "Opcion incorecta. Pulse ENTER para volver.";
		 echo "$fecha - $USER Ejecuto el script de respaldos de base de datos, pero se equivoco al elegir una opcion ." >> /root/logs/respaldoBD.txt;
			opc=0;
			read pause;;
			
	esac
done



