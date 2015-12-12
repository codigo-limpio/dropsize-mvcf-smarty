<?php 
/*
  V4.93 10 Oct 2006  (c) 2000-2011 John Lim (jlim#natsoft.com). All rights reserved.
  Released under both BSD license and Lesser GPL library license. 
  Whenever there is any discrepancy between the two licenses, 
  the BSD license will take precedence.
  
  Some pretty-printing by Chris Oxenreider <oxenreid@state.net>
*/ 

// specific code for tohtml
GLOBAL $gSQLMaxRows,$gSQLBlockRows,$ADODB_ROUND;

$ADODB_ROUND=4; // rounding
$gSQLMaxRows = 1000; // max no of rows to download
$gSQLBlockRows=20; // max no of rows per table block

// RecordSet to HTML Table
//------------------------------------------------------------
// Convert a recordset to a html table. Multiple tables are generated
// if the number of rows is > $gSQLBlockRows. This is because
// web browsers normally require the whole table to be downloaded
// before it can be rendered, so we break the output into several
// smaller faster rendering tables.
//
// $rs: the recordset
// $ztabhtml: the table tag attributes (optional)
// $zheaderarray: contains the replacement strings for the headers (optional)
//
//  USAGE:
//	include('adodb.inc.php');
//	$db = ADONewConnection('mysql');
//	$db->Connect('mysql','userid','password','database');
//	$rs = $db->Execute('select col1,col2,col3 from table');
//	rs2html($rs, 'BORDER=2', array('Title1', 'Title2', 'Title3'));
//	$rs->Close();
//
// RETURNS: number of rows displayed

