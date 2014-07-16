<?
session_start();
extract($_REQUEST);

	$A = rand(1,9);
	$B = rand(4,9);
	
	$TimeDificult = 4000;
	
	
	if($tipo=="new") $_SESSION["eGame"]="";
	
	if($res!="") $_SESSION["eGame"]=$_SESSION["eGame"].$res."#";
	
	
	$Game 		= explode("#", $_SESSION["eGame"]);
	$GameFase 	= count($Game);
	
	if($GameFase>10){
		header("Location:index.php");
		}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Game Tabuada</title>
	<link href="css/estilo.css" rel="stylesheet" type="text/css">

	<script>
	<!--
		function fRetorno(xtime){
			with(document.formulario){
				
				result 	= <?=$A?> * <?=$B?>;
				if(xtime==0 && resultado.value=="") resultado.value=0;
				
				if(resultado.value!="" || resultado.value==result){
				
					if(resultado.value>0) C.value = resultado.value;
					
					jogador =  parseInt(resultado.value);
					
					if(result==jogador){
						fFinaliza(true);
					}else{
						fFinaliza(false);
						document.getElementById("resultado").className="TxResultadoGER";	
						document.getElementById('resultado2').innerHTML = result;
					}	 
					
				}else{
					resultado.focus();
				}
					
			}	
		}
		
		function fFinaliza(pos){
			if(pos){
				//certo	
				document.getElementById("resultado").className="TxResultadoTRUE";
			}else{
				//errado
				document.getElementById("resultado").className="TxResultadoFALSE";
			}
			setTimeout("NewPage()",2500);

		}
		
		function NewPage(){
			c = document.formulario.C.value;
			document.formulario.res.value="<?=$A?>x<?=$B?>="+c;
			document.formulario.action="game.php";
			document.formulario.submit();
		}
		
		function fLoad(){
			document.formulario.resultado.focus();
			setTimeout("fRetorno(0)",<?=$TimeDificult?>);
		}
	//-->    
    </script>
</head>

<body onLoad="javascript:fLoad()">
<p>&nbsp;</p>

<form name="formulario" id="formulario" method="post" action="javascript:fRetorno()">
<input type="hidden" id="A" name="A" value="<?=$A?>" />
<input type="hidden" id="B" name="B" value="<?=$B?>" />
<input type="hidden" id="C" name="C" value="" />
<input type="hidden" id="res" name="res" value="" />


<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td colspan="3" height="100">
    	<a href="game.php?tipo=new">Novo Jogo</a> |
        <a href="index.php">Pause</a>
    </td>
</tr>

<tr>
	<td colspan="3" class="etapa"><?=count($Game)?> / 10</td>
</tr>
<tr>
    <td valign="top">
        <div class="numero"><?=$A?></div>
    </td>
    <td><div class="x">x</div></td>
    <td>
        <div class="numero"><?=$B?></div>
    </td>
</tr>
<tr>
	<td colspan="3" height="100" valign="top" style="padding-top:10px">
    	<div class="x">resposta</div>
    </td>
</tr>


<tr>
  <td colspan="3" align="center">
    	<input type="text" value="" class="TxResultado" onBlur="fRetorno()" id="resultado" name="resultado" />
    </td>
</tr>
<tr>
	<td colspan="3" align="center">
    	<div id="resultado2" class="DVResultadoGER"></div>
        
    </td>
</tr>

</table>


</form>

</body>
</html>
