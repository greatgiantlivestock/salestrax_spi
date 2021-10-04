<?php
    if ($folder = opendir('../interface/SPI/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="MM"){
                    $fh = fopen('../interface/SPI/From/'.$file,'r');
                    $linecount=0;
                    $linecount1=0;
                    $linecountgagal=0;

                    while ($line = fgets($fh)) {
                        if(strlen($line)>60) {
                            $cn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_salestraxSPI_dev");
                            $kode = substr($line,0,15);
                            $nama = substr($line,15,40);
                            $satuan = substr($line,55,3);
                            $division = substr($line,58,2);
                            $division_desc = substr($line,60,20);
                            $sales_unit = substr($line,80,3);
                            $qty_order = substr($line,83,89);
                            $id_satuan = 0;
                            $id_plant = 0;
                            
                            $cekjml = "SELECT count(*) as jml FROM mst_product WHERE kode_product='$kode'";
                            $countjml = mysqli_query($cn,$cekjml);
                            $row = mysqli_fetch_assoc($countjml);
                            $jml = $row['jml'];
                            if($jml == 0){
                                $sql = "INSERT INTO mst_product(kode_product,nama_product,id_satuan,id_plant_group,satuan,division,division_desc,sales_unit,qty_order)
                                        values ('$kode','$nama','$id_satuan','$id_plant','$satuan','$division','$division_desc','$sales_unit','$qty_order')";
                                $result1 = mysqli_query($cn,$sql);
                                if ($result1) {
                                    $linecount1++;
                                } 
                            }else if ($jml > 0){
                                $sql1 = "UPDATE mst_product SET nama_product='$nama',id_satuan='$id_satuan',id_plant_group='$id_plant',satuan='$satuan',division='$division',division_desc='$division_desc',sales_unit='$sales_unit',qty_order='$qty_order' WHERE kode_product='$kode'";
                                $result = mysqli_query($cn,$sql1);
                                if ($result) {
                                    $linecount++;
                                } 
                            }else{
                                echo "ada yang gagal";
                                $linecountgagal++;
                            }  
                        } 
                    }

                    if(!$linecount1==0 || !$linecount==0){
                        echo "success";
                        $sebelum = "../interface/SPI/From/".$file;
                        $sesudah = "../interface/SPI/Backup/".$file;
                        echo copy($sebelum, $sesudah);

                        if (!copy($sebelum, $sesudah)) {
                            echo " File gagal dipindahkan di folder backup";
                        }else{
                            unlink($sebelum);
                            echo " File berhasil dipindahkan ke folder backup.";
                        }
                    }
                    fclose($fh);
                }
            }
        }
        closedir($folder);
    }
?>