function rs2html(&$rs,$ztabhtml=false,$zheaderarray=false,$htmlspecialchars=true, $echo = true, $excepcions, $request, $sustitution, $direccion)
{

#* Agregamos variable almacenadora
$s =''; $rows=0; $docnt = false; $reg = "?"; $szof = sizeof($request); $primary = array();
GLOBAL $gSQLMaxRows,$gSQLBlockRows,$ADODB_ROUND;
	
	if (!$rs) {
		printf(ADODB_BAD_RS,'rs2html');
		return false;
	}

	if (! $ztabhtml) $ztabhtml = "BORDER='0' WIDTH='98%'";
	//else $docnt = true;
	$typearr = array();
	$ncols = $rs->FieldCount();
	$hdr = "<TABLE COLS=$ncols $ztabhtml><tr>\n\n";
	for ($i=0; $i < $ncols; $i++) {	
		
		#* ITP 08-02-12	Armamos la palabra clave para filtrar por columna
		$field 			= $rs->FetchField($i);
		$Filter_field	= $field->name;

		if ($field) {
			if ($zheaderarray) $fname = $zheaderarray[$i];
			else $fname = htmlspecialchars($field->name);	
			$typearr[$i] = $rs->MetaType($field->type,$field->max_length);
 			//print " $field->name $field->type $typearr[$i] ";
		} else {
			$fname = 'Field '.($i+1);
			$typearr[$i] = 'C';
		}
		if (strlen($fname)==0) $fname = '&nbsp;';
		
		#* ITP 11-11-11	Aqui comenzamos el bisne de sustituir el alias por el encabezado de los campos				
				
		if(isset($sustitution["texto"][$fname])){
			$fname	= $sustitution["texto"][$fname];
		} else {
			$fname	= $fname;	
		}
		
		#* ITP 08-02-12	Agregamos filtro por encabezado
		/*
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>?ordenar_campo=<?php echo $alias[$campo]; ?>" class="an">
				<b><?php echo $Session["cotizaciones"]["sustituciones"]["texto"][$campo]; ?></b>
			</a>
			
			$hdr .= "<TH>$fname</TH>";
		*/
		#* Imprimimos la informacion
		$hdr	.= "<TH><a href=\"?pstAccion=Listar&direccion=".$direccion."&ordenar_campo=".$Filter_field."\">".$fname."</a></TH>";
		//$hdr .= "<TH>$fname</TH>";
	}
	// encabezado th
	$hdr .= "<th>&nbsp;</th>\n\n";
	
	$hdr .= "\n</tr>";
	if ($echo) print $hdr."\n\n";
	else $html = $hdr;
	
	// smart algorithm - handles ADODB_FETCH_MODE's correctly by probing...
	$numoffset = isset($rs->fields[0]) ||isset($rs->fields[1]) || isset($rs->fields[2]);

	while (!$rs->EOF) {
		#* ITP 18-11-11 Intercalado de colores
		$color = ((isset($color)) && ($color == '#E7EDDD')) ? '#FFFFFF' : '#E7EDDD';
		$s .= "<TR valign=\"top\" bgcolor=\"{$color}\" >\n";
				
		for ($i=0; $i < $ncols; $i++) {
			
			#* ITP 11-11-11	Funcion que permite registrar informacion dentro de nuestro campo
			$Campo	=  $rs->_fieldobjects[$i]->name;
			
			if ($i===0) $v=($numoffset) ? $rs->fields[0] : reset($rs->fields);
			else $v = ($numoffset) ? $rs->fields[$i] : next($rs->fields);
			
			$type = $typearr[$i];
			
			switch($type) {
				case 'D':
					if (empty($v)) $s .= "<TD> &nbsp; </TD>\n";
					else if (!strpos($v,':')) {
						$s .= "	<TD>".$rs->UserDate($v,"D d, M Y") ."&nbsp;</TD>\n";
					}
					break;
				case 'T':
					if (empty($v)) $s .= "<TD> &nbsp; </TD>\n";
					else $s .= "	<TD>".$rs->UserTimeStamp($v,"D d, M Y, h:i:s") ."&nbsp;</TD>\n";
				break;
				
				case 'N':
					if (abs($v) - round($v,0) < 0.00000001)
						$v = round($v);
					else
						$v = round($v,$ADODB_ROUND);
				case 'I':
					#* Function con argumentos 1
					if(isset($sustitution["funcion"][$Campo])){
						$v = call_user_func($sustitution["funcion"][$Campo], $v);
					} else {
						$v	= $v;	
					}
					$s .= "	<TD align=right>".stripslashes((trim($v))) ."&nbsp;</TD>\n";
					
				break;
				/*
				case 'B':
					if (substr($v,8,2)=="BM" ) $v = substr($v,8);
					$mtime = substr(str_replace(' ','_',microtime()),2);
					$tmpname = "tmp/".uniqid($mtime).getmypid();
					$fd = @fopen($tmpname,'a');
					@ftruncate($fd,0);
					@fwrite($fd,$v);
					@fclose($fd);
					if (!function_exists ("mime_content_type")) {
					  function mime_content_type ($file) {
						return exec("file -bi ".escapeshellarg($file));
					  }
					}
					$t = mime_content_type($tmpname);
					$s .= (substr($t,0,5)=="image") ? " <td><img src='$tmpname' alt='$t'></td>\\n" : " <td><a
					href='$tmpname'>$t</a></td>\\n";
					break;
				*/

				default:
					if ($htmlspecialchars) //$v = htmlspecialchars(trim($v));
					$v = trim($v);
					if (strlen($v) == 0) $v = '&nbsp;';
					$v	= str_replace("\n",'<br>',stripslashes($v));
	
					#* ITP 11-11-11	Funcion que permite registrar informacion dentro de nuestro campo
					#* ITP 21-12-11 Comentada, no es necesario hacer este paso
					//$Campo	=  $rs->FetchField($i);
					/*
						Esta funcion se recomienda utilizar solo para campos tipo texto, ya que:
							-	date
							-	numeric
							-	integer
							-	time
						Manejan una manipulacion diferente.
					*/
						
					#* Function con argumentos 1
					if(isset($sustitution["funcion"][$Campo])){
						$v = call_user_func($sustitution["funcion"][$Campo], $Campo);
					} else {
						$v	= $v;	
					}
					
					$s .= sprintf("	<TD>%s</TD>\n", $v);
				  
			}
			
			
		} // for
		
		#* ITP 20-03-11 Verificar si viene con parametros
		if(strpos($excepcions, "?") > -1){
			$reg = NULL;
		}
		#* ITP 01-11-11	Aqui metemos los parametros del request.
		foreach($request as $campo => $valor){
			
			#* Si encontramos el indice, entonces armamos el parametro GET
			for($k = 0 ; $k < sizeof($request); $k++){
			
				#* Buscamos el parametro
				if(!in_array($valor, $primary)){
					
					array_push($primary, $valor);
					
					#* Buscamos el parametro
					if($rs->_fieldobjects[$k]->name == $valor){
						
						$reg.= (--$szof > 0 && strpos($excepcions, "?") > -1) ? $campo."=".$rs->fields[$valor]."&" : "&".$campo."=".$rs->fields[$valor];
					}
					$primary = array();
				}
			}
			
		}
		
		$s .= str_replace('%s', $reg, "<td>{$excepcions}</td>\n\n");
		$s .= "</TR>\n\n";
		
		$reg = '?';	  
		$rows += 1;
		if ($rows >= $gSQLMaxRows) {
			$rows = "<p>Truncated at $gSQLMaxRows</p>";
			break;
		} // switch

		$rs->MoveNext();
	
	// additional EOF check to prevent a widow header
		if (!$rs->EOF && $rows % $gSQLBlockRows == 0) {
	
		//if (connection_aborted()) break;// not needed as PHP aborts script, unlike ASP
			if ($echo) print $s . "</TABLE>\n\n";
			else $html .= $s ."</TABLE>\n\n";
			$s = $hdr;
		}
	} // while

	if ($echo) print $s."</TABLE>\n\n";
	else $html .= $s."</TABLE>\n\n";
	
	if ($docnt) if ($echo) print "<H2>".$rows." Rows</H2>";
	
	return ($echo) ? $rows : $html;
 }
 
// pass in 2 dimensional array
function arr2html(&$arr,$ztabhtml='',$zheaderarray='')
{
	if (!$ztabhtml) $ztabhtml = 'BORDER=1';
	
	$s = "<TABLE $ztabhtml>";//';print_r($arr);

	if ($zheaderarray) {
		$s .= '<TR>';
		for ($i=0; $i<sizeof($zheaderarray); $i++) {
			$s .= "	<TH>{$zheaderarray[$i]}</TH>\n";
		}
		$s .= "\n</TR>";
	}
	
	for ($i=0; $i<sizeof($arr); $i++) {
		$s .= '<TR>';
		$a = $arr[$i];
		if (is_array($a)) 
			for ($j=0; $j<sizeof($a); $j++) {
				$val = $a[$j];
				if (empty($val)) $val = '&nbsp;';
				$s .= "	<TD>$val</TD>\n";
			}
		else if ($a) {
			$s .=  '	<TD>'.$a."</TD>\n";
		} else $s .= "	<TD>&nbsp;</TD>\n";
		$s .= "\n</TR>\n";
	}
	$s .= '</TABLE>';
	print $s;
}

?>