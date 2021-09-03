<?php
    if ($folder = opendir('../interface/SPI/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="TF"){
                    $fh = fopen('../interface/SPI/From/'.$file,'r');
                    $linecount=0;

                    $cn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_do_gantung");
                    $sq = "TRUNCATE TABLE tukar_faktur_pending";
                    $rs = mysqli_query($cn,$sq);

                    while ($line = fgets($fh)) {
                        if(strlen($line)>229){
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
                            $VBELN = substr($line,0,10);
                            $POSNR = substr($line,10,6);
                            $LFDAT = substr($line,16,8);
                            $WADAT = substr($line,24,8);
                            $BLDAT = substr($line,24,8);
                            $VSTEL = substr($line,32,4);
                            $VTEXT = substr($line,36,35);
                            $KUNNR = substr($line,71,10);
                            $NAME = substr($line,81,40);
                            $NEWNAME = str_replace("'", "", $NAME);
                            $KUNAG = substr($line,121,10);
                            $NAME1 = substr($line,131,40);
                            $NEWNAME1 = str_replace("'", "", $NAME1);
                            $MATNR = substr($line,171,13);
                            $ARKTX = substr($line,184,40);
                            $LFIMG = substr($line,224,8).".".substr($line,232,2);
                            $MEINS = substr($line,234,5);
                            $VBELN_INV = substr($line,239,10);
                            $FKDAT_INV = substr($line,249,8);
                            $STATS = substr($line,257,1);
                            $date_update = date("d M Y h:i a");
                            $edat = substr($line,258,8);
                    

                            $conn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_do_gantung");
                            $sql = "INSERT INTO tukar_faktur_pending(VBELN,POSNR,LFDAT,WADAT_IST,BLDAT,VSTEL,VTEXT,KUNNR,NAME,KUNAG,NAME1,MATNR,ARKTX,LFIMG,MEINS,VBELN_INV,FKDAT_INV,STATS,date_update,EDAT)
                                    values ('$VBELN','$POSNR','$LFDAT','$WADAT','$BLDAT','$VSTEL','$VTEXT','$KUNNR','$NEWNAME','$KUNAG','$NEWNAME1','$MATNR','$ARKTX','$LFIMG','$MEINS','$VBELN_INV','$FKDAT_INV','$STATS','$date_update','$edat')";
                            $result = mysqli_query($conn,$sql);
                            if ($result) {
                                $linecount++;
                            }   
                        }
                        
                    }

                    if(!$linecount==0){
                        $sebelum = "../interface/SPI/From/".$file;
                        $sesudah = "../interface/SPI/Backup/".$file;
                        echo copy($sebelum, $sesudah);

                        if (!copy($sebelum, $sesudah)) {
                            echo "Failed to copy";
                        }else{
                            echo "Copied sukses";
                            unlink($sebelum);
                        }
                        include "push_notification_tf.php";
                    }
                    fclose($fh);
                }
            }
        }
        closedir($folder);
    }
?>