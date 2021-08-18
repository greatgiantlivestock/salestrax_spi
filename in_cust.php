<?php
    if ($folder = opendir('../interface/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="MC"){
                    
                    $fh = fopen('../interface/From/'.$file,'r');
                    $linecount=0;
                    $linecount1=0;
                    $linecountgagal=0;
                    $countSales=0;
                    $countSalesupd=0;

                    $cn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_sales_2021");

                    while ($line = fgets($fh)) {
                        if(strlen($line)>170){
                            $kode = substr($line,0,10);
                            $nama = substr($line,10,35);
                            $nama1 = str_replace("'", " ", $nama);
                            $alamat = substr($line,45,60);
                            $alamat1 = str_replace("'", " ", $alamat);
                            $city = substr($line,105,40);
                            $city1 = str_replace("'", " ", $city);
                            $region = substr($line,145,3);
                            $region1 = str_replace("'", " ", $region);
                            $regiondesc = substr($line,148,20);
                            $regiondesc1 = str_replace("'", " ", $regiondesc);
                            $salesoffice = substr($line,168,4);
                            $salesoffice1 = str_replace("'", " ", $salesoffice);
                            $salesofficedesc = substr($line,172,20);
                            $salesofficedesc1 = str_replace("'", " ", $salesofficedesc);
                            
                            $id_status_customer = 2;
                            
                            // $cekjmlSpers1 = "SELECT count(*) as jml FROM sales_person WHERE pers_numb='$pers_numb1'";
                            // $countjmlSpers1 = mysqli_query($cn,$cekjmlSpers1);
                            // $rowS1 = mysqli_fetch_assoc($countjmlSpers1);
                            // $jmlS1 = $rowS1['jml']; 
                            
                            // if($jmlS1 > 0){
                            //     $sqlS = "UPDATE sales_person SET sales_pers='$sales_pers11' WHERE pers_numb='$pers_numb1'";
                            //     $result1 = mysqli_query($cn,$sqlS);
                            //     $countSalesupd++;
                            // }else if($jmlS1 == 0){
                            //     $sqlS1 = "INSERT INTO sales_person(pers_numb,sales_pers) values ('$pers_numb1','$sales_pers11')";
                            //     $result11 = mysqli_query($cn,$sqlS1);
                            //     $countSales++;
                            // }

                            $cekjml = "SELECT count(*) as jml FROM mst_customer WHERE kode_customer='$kode'";
                            $countjml = mysqli_query($cn,$cekjml);
                            $row = mysqli_fetch_assoc($countjml);
                            $jml = $row['jml']; 
                            echo $jml;

                            if($jml == 0){
                                $sql1 = "INSERT INTO mst_customer(kode_customer,nama_customer,city,region,alamat,region_desc,sales_office,sales_office_desc)
                                    values ('$kode','$nama1','$city1','$region1','$alamat1','$regiondesc1','$salesoffice1','$salesofficedesc1')";
                                $result2 = mysqli_query($cn,$sql1);
                                if ($result2) {
                                    $linecount1++;
                                }
                            }else if($jml > 0){
                                $sql = "UPDATE mst_customer SET 
                                    kode_customer='$kode_customer',
                                    nama_customer='$nama_customer1',
                                    city='$city1',
                                    region='$region1',
                                    alamat='$alamat1',
                                    region_desc='$region_desc1',
                                    sales_office='$sales_office1',
                                    sales_office_desc='$sales_office_desc1' WHERE kode_customer='$kode_customer'";
                                $result = mysqli_query($cn,$sql);
                                if ($result) {
                                    $linecount++;
                                }
                            }else {
                                echo "ada yang gagal";
                                $linecountgagal++;
                            }   
                        }
                    }

                    if(!$linecount == 0 || !$linecount1 == 0){
                        echo "success";
                        
                        $sebelum = "../interface/From/".$file;
                        $sesudah = "../interface/Backup/".$file;
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