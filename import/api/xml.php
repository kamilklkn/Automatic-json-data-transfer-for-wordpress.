<?php 

/**
 * @company:Kamilklkn
 * @link:http://kamilklkn.com
 * @editBy:Kamil Kalkan
 * @date:01/12/2015
 */

/*
* Function Create Url
* @string
*/
function replaceSpace($string){
	$baslik = str_replace(array("&quot;","&#39;"), NULL, $string);
	$bul = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '-');
	$yap = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', ' ');
	$string = strtolower(str_replace($bul, $yap, $baslik));
	$string = preg_replace("@[^A-Za-z0-9\-_]@i", ' ', $string);
	$string = trim(preg_replace('/\s+/',' ', $string));
	$string = str_replace(' ', '-', $string);
	$string = preg_replace("/\s+/", " ", $string);
	$string = preg_replace("/\"+/", " ", $string);
	$string = trim($string);
   return $string;
}	
//Veritabanı bağlantılarını yapıyoruz

include("../include/constant.php");
require_once '../include/db_connect.php';
$db = new DB_CONNECT(); 


//Header alanı
$doc = new DOMDocument( );
header("Content-Type: text/xml;charset=UTF-8");  
$xml_output = '<?xml version="1.0" encoding="UTF-8"?>';  
$xml_output .= '<rss version="2.0"
xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:wp="http://wordpress.org/export/1.2/"
><channel><title>kamilklkn.com</title><link>http://kamilklkn.com</link><description>Sanat ve sanatçı.</description><pubDate>Tue, 13 Oct 2015 12:19:04 +0000</pubDate><language>tr-TR</language><wp:wxr_version>1.2</wp:wxr_version><wp:base_site_url>http:kamilklkn.com</wp:base_site_url><wp:base_blog_url>kamilklkn.com</wp:base_blog_url>';

//Site admin bilgileri
$xml_output .= '<wp:author>'; 
	$xml_output .= '<wp:author_id>'.'1';
		$xml_output .= '</wp:author_id>';
	$xml_output .= '<wp:author_login>'.'kamilklkn';
		$xml_output .= '</wp:author_login>';
	$xml_output .= '<wp:author_email>'.'zktasarim@gmail.com';
		$xml_output .= '</wp:author_email>';
	$xml_output .= '<wp:author_display_name>';
		$xml_output .= '<![CDATA[ kamilklkn ]]>';
	$xml_output .= '</wp:author_display_name>';
	$xml_output .= '<wp:author_first_name>';
		$xml_output .= '<![CDATA[ ]]>';
	$xml_output .= '</wp:author_first_name>';
	$xml_output .= '<wp:author_last_name>';
		$xml_output .= '<![CDATA[ ]]>';
	$xml_output .= '</wp:author_last_name>';
$xml_output .= '</wp:author>'; 

//Site versiyon bilgisi
$xml_output .= '<generator>';
	$xml_output .= 'http://wordpress.org/?v=4.3.1';
$xml_output .= '</generator>';



