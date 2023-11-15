#!/bin/bash
#VARIABLES
opc=0
fecha=$(date +%Y-$m-%d %H:%M:%S)
#FUNCIONES

function menuPrincipal(){
        echo "MENU PRINCIPAL DE FIREWALLS" 
        echo "1) Menu firewall de puertos"
        echo "2) Menu firewall de redes"
        echo "3) Salir"
        echo "Seleccione una opcion: "
}


function menuFirewallPuertos() {
        echo "MENU DE PUEROTS"
        echo "1 - Ver estado del firewall"
        echo "2 - Preguntar estado de un puerto espesifico"
        echo "3 - Habilitar puerto 3306"
        echo "4 - Habilitar puerto 80"
        echo "5 - Habilitar puerto 443"
        echo "6 - Habilitar puerto 22"
        echo "7 - Habilitar puerto personalizado"
		echo "0 - Salir"
		echo "Seleccione una opcion: "
	}

	function menuFirewallRedes(){
		echo "1 - Ver estado del firewall"
        echo "2 - Bloquear direccion de ip"
        echo "3 - Prevenir ataque DDoS"
        echo "4 - Bloquear el trafico de una direccion de MAC"
        echo "5 - Permitir el trafico a traves de una tarjeta de red"
        echo "0 - Salir"
        echo "Seleccione una opcion: "
}


while [ $opc -lt 3 ];
do

menuPrincipal
echo "$fecha Usurio:$USER ejecuto el menu de firewall " >> /root/logs/firewall.txt;;
read opc
clear
        case $opc in
                1) menuFirewallPuertos;
                        read opc;
                        clear;
                        case $opc in
                        1) echo "Ver estado del firewall";
                                firewall-cmd --zone=public --list-all;
			   echo "$fecha Usurio:$USER miró el estado del firewall " >> /root/logs/firewall.txt;;
                        2) read -p "Ingrese puerto que desea ver el estado" est;
			   echo  "$fecha $USER  ingreso un puerto para ver el estado $est" >> /root/logs/firewallP.txt;;
                        3)firewall-cmd --zone=public --add-port=3306/tcp --permanent;
                                firewall-cmd --reload;
                                echo "Puerto correctamente habilitado";
				echo "$fecha Usuario:$USER habilitó correctamente el puerto 3306" >> /root/logs/firewalllP.txt;;
                        4)firewall-cmd --zone=public --add-port=80/tcp --permanent;
                                echo "Puerto correctamente habilitado";
				echo "$fecha Usuario: $USER habilitó correctamente el puerto 80" >> /root/logs/firewallP.txt;
                                firewall-cmd --reload;;
                        5)firewall-cmd --zone=public --add-port=443/tcp --permanent;
                                echo "Puerto correctamente habilitado";
				echo "$fecha Usuario: $USER habiltó correctamente el puerto 443" >> /root/logs/firewallP.txt;l
                                firewall-cmd --reload;;
                        6)firewall-cmd --zone=public --add-port=22/tcp --permanent;
                                echo "Puerto correctamente habilitado";
				echo "$fecha Usuario: $USER habilitó correctamente el puerto 22" >> /root/logs/firewallP.txt;
                                firewall-cmd --reload;;
                        7)read -p "Ingrese numero del puerto que desea personalizar" num;
                        firewall-cmd --zone=public --add-port=$num/tcp --permanent;
                                echo "Puerto correctamente habilitado";
				echo "$fecha Usuario: $USER personalizo el puerto $num" >> /root/logs/firewallP.txt;
                                firewall-cmd --reload;;
                        *)echo "Opcion incorrecta";
                                break;;

                esac;;

                2) menuFirewallRedes;
                        read opc;
                        clear;
                        case $opc in
                        1) echo "Ver estado del firewall";
                                firewall-cmd --zone=public --list-all;
				echo "$fecha Usuario: $USER vio el estado " >> /root/logs/firewallR.txt;;
                        2)read -p "Ingrese ip que desea bloquer" ip;
                                iptables -A OUTPUT -d $ip -j drop;
				echo "$fecha Usuario: $USER bloqueo la ip $ip " >> /root/logs/firewallR.txt;;
                        3)iptables -A INPUT -p tcp --dport 80 -m limit --limit 25/minute --limit-burst 100 -j ACCEPT;
                                echo "Comando completado";
				echo "$fecha Usuario: $USER previno un ataque Ddos " >> /root/logs/firewallR.txt;;
                        4)iptables -A INPUT -m mac --mac-source 00:0F:EA:91:04:08 -j DROP;
                               echo "Comando completado";
			       echo "$fecha Usuario: $USER bloqueo el trafico de una direccion mac " >> /root/logs/firewallR.txt;;
                        5) iptables -A FORWARD -i eth0 -o eth1 -j ACCEPT;
                               echo "Comando completado";
			       echo "$fecha Usuario: $USUER permitio el trafico a traves de una tarjeta de red ";;
                        *) echo "Opcion incorrecta";
                                break;;

                esac;;
                3) echo "Hasta la proxima";
		   echo "$fecha Usurio:$USER salio del menu de firewall " >> /root/logs/firewall.txt;;
                *) echo "Opcion incorrecta";
		       echo "$fecha Usurio:$USER ejecuto el menu del firewall, y no selecciono ninguna opcion correcta " >> /root/logs/firewall.txt;
		       	break;;
esac
done



