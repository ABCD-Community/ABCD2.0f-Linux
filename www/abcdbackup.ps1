$bkpdate = Get-Date -Format "MM/dd/yyyy HH:mm"
$FILENAME = "backup_$bkpdate.zip"
$SRCDIR = \ABCD\www\bases\marc\
$DESDIR = \backups\ABCD\
Start-Process zip $DESDIR/$FILENAME $SRCDIR
#scp /var/backups/abcd/backup-$TIME.tar.gz user@my.ip.no.ip:/my/backupbolder/abcd