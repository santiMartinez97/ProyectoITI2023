#!/bin/bash
##gestion de usuarios del s.o

##FUNCIONES

function menu() {
	clear
	echo "Menu"
	echo "1) Crear usuarios"
	echo "2) Buscar usuaruis"
	echo "3) Eliminar usuarios"
	echo "4) Listar usuarios"
	echo "5) Modificar usuarios"
	echo "6) Bloquear/Desbloquear usuarios"
	echo "7) Salir"
	echo "Seleccione una opcion: "
}

function altaUsuarios() {

	read -p "Ingrese nombre del usuario a crear: " usuario 
	usuario=$(echo $usuario | tr [:upper:] [:lower:])
	existeUsuario=$(cat /etc/passwd | grep -c $usuario)
	if [ $existeUsuario -eq 0 ]; then

		echo "Que tipo de usuario desea crear: "
		echo "1) Administrador de sistemas"
		echo "2) Seguridad"
		echo "3) Redes"
		echo "4) Encargado de paquetes"
		echo "5) Backup de sistema"
		echo "6) Administrador de BD"
		read -p "Seleccione una opcion: " opcion

		case $opcion in 
			1)
				useradd -g adminSistemas -c "adminSistemas $year" -mk /etc/skel -s /bin/bash $usuario
			passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado,presione enter para continuar";
				echo "$fecha - $USER creó al usuario $usuario en el grupo adminSistemas." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			2)
				useradd -g seguridad -c "seguridad $year" -mk /etc/skel -s /bin/bash $usuario
				passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado, presione enter para continuar"
				echo "$fecha - $USER creó al usuario $usuario en el grupo seguridad." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			3)
				useradd -g redes -c "redes $year" -mk /etc/skel -s /bin/bash $usuario
				passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado,presione enter para continuar";
				echo "$fecha - $USER creó al usuario $usuario en el grupo redes." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			4) 	
				useradd -g actualizarPaquetes -c "actualizarPaquetes $year" -mk /etc/skel -s /bin/bash $usuario
				passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado,presione enter para continuar";
				echo "$fecha - $USER creó al usuario $usuario en el grupo actualizarPaquetes." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			5) 
			useradd -g backupSystem -c "backupSystem $year" -mk /etc/skel -s /bin/bash $usuario
			passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado,presione enter para continuar";
				echo "$fecha - $USER creó al usuario $usuario en el grupo backupSystem." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			6)
			useradd -g adminbd -c "adminbd $year" -mk /etc/skel -s /bin/bash $usuario
			passwd -e -d $usuario
				echo "El usuario '$usuario' ha sido creado,presione enter para continuar";
				echo "$fecha - $USER creó al usuario $usuario en el grupo adminbd." >> /root/respaldos/usuarios/usuario.txt
				read pause;
				break;;
			*)echo "Opcion no correcta";
			  echo "$fecha - $USER se equivoco en el menu de GestionUsuarios." >> /root/respaldos/usuarios/usuario.txt;
				sleep 2;;
			esac
else
	echo "El usuario '$usuario' ya existe, presione enter para continuar"
	echo "$fecha - $USER intentó crear el usuario $usuario, que ya existe." >> /root/respaldos/usuarios/usuario.txt
	read pause
	fi
	
}

function eliminarUsuarios() {	
	read -p "Ingrese nombre del usuario a eliminar: " nombre
	usuario=$(echo $nombre | tr [:upper:] [:lower:])
	existeUsuario=$(cat /etc/passwd | grep -c $usuario)
	if [ $existeUsuario -eq 1 ]; then
	        clear
       		echo "1) Baja logica"
 		echo "2) Baja fisica"
		read baja
		echo "Este usuario $usuario va a ser eliminado, desea continuar? S/N: "
		read confirma
		if [ $confirma == 'S' ]; then
			if [ $baja == "1" ]; then
				userdel $usuario
				echo "El usuario ha sido eliminado, presione enter para continuar"
				echo "$fecha - $USER ha dado baja lógica al usuario $usuario." >> /root/respaldos/usuarios/usuario.txt
				read pause
			elif [ $baja == "2" ]; then
				userdel -r $usuario
				echo "El usuario ha sido eliminado correctamente, presione enter para continuar"
				echo "$fecha - $USER ha dado baja física al usuario $usuario." >> /root/respaldos/usuarios/usuario.txt
				read pause
			else
				echo "Error al eliminar usuario, pulse enter para continuar"
				echo "$fecha - $USER ha intentado eliminar al usuario: $usuario." >> /root/respaldos/usuarios/usuario.txt
				read pause
			fi
		else
			echo "Se ha cancelado correctamente la baja, presione enter para continuar"
			echo "$fecha - $USER ha intentado cancelado la eliminacion al usuario: $usuario." >> /root/respaldos/usuarios/usuario.txt
			read pause
		fi
	else 
	echo "El usuario "$usuario" no existe, presione enter para continuar"
	echo "$fecha - $USER intentó eliminar el usuario $usuario, que no existe." >> /root/respaldos/usuarios/usuario.txt
	read pause	
	fi
}

