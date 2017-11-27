<?php
									/* Connect database */
									
                                    include 'db_connect.php';
									
									$value = $_GET['subject'];
									// $query2 = $MySQLi_CON->query2("SELECT * FROM subject WHERE id = '" . $value . "'");
									// if($query->num_rows > 0){
											// while($sessionRow2 = $query->fetch_assoc()){
												 
													 
											// }
										// }
									
									$subjectSession = $MySQLi_CON->real_escape_string(trim($_GET["subject"]));
                                    
									if (isset($_GET['subject'])){
										/* Run query */
										$query = $MySQLi_CON->query("SELECT * FROM subject");
										$i = 0;
										
										if($query->num_rows > 0){
											while($sessionRow = $query->fetch_assoc()){
												$session = $sessionRow['subject_session'];
												if($session == $value){
													
													echo '<option value="'.$sessionRow['subject_name'].'" name="'.$sessionRow['subject_name'].'">'.$sessionRow['subject_name'].'</option>';
													//echo '<option value="'.$sessionRow['session'].'" name="'.$sessionRow['session'].'">'.$sessionRow['session'].'</option>';
													
												}
												
												
											}
										}
									 }
									 
									 
									
									 ?>