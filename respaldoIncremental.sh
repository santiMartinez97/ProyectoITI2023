mysqldump --opt --events --routines --triggers --default-character-set=utf8 -u root -proot sisviansa > sisviansa.sql
mv sisviansa.sql /home/usuario/Desktop/respaldosCompletos/
rsync -av -e "ssh -p 22" /home/usuario/Desktop/respaldosCompletos/sisviansa.sql BACKUP@192.168.1.21:/usuario/Desktop/

