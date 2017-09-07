<?php
/**
 * Classe para geracao de arquivos em formato word da microsoft
 * @author Tayron Miranda <dev@tayron.com.br>
 */
class Word {
    public function __construct( $html, $nome = 'file.doc', $destino = null ) {
        if (!$destino):
             header('Content-type: application/vnd.msword');
             header('Content-type: application/force-download');
             header('Content-Disposition: attachment; filename="' . $nome . '"');
             header('Pragma: no-cache');
             echo $html ;                  
         else:         
             file_put_contents($destino.'/'.$nome, $html);             
         endif;
    }
}
?>