<!DOCTYPE html>
<html>
<head>
  <title>Print Barcode</title>
</head>
<body>





</body>
</html>



<?php  
$addr = '\\\\179.15.30.2\\EPSON M100 Series';
print($addr);
$printer = printer_open($addr);   
printer_start_doc($printer, "My Document");
printer_start_page($printer);
$font = printer_create_font("Arial", 72, 48, 400, false, false, false, 0);
printer_select_font($printer, $font);
printer_draw_text($printer, 'the text that will be printed', 100, 100);
printer_delete_font($font);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
?>

