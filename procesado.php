<html>
	<head>
 		<title>Ejemplo de PHP</title>
	</head>
	<body>
		<?php 
                        $var_1_1=4.05;
                        $var_1_2=0.00;
                        $var_1_3=0.00;
                        $var_1_4=0.00;

                        $var_2_1=0.00;
                        $var_2_2=0.00;
                        $var_2_3=0.00;
                        $var_2_4=0.00;

                        $var_3_1=3.00;
                        $var_3_2="-";
                        $var_3_3="-";
                        $var_3_4="-";

                        $var_4_1=4.00;
                        $var_4_2="-";
                        $var_4_3="-";
                        $var_4_4="-";
                ?>

		<H1>Procesado de Captaci&oacuten de Velocidades</H1>
		<CENTER>
		<TABLE BORDER style="border:1px solid green">
		<CAPTION ALIGN=bottom>Resumen de Velocidades</CAPTION>
		<TR>
			<TD><TH>SENSOR 1</TH><TH>SENSOR 2</TH><TH>SENSOR 3</TH><TH>SENSOR 4</TH></TD>
		</TR>

		<TR ALIGN=CENTER>
			<TH>COCHE 1</TH><TD><?php echo $var_1_1?></TD><TD><?php echo $var_1_2?></TD><TD><?php echo $var_1_3?></TD><TD><?php echo $var_1_4?></TD>
		</TR>

		<TR ALIGN=CENTER>
			<TH>COCHE 2</TH><TD><?php echo $var_2_1?></TD><TD><?php echo $var_2_2?></TD><TD><?php echo $var_2_3?></TD><TD><?php echo $var_2_4?></TD>
		</TR>

		<TR ALIGN=CENTER>
			<TH>COCHE 3</TH><TD><?php echo $var_3_1?></TD><TD><?php echo $var_3_2?></TD><TD><?php echo $var_3_3?></TD><TD><?php echo $var_3_4?></TD>
		</TR>

		<TR ALIGN=CENTER>
			<TH>COCHE 4</TH><TD><?php echo $var_4_1?></TD><TD><?php echo $var_4_2?></TD><TD><?php echo $var_4_3?></TD><TD><?php echo $var_4_4?></TD>
		</TR>
		<br>
		<?php 
			error_reporting(E_ALL);

			/* Permitir al script esperar para conexiones. */
			set_time_limit(0);
			$address = '192.168.1.50';
			$port = 10000;

			if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
 				   echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
			}
			if (socket_bind($sock, $address, $port) === false) {
    				echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
			}
			do{	//No tengo claro si el socket accept es obligatorio, porque creo que puedo ponerme a leer directamente
				if (($msgsock = socket_accept($sock)) === false) {
        				echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
 					break;
				}
				if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
         				echo "socket_read() falló: razón: " . socket_strerror(socket_last_error($msgsock)) . "\n";
            				break;
        			}
				$buf=explode(" ",trim($buf));
				switch($buf[0]){
				case "11":
					$var_1_1=$buf[1];
					break;
				case "12":
					$var_1_2=$buf[1];
                                	break;
				case "13":
					$var_1_3=$buf[1];
                                	break;
                                case "14":
                                	$var_1_4=$buf[1];
					break;
                                case "21":
					$var_2_1=$buf[1];
                                	break;
                                case "22":
					$var_2_2=$buf[1];
                                	break;
                                case "23":
					$var_2_3=$buf[1];
                                	break;
                                case "24":
					$var_2_4=$buf[1];
                                	break;
                                case "31":
					$var_3_1=$buf[1];
                                	break;
                                case "41":
					$var_4_1=$buf[1];
                                	break;
				default:
					break;
				}
				//aqui en este punto habria que actualizar la pagina
			}while(true);
		?>
	</body>
</html>


