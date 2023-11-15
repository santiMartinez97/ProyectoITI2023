#!/bin/bash
#Gestion de grupos

opcion=0

#funciones

function menu(){
	clear
	echo "1) Agregar grupo"
	echo "2) Buscar grupo"
	echo "3) Listar grupo"
	echo "4) Borrar grupo"
	echo "5) Salir"

	echo "Seleccione una opcion: "
}

function altaGrupo(){
	read -p "Ingrese nombre del grupo que desea crear: " nombreGrupo
	existeGrupo=$(cat /etc/group | grep -c $nombreGrupo)
	if [ $existeGrupo -eq 0 ]; then
		groupadd $nombreGrupo
		echo "El grupo '$nombreGrupo' ha sido creado, presione enter para continuar"
		echo "$fecha - $USER Creo el grupo: '$nombreGrupo'." >> /root/logs/gestionGrupos.txt;
		read pause
	else
		echo "El grupo '$nombreGrupo' ya existe, presione enter para cotninuar"
		echo "$fecha - $USER Quiso crear el grupo: '$nombreGrupo', pero ya existia." >> /root/logs/gestionGrupo.txt;
		read pause
	fi
}

function buscarGrupo(){
	read -p "Ingrese nombre de grupo a buscar: " nombreGrupo
	existeGrupo=$(cat /etc/group | grep -c $nombreGrupo)
	if [ $existeGrupo -eq 1 ]; then
		echo "El grupo: '$nombreGrupo' existe, presione enter para continuar"
		echo "$fecha - $USER Busco el grupo: '$nombreGrupo'." >> /root/logs/gestionGrupo.txt;
		read pause
	else 
		echo "El grupo no existe, presione enter para continuar"
		echo "$fecha - $USER Busco el grupo: '$nombreGrupo', pero no existia." >> /root/logs/gestionGrupo.txt;
		read pause
	fi
}

function listarGrupo(){
	cut -d ":" -f1 /etc/group
	echo "Presione enter para continuar"
	echo "$fecha - $USER Listo los grupos." >> /root/logs/gestionGrupo.txt;
	read pause
}

function borrarGrupo() {
	read -p "Ingrese nombre del grupo a eliminar: " nombreGrupo
	existeGrupo=$(cat /etc/group | grep -c $nombreGrupo)
	if [ $existeGrupo -eq 1 ]; then
		read -p "El grupo '$nombreGrupo' sera eliminado, desea continuar? s/n: " confirma
		if [ $confirma == "S" -o $confirma == "s" ]; then
			groupdel $nombreGrupo
			echo "El grupo '$nombreGrupo' ha sido eliminado, presione enter para continuar"
			echo "$fecha - $USER Borro el grupo: '$nombreGrupo'." >> /root/logs/gestionGrupo.txt;
			read pause
		else
			echo "Se ha cancelado la eliminacion"
			echo "$fecha - $USER Quiso borrar el grupo: '$nombreGrupo', pero cancelo la operacion." >> /root/logs/gestionGrupo.txt;
		fi
	else 
		echo "El grupo '$nombreGrupo' no existe, presione enter para continuar"
		echo "$fecha - $USER Quiso borrar el grupo: '$nombreGrupo', pero no existia." >> /root/logs/gestionGrupo.txt;
		read pause
	fi
}

#Ejecucion

while [ $opcion -ne 5 ]
do
	menu
	read opcion
	echo "$fecha - $USER Ejecuto el script de GestionGrupos." >> /root/logs/gestionGrupo.txt;
	clear
	case $opcion in
		1)
			echo "1) Agregar grupo";
			altaGrupo;;
		2)
			echo "2) Buscar Grupo";
			buscarGrupo;;
		3)
			echo "3) Listar grupos";
			listarGrupo;;
		4)
			echo "4) Borrar grupo";
			borrarGrupo;;
		5)
			echo "Hasta la proxima";
			echo "$fecha - $USER Salio del menu de GesitonGrupos." >> /root/logs/gestionGrupo.txt;
			sleep 2;
			break;;
		*)
			echo "Opcion desconocida";
			echo "$fecha - $USER Eligio una opcion incorrectat." >> /root/logs/gestionGrupo.txt;
			sleep 2;;
	esac
done