function buscarUsuarios() {
	read -p "Ingrese nombre del usuario a buscar: " usuario
	existeUsuario=$(cat /etc/passwd | grep -c -i $usuario)
	if [ $existeUsuario -eq 1 ]; then
		mostrarUsuario=$(grep -i "$usuario" /etc/passwd | cut -d ':' -f5)
		echo "El usuario existe, se encuentra en el grupo: "$mostrarUsuario", presione enter para contiunuar"
		echo "$fecha - $USER buscó el usuario $usuario." >> /root/respaldos/usuarios/usuario.txt
		read pause
	else 
		echo "El usuario no existe"
		echo "$fecha - $USER buscó el usuario $usuario, que no existe." >> /root/respaldos/usuarios/usuario.txt
		sleep 2
	fi
}

function listarUsuarios(){
	cut -d ":" -f1 /etc/passwd
	echo "Pulse enter para salir"
	echo "$fecha - $USER vió la lista de usuarios." >> /root/respaldos/usuarios/usuario.txt
	read pause
}

function modificarUsuarios(){
	read -p "Ingrese nombre del usuario a modificar: " nombre
	usuario=$(echo $nombre | tr [:upper:] [:lower:])
	existeUsuario=$(cat /etc/passwd | grep -c $usuario)
	if [ $existeUsuario -eq 1 ]; then
		clear
		echo "1) Modificar nombre del usuario"
		echo "2) Modificar home del usuario"
		echo "3) Agregar al usuario un nuevo grupo"
		echo "4) Cambiar grupo principal del usuario"
		echo "Seleccione una opcion: "
		read opcionMod
		clear
		if [ $opcionMod -eq 1 ]; then
			read -p "Ingrese nuevo nombre para el usuario: " nombreNuevo
			nuevoUsuario=$(echo $nombreNuevo | tr [:upper:] [:lower:])
			existeNuevoUsuario=$(cat /etc/passwd | grep -c $nombreNuevo)
			if [ $existeNuevoUsuario -eq 0 ]; then
				usermod -l $nombreNuevo $usuario
				echo "El cambio se ha completado con exito su nuevo nombre es "$nombreNuevo", presione eneter para continuar"
				echo "$fecha - $USER modificó el nombre de $usuario a $nombreNuevo." >> /root/respaldos/usuarios/usuario.txt
				read pause
			else
				echo "El nombre de usuario ingresado ya existe, presione enter para continuar"
				echo "$fecha - $USER intentó modificar el nombre de $usuario a $nombreNuevo, pero ese nombre ya existe." >> /root/respaldos/usuarios/usuario.txt
				read puase
			fi
		elif [ $opcionMod -eq 2 ]; then
			read -p "Ingrese nueva home para el usuario: " home
			if [ ! -d /home/$home ]; then
				usermod -d /home/$home -m $usuario
				echo "El home del usuario ha sido modificado, presione enter para continuar"
				echo "$fecha - $USER modificó la home del usuario $usuario, su nueva home es $home." >> /root/respaldos/usuarios/usuario.txt
				read pause
			else 
				echo "La home ingresada ya existe, presione enter para continuar"
				echo "$fecha - $USER intentó modificar la home del usuario $usuario a $home, pero ya existe." >> /root/respaldos/usuarios/usuario.txt
				read pause
			fi
		elif [ $opcionMod -eq 3 ]; then
		      read -p "Ingrese grupo al que sera agregado el usuario: " grupo
		      existeGrupo=$(cat /etc/group | grep -c $grupo)
		      if [ $existeGrupo -eq 1 ]; then
			      usermod -G $grupo $usuario
			      echo "El usuario ha sido modificado al nuevo grupo, presione enter para continuar"
				echo "$fecha - $USER agregó al usuario $usuario al grupo $grupo." >> /root/respaldos/usuarios/usuario.txt
			      read pause
		      else 
			     echo "El grupo ingresado no existe, presione enter para continuar"
				echo "$fecha - $USER intentó añadir al usuario $usuario al grupo $grupo, pero ese grupo no existe." >> /root/respaldos/usuarios/usuario.txt
			     read pause
		      fi
	      elif [ $opcionMod -eq 4 ]; then
		      read -p "Ingrese grupo el nuevo grupo principal del usuario: " grupo
		      existeGrupo=$(cat /etc/group | grep -c $grupo)
		      if [ $existeGrupo -eq 1 ]; then
			      usermod -g $grupo $usuario
			      echo "El usuario tiene un nuevo grupo principal, presione enter para continuar"
				echo "$fecha - $USER cambió el grupo principal del usuario $usuario, ahora es $grupo." >> /root/respaldos/usuarios/usuario.txt
			      read pause
		      else
			      echo "El grupo ingresado no existe, presione enter para continuar"
				echo "$fecha - $USER intentó cambiar el grupo principal del usuario $usuario, pero el grupo $grupo no existe." >> /root/respaldos/usuarios/usuario.txt
			      read pause
		      fi
	      else
		      echo "Opcion no valida, presione enter para continuar"
		      read pause
	fi
else 
	echo "EL usuario "$usuario" no existe, presione enter para continuar"
	echo "$fecha - $USER intentó modificar el usuario $usuario, pero no existe." >> /root/respaldos/usuarios/usuario.txt
	read pause
	fi
}

