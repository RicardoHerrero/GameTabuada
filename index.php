<?
session_start();
extract($_REQUEST);
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Game Tabuada</title>
</head>

<body>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td valign="top" width="200">
              <table width="100%" border="0" cellspacing="10" cellpadding="0">
                <tr>
                  <td><a href="game.php?tipo=new">Novo Game</a></td>
                </tr>
                <tr>
                  <td><a href="game.php">Resumo Game</a></td>
                </tr>
                
                <tr>
                  <td>&nbsp;</td>
                </tr>
        </table></td>
        <td valign="top">
        	<?//=$_SESSION["eGame"]?>
        
        	<table border="0" cellspacing="10" style="font-size:25px">
            <tr>
            	<td colspan="7" height="30" bgcolor="#CCCCCC">Resultado</td>    
            </tr>
            <?
				$acertos=0;
				$linhas=0;
            	if($_SESSION["eGame"]!=""){
					$resultado = explode("#", $_SESSION["eGame"]);
					for($i=0;$i<=count($resultado)-2;$i++){ 
						$linhas++;
						$c 			= explode("=",$resultado[$i]);
						$variaveis 	= explode("x",$c[0]);
						
						$jogador = $c[1];
						if($jogador=="")$jogador="nda";
						
						//CALCULANDO NOVAMENTE
						$correto = $variaveis[0] * $variaveis[1];
						if($correto==$jogador){
							//CERTO
							$acertos++;
							$cor = "green";	
						}else{
							//ERRADO
							$cor = "red";	
						}	
						?>
                    	<tr>
                        	<td align="center"><?=$variaveis[0]?></td>
                        	<td align="center">x</td>
                            <td align="center"><?=$variaveis[1]?></td>
                        	<td align="center">=</td>
                            <td align="center" style="color:<?=$cor?>"><?=$jogador?></td>
                            <td align="center" style="padding:0 20px" ><img src="media/<?=$cor?>.png" border="0" /></td>
                            
                            <td align="center" bgcolor="#CCCCCC" style="padding:0 10px"><?=$correto?></td>
                        </tr>
                	<?	
					}           
               	}
            ?>
            </table>
        	
            <p>
            <?
			if($linhas>9){
				if($acertos>9){
					//PARABENS
					?>
					<span style="font-size:60px; color:#063">Parabéns! :)  Vc foi incrivelmente Bem Esther! <br/> Vá descansar um pouco que você merece.</span>
					<?
				}else if($acertos>=7){
					//BOM
					?>
					<span style="font-size:60px; color:#039">Bom! :)  Vc foi bem Esther, Muito bom! Nao deixe de treinar</span>
					<?
				
				}else if($acertos>5){
					//MEDIO
					?>
					<span style="font-size:60px; color:#C60">Medio! :|  Esther.... Voce esta no caminho! <br /> Treine mais um pouco, vc consegue.</span>
					<?
				
				}else if($acertos>3){
					//RUIM
					?>
					<span style="font-size:60px; color:#F0F">Ruim! :{  Esther.... Voce nao esta treinando? <br /> Treine mais e mais. Eh a persistencia que nos leva a perfeicao</span>
					<?
				}else{
					//FRACO
					?>
					<span style="font-size:60px; color:#F00">FRACO, fraco! :(  Esther.... Voce nao esta treinando? <br /> Treine mais e mais. Eh a persistencia que nos leva a perfeicao</span>
					<?
				}
				
				
				$_SESSION["eGame"] = str_replace("#","&nbsp;,&nbsp;",$_SESSION["eGame"]);
				
				//GERANDO LOG///
				$message = "
					<h3>".date("d/m/Y H:i:s")."</h3>
					<p><b>Nota</b>: ".$acertos." <i>(de 0 a 10)</i></p>
					<p><b>resultado</b>: ".$_SESSION["eGame"]."</p>
				";
				
				$HTMLTitulo = "Esther Tabuada";
				$HTMLConteudo = $message;
				
				$headers 	 = "MIME-Version: 1.0\n";
				$headers 	.= "Content-type: text/html\n";
				$headers 	.= "From: herrero@publitz.com.br\n";
				$headers	.= "Bcc:renata@publitz.com.br\n";
				
				if(mail("herrero@publitz.com.br",$HTMLTitulo,$HTMLConteudo,$headers)){
					$mensagem = "<br>Enviado com sucesso! Em breve entraremos em contato... <br/><br/><br/>";	
				}else{
					$mensagem = "<br><font color=red>Não foi possível enviar o e-mail. <br/><br/><br/>";
				} 
				///FIM DO LOG
				
				$_SESSION["eGame"] = "";
			}
			?>
            </p>
        
        </td>
      </tr>
    </table>
</body>
</html>
