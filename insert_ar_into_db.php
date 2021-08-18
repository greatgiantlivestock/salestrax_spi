<?php
    if ($folder = opendir('../interface/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="AR"){
                    $fh = fopen('../interface/From/'.$file,'r');
                    $linecount=0;

                    $cn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_do_gantung");
                    $sq = "TRUNCATE TABLE ar_performance";
                    $rs = mysqli_query($cn,$sq);

                    while ($line = fgets($fh)) {
                        if(strlen($line)>111){
                            $KUNNR = substr($line,0,10);
                            $NAME1 = substr($line,10,40);
                            $NEWNAME1 = str_replace("'", "", $NAME1);
                            $ZOUNR = substr($line,50,10);
                            $BELNR = substr($line,60,10);
                            $GJAHR = substr($line,70,4);
                            $BUDAT = substr($line,74,8);
                            $XBLNR = substr($line,82,10);
                            $BLART = substr($line,92,2);
                            $WRBTR = substr($line,94,10);
                            $ZTERM = substr($line,104,4);
                            $ZBD1T = substr($line,108,3);
                            $KWINO = substr($line,111,13);
                            $FKTKR = substr($line,124,8);
                            $NOTRM = substr($line,132,20);
                            $NEWNOTRM = str_replace("'", "", $NOTRM);
                            $DATBR = substr($line,152,8);
                            $DUDAT = substr($line,160,8);
                            $REF = substr($line,168,20);
                            $FLAG1 = substr($line,188,1);
                            $date_update = date("d M Y h:i a");

                            // $VBELN = substr($line,0,10);
                            // $POSNR = substr($line,10,6);
                            // $LFDAT = substr($line,16,8);
                            // $WADAT = substr($line,24,8);
                            // $BLDAT = substr($line,24,8);
                            // $VSTEL = substr($line,32,4);
                            // $VTEXT = substr($line,36,35);
                            // $KUNNR = substr($line,71,10);
                            // $NAME = substr($line,81,40);
                            // $KUNAG = substr($line,121,10);
                            // $NAME1 = substr($line,131,40);
                            // $MATNR = substr($line,171,13);
                            // $ARKTX = substr($line,184,35);
                            // $LFIMG = substr($line,219,8).".".substr($line,227,2);
                            // $MEINS = substr($line,229,5);
                            // $STATS = substr($line,234,1);

                            $conn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_do_gantung");
                            $sql = "INSERT INTO ar_performance(KUNNR,NAME1,ZOUNR,BELNR,GJAHR,BUDAT,XBLNR,BLART,WRBTR,ZTERM,ZBD1T,KWINO,FKTKR,NOTRM,DATBR,DUDAT,REF,FLAG,date_update)
                                    values ('$KUNNR','$NEWNAME1','$ZOUNR','$BELNR','$GJAHR','$BUDAT','$XBLNR','$BLART','$WRBTR','$ZTERM','$ZBD1T','$KWINO','$FKTKR','$NEWNOTRM','$DATBR','$DUDAT','$REF','$FLAG1','$date_update')";
                            $result = mysqli_query($conn,$sql);
                            if ($result) {
                                $linecount++;
                            }   
                        }
                        
                    }

                    if(!$linecount==0){
                        $sebelum = "../interface/From/".$file;
                        $sesudah = "../interface/Backup/".$file;
                        echo copy($sebelum, $sesudah);

                        if (!copy($sebelum, $sesudah)) {
                            echo "Failed to copy";
                        }else{
                            echo "Copied sukses";
                            unlink($sebelum);
                        }
                        include "push_notification_ar.php";
                    }
                    fclose($fh);
                }
            }
        }
        closedir($folder);
    }
?>