function bloqdesbloq() {

	read -p "Ingrese nombre del usuario al modifiar: " nombre
	usuario=$(echo $nombre | tr [:upper:] [:lower:])
	existeUsuario=$(cat /etc/passwd | grep -c $usuario)
	if [ $existeUsuario -eq 1 ]; then 
		clear 
		echo "1)Bloquear usuario"
		echo "2)Desbloquear usuario"
		read bloqueo
		if [ $bloqueo -eq 1 ]; then
			read -p "EL usuario "$usuario", sera bloqueado, desea continaur? S/N: " confirma
		if [ $confirma == 'S' ]; then
				usermod --lock $usuario
				echo "El usuario "$usuario" ha sido bloqueado, presione enter para continuar"
				echo "$fecha - $USER bloqueó al usuario $usuario." >> /root/respaldos/usuarios/usuario.txt
				read pause
			else 
				echo "Se ha cancelado la operacion, presione enter para continuar"
				read pause
			fi
		elif [ $bloqueo -eq 2 ]; then
			usermod --unlock $usuario
			echo "El usuario "$usuario", ha sido desbloqueado, presione enter para continuar"
			echo "$fecha - $USER desbloqueó al usuario $usuario." >> /root/respaldos/usuarios/usuario.txt
			read pause
		else 
			echo "Opcion no valida, presione enter para continuar"
		fi
	else 
		echo "EL usuario ingresado no existe, presione enter para continuar"
		echo "$fecha - $USER intentó bloquear/desbloquear al usuario $usuario, pero no existe." >> /root/respaldos/usuarios/usuario.txt
		read pause
	fi
}
##variables
opcion=0
year=$(date +%Y-%m-%d)
fecha=$(date +%Y-%m-%d-%H:%M:%S)
##MENU

while [ $opcion -lt 7 ];
do
	menu
read opcion
clear
case $opcion in
	1)
		echo "1) Crear usuario: ";
		altaUsuarios;;
	2)
		echo "2) Buscar usuario";
		buscarUsuarios;;
	3)
		echo "3) Eliminar usuario";
		eliminarUsuarios;;
	4)
		echo "4) Listar usuario";
		listarUsuarios;;
	5)
		echo "5) Modificar usuario";
		modificarUsuarios;;
	6)
		echo "6) Bloquear/Desbloquear usuario";
		bloqdesbloq;;
	7)
		echo "Hasta la proxima, nos vemos";
		sleep 2;
		break ;;
	*) 
		echo "Opcion invalida";
		sleep 2;;
	esac
done




