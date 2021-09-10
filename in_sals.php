<?php
    if ($folder = opendir('../interface/SPI/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="SE"){
                    
                    $fh = fopen('../interface/SPI/From/'.$file,'r');
                    $linecount=0;
                    $linecount1=0;
                    $linecountgagal=0;
                    $countSales=0;
                    $countSalesupd=0;

                    $cn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_salestraxSPI");
                    $sqlTrc = "TRUNCATE mst_sales_person";
                    $execTrc = mysqli_query($cn,$sqlTrc);

                    while ($line = fgets($fh)) {
                        if(strlen($line)>40){
                            $kunnr = substr($line,0,10);
                            $spart = substr($line,10,2);
                            $pernr = substr($line,12,8);
                            $sname = substr($line,20,30);

                            $sql1 = "INSERT INTO mst_sales_person(kunnr,spart,pernr,sname)
                                values ('$kunnr','$spart','$pernr','$sname')";
                            $result2 = mysqli_query($cn,$sql1);
                            if ($result2) {
                                $linecount1++;
                            }
                        }
                    }

                    if(!$linecount1 == 0){
                        echo "success";
                        
                        $sebelum = "../interface/SPI/From/".$file;
                        $sesudah = "../interface/SPI/Backup/".$file;
                        echo copy($sebelum, $sesudah);

                        if (!copy($sebelum, $sesudah)) {
                            echo " File gagal dipindahkan ke folder backup";
                        }else{
                            echo " File sukses dipindahkan di folder backup";
                            unlink($sebelum);
                        }
                    }else{
                        echo "Gagal";
                    }
                    fclose($fh);
                }
            }
        }
        closedir($folder);
    }
?>