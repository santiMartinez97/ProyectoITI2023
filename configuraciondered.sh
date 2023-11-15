#!/bin/bash
#

opc=0
function menu(){

        echo "1 - Ver configuracion de la red "
        echo "2 - Editar archivo de configuracion de la red"
        echo "3 - Ver direccion de IP por defecto"
        echo "4 - Asignar direccion de IP"
        echo "5 - Eliminar direccion de IP"
        echo "6 - Cambiar el gateway"
        echo "7 - Ver estadisticas de la red"
        echo "8 - Ver usuarios conectados al servidor"
        echo "0 - Expulsar usuario conectado al servidor"
        echo "9 - Salir"
        echo "Ingrese una opcion: "
}

while [ $opc -ne 9 ]; 
do
clear
menu
echo "$fecha - $USER Ejecuto el script de configuracion de red ." >> /root/logs/configuracionRed.txt;
read opc
clear
        case $opc in
                1)ip addr show ;
		echo "$fecha - $USER Vio la configuracion de red." >> /root/logs/configuracionRed.txt;;
                2)echo "Ingrese nombre del archivo de tarjeta que va a configurar con el .txt incluido"
                        read tarjeta3
			echo "$fecha - $USER Edito el archivo de configuracion de $tarjeta3 ." >> /root/logs/configuracionRed.txt;
                        vim "/etc/sysconfig/network-scripts/ifcfg-$tarjeta3";;
                3)ip addr show | grep -oP '^\d+: \K[^:]+|inet \K[\d.]+';
			echo "Pulse ENTER para volver.";
			echo "$fecha - $USER Vio la ip por defecto ." >> /root/logs/configuracionRed.txt;
			read pause;;
                4)echo "Ingrese direccion de ip incluyendo mascara";
                        read ip;
                        sleep 1;
                        echo "Ingrese tarjeta a que le colocara la ip";
                        read tarjeta;
			ip addr add $ip dev $tarjeta;
			echo "Tarea finalizada. Pulse ENTER para volver.";
			echo "$fecha - $USER Asigno una direccion de ip '$ip' a la tarjeta '$tarjeta'." >> /root/logs/configuracionRed.txt;
			read pause;;
                5)echo "Ingrese direccion de ip incluyendo mascara";
                        read ip2;
                        sleep 1;
                        echo "Ingrese tarjeta que eliminara la ip";
                        read tarjeta2;
                	ip addr del $ip2 dev $tarjeta2;
			echo "Tarea finalizada. Pulse ENTER para volver.";
			echo "$fecha - $USER Elimino la ip '$ip2' de la tarjeta '$tarjeta2' ." >> /root/logs/configuracionRed.txt;
			read pause;;
                6)echo "Ingrese nueva ip";
                        read ip3;
                        ip route add default via $ip3;
			echo "Tarea finalizada. Pulse ENTER para volver.";
			echo "$fecha - $USER Cambio el gateway a '$ip3'." >> /root/logs/configuracionRed.txt;
			read pause;;
                7)ip -s link;
			echo "Pulse ENTER para volver.";
			echo "$fecha - $USER Vio la estadistica de ip ." >> /root/logs/configuracionRed.txt;
			read pause;;
                8)w;
			echo "Pulse ENTER para volver.";
			echo "$fecha - $USER Vio los usuarios conectados a la ip." >> /root/logs/configuracionRed.txt;
			read pause;;
                0)echo "Ingrese nombre del usuario que desea expulsar";
                        read usuario;
                        pkill -u $usuario;
			echo "Tarea finalizada. Pulse ENTER para volver.";
			echo "$fecha - $USER Expulso de la red al usuario '$usuario'." >> /root/logs/configuracionRed.txt;
			read pause;;
                9)echo "Hasta la proxima";;
                *)echo "Opcion incorecta. Pulse ENTER para volver.";
			opc=0;
			echo "$fecha - $USER Se equivoco al ingresar una opcion en la ejecucion del script." >> /root/logs/configuracionRed.txt;
			read pause;;
        esac
done