//İçerik alanı 
	$query = "SELECT * from haber  where uid=0 and haberonay=1 order by tarih limit 2328,100";
	$result = mysql_query($query);		
	if ($result) {		
		// echo "here*******************";
		$imgcount=18589;
		$row_w=0;
		if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
				//print_r( $row); exit;
				$url=replaceSpace($row['baslik']);
				$xml_output .= '<item>';
					// Haber başlık				
					$xml_output .= '<title>';  
						$xml_output .= $row['baslik'];						
					$xml_output .= '</title>';
					//Haber link
					$xml_output .= '<link>';  
						$xml_output .='http://kamilklkn.com'.$url;						
					$xml_output .= '</link>'; 
					//Haber tarih
					$xml_output .= '<pubDate>';  
						$xml_output .=date("m/d/y g:i A", strtotime($row['tarih']));						
					$xml_output .= '</pubDate>';
					/*
					* Haber yazar getir başla
					*/
					$query = "SELECT `editor` FROM haber_editorluk WHERE UID=(SELECT UID FROM haber WHERE ID='".$row['ID']."' )";
					//echo $query;
				
					$result2 = mysql_query($query);	
					if ($result2) {		
					$countthis = mysql_num_rows($result2);
						if ($countthis > 0) {
							while ($row2 = mysql_fetch_array($result2) ) {
								$xml_output .= '<dc:creator>';  
									$xml_output .='<![CDATA['.$row2['editor'].']]>';										
								$xml_output .= '</dc:creator>';	
								}
						}else{							
							$xml_output .= '<dc:creator>';  
								$xml_output .='<![CDATA[ evetbenim ]]>';						
							$xml_output .= '</dc:creator>';							
						}
					}
					/*
					* Haber yazar getir Son
					*/
					$xml_output .= '<guid isPermaLink="false">';  
						$xml_output .='http://kamilklkn.com'.$url;						
					$xml_output .= '</guid>';	
					$xml_output .= '<description>';	
					$xml_output .= '</description>';	
					
					//İçerik
					$xml_output .= '<content:encoded>';	
						$xml_output .= '<![CDATA[';						
							$xml_output .= $row['haber'];						
						$xml_output .= ']]>';	
					$xml_output .= '</content:encoded>';
					
					$xml_output .= '<excerpt:encoded>';	
						$xml_output .= '<![CDATA[ ]]>';	
					$xml_output .= '</excerpt:encoded>';	
					
					//Haber id
					$xml_output .= '<wp:post_id>';	
						$xml_output .=$row['ID'];	
					$xml_output .= '</wp:post_id>';	
					
					//Haber tarih saat
					$xml_output .= '<wp:post_date>';	
						$xml_output .=date("m/d/y g:i A", strtotime($row['tarih']));	
					$xml_output .= '</wp:post_date>';
					
					//Haber tarih
					$xml_output .= '<wp:post_date_gmt>';	
						$xml_output .=gmdate("m/d/y g:i A", strtotime($row['tarih']));	
					$xml_output .= '</wp:post_date_gmt>';					
					
					
					//Haber yorum status
					$xml_output .= '<wp:comment_status>';	
						$xml_output .='open';	
					$xml_output .= '</wp:comment_status>';	
					
					//Haber yorum status
					$xml_output .= '<wp:ping_status>';	
						$xml_output .='open';	
					$xml_output .= '</wp:ping_status>';	
					
					//Haber başlık
					$xml_output .= '<wp:post_name>';	
						$xml_output .=$row['baslik'];	
					$xml_output .= '</wp:post_name>';
					
					//Haber paylaşım status
					$xml_output .= '<wp:status>';	
						$xml_output .='publish';	
					$xml_output .= '</wp:status>';	
					
					
					$xml_output .= '<wp:post_parent>';	
						$xml_output .='0';	
					$xml_output .= '</wp:post_parent>';
					
					//Haber paylaşım status
					$xml_output .= '<wp:menu_order>';	
						$xml_output .='0';	
					$xml_output .= '</wp:menu_order>';		
					
					//Post status
					$xml_output .= '<wp:post_type>';	
						$xml_output .='post';	
					$xml_output .= '</wp:post_type>';
					
					//Post status
					$xml_output .= '<wp:post_password>';	
						// $xml_output .='';	
					$xml_output .= '</wp:post_password>';
					
					//Post status
					$xml_output .= '<wp:is_sticky>';	
						$xml_output .='0';	
					$xml_output .= '</wp:is_sticky>';
					
					//Post kategori
					$query = "SELECT kategoriadi FROM `haber_kategori` WHERE `KATID`=(SELECT KATID FROM `haber` WHERE `ID`='".$row['ID']."' )";
					$result3 = mysql_query($query);	
					if ($result3) {		
					$countthis = mysql_num_rows($result3);
						if ($countthis > 0) {
							while ($row3 = mysql_fetch_array($result3) ) {
								$xml_output .= '<category domain="category" nicename='.'"'.$row3['kategoriadi'].'">';
									$xml_output .= '<![CDATA['.$row3['kategoriadi'].']]>';								
								$xml_output .= '</category>';
							}
						}
					}
					
					/* 
					* Post tag başla
					*/
					
					$yenimetin = explode(',',$row['keywords']);
					foreach($yenimetin as $Tag){
						$xml_output .= '<category domain="post_tag" nicename='.'"'.$Tag.'">';
							$xml_output .= '<![CDATA['.$Tag.']]>';								
						$xml_output .= '</category>';
					}
					/* 
					* Post tag başla son
					*/
				
				//Şablon değeri
				/*$xml_output .= '<wp:postmeta>';
					$xml_output .= '<wp:meta_key>';
						$xml_output .= 'slide_template';						
					$xml_output .= '</wp:meta_key>';
					
					$xml_output .= '<wp:meta_value>';
						$xml_output .= '<![CDATA[';
						$xml_output .= 'default';
						$xml_output .= ']]>';
					$xml_output .= '</wp:meta_value>';			
				$xml_output .= '</wp:postmeta>';*/
				
				//Seo Başlık
				/*$xml_output .= '<wp:postmeta>';
					$xml_output .= '<wp:meta_key>';
						$xml_output .= '_yoast_wpseo_title';						
					$xml_output .= '</wp:meta_key>';
					
					$xml_output .= '<wp:meta_value>';
						$xml_output .= '<![CDATA[';
						$xml_output .= $row['baslik'];
						$xml_output .= ']]>';
					$xml_output .= '</wp:meta_value>';			
				$xml_output .= '</wp:postmeta>';*/

				//Seo açıklama
					/*$xml_output .= '<wp:postmeta>';
					$xml_output .= '<wp:meta_key>';
						$xml_output .= '_yoast_wpseo_metadesc';						
					$xml_output .= '</wp:meta_key>';
					
					$xml_output .= '<wp:meta_value>';
						$xml_output .= '<![CDATA[';
						$xml_output .= $row['kisahaber'];
						$xml_output .= ']]>';
					$xml_output .= '</wp:meta_value>';			
				$xml_output .= '</wp:postmeta>';*/
				
				



								// $metin = $row['resimurl'];
								// $metin = explode($metin,'/');

								//$xml_output .= '2015/10/notepad.jpg';
								//$xml_output .=$row['resimurl'];
								$url=$row['resimurl'];
								
								
								//$a=explode('/',$url);
								if(strlen($url)>0){
									$xml_img = str_replace("http://kamilklkn.com", "", $url);
									$xml_img='http://kamilklkn.com'.$xml_img; //Başka sunucudan veya başka adresten çekecekseniz adresini buraya yazın.
								
									//$s=count($a)-1;
									//$xml_img ='/content/uploads/14/'.$a[$s];
								}else{
								
									$url=$row['resim'];
									if (strlen($url)>0) {
										$xml_img='http://kamilklkn.com/content/uploads/14/haber/'.$url;
									}
									else {
										$xml_img='http://kamilklkn.com/content/uploads/14/Image/default.jpg';
									}
									//echo "hata";
									
								}
								
									// echo '<pre>'.count($a);
									// print_r($a);					
				
					//_thumbnail_id açıklama
						$xml_output .= '<wp:postmeta>';
						$xml_output .= '<wp:meta_key>';
							$xml_output .= '_thumbnail_id';						
						$xml_output .= '</wp:meta_key>';
						
						$xml_output .= '<wp:meta_value>';
							$xml_output .= '<![CDATA[';
							// $xml_output .=  $row['resimurl'];
							//$xml_output .=  'http://img108.imagetwist.com/i/08578/mg2y778t1de9.jpeg';
							$xml_output .=  $xml_img;
							$xml_output .= ']]>';
						$xml_output .= '</wp:meta_value>';			
					$xml_output .= '</wp:postmeta>';
				$xml_output .= '</item>';
				
								
				$row_w=$row_w+1;
			}
		}
	}
	



$xml_output .= '</channel>';  
$xml_output .= '</rss>';  
   

echo $xml_output;
// echo $row_w;
$doc->save('a.xml'); 
 