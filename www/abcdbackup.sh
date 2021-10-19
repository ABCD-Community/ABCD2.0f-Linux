#!/bin/bash
#Purpose = Backup of ABCD Database
#START
#TIME=`date +"%b-%d-%y"`
TIME=`date +"%a-%Y"`
FILENAME="backup-$TIME.tar.gz"
SRCDIR="/var/opt/ABCD/bases/"
DESDIR="/var/backups/abcd"
tar -cpzvf $DESDIR/$FILENAME $SRCDIR

#copying to dedicated folder on external server using stored key
sudo scp /var/backups/abcd/backup-$TIME.tar.gz user@my.ip.no.ip:/my/backupbolder/abcd

#END