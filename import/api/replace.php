<?php 
 
 
//İçerik alanı 
	$query = "SELECT * from haber  where uid=0 and haberonay=1 order by tarih limit 2328,100";
	$result = mysql_query($query);		
	if ($result) {		
		echo "here*******************"; exit;
		if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
				print_r( $row); exit;
				$url=replaceSpace($row['baslik']);
				
				$metin = $row['resimurl'];
				$metin = explode($metin,'/');				
				$url=$row['resimurl'];
				$a=explode('/',$url);
				echo $a;
			}
		}
	}
	
 