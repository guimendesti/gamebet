<?php

/**
 * AdminController is the customized base controller from Administrator Panel
 * 
 */
class AdminController extends Controller {

    protected function beforeAction($event) {

        $control = Yii::app()->getController()->getId();
        $action = Yii::app()->getController()->getAction()->getId();

        if (!isset(Yii::app()->session['loginAdmin'])) {
            if ($control != "default" || $action != "login") {
                $this->redirect(array("/admin/login"));
            }
        }

        return true;
    } 
    
    
    /**
     * Padroniza Upload de Arquivos pelo Administrativo
     * 
     * @param array $file
     * @param string $out
     * @param array $allowedExts
     * @param string $prefixoNome
     * @param string $dir
     * 
     * @return string|boolean
     */
    public function uploadArquivo($file, $out = false, $allowedExts = false, $prefixoNome = "", $dir = "uploads/") {

        if(!is_array($allowedExts) || count($allowedExts) < 1){
            $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", 
                                 "docx", "cvs", "xls", "xlsx", "txt", "sql");
        }
        
        $extension = end(explode(".", $file["name"]));
        if (($file["size"] < 5000000) && in_array($extension, $allowedExts)) {
            
            if ($file["error"] > 0) {
                return false;
            } else {
                $extFile = end(explode(".", $file["name"]));
                $mcNome = str_replace(".", "", str_replace(" ", "", microtime()));
                $novoNome = $prefixoNome . $mcNome . "." . $extFile;
                $dirArquivo = $dir . $novoNome;
        
                if ($out != false) {
                    if (is_file($dir . $out))
                        unlink($dir . $out);
                }
                move_uploaded_file($file["tmp_name"], $dirArquivo);

                return $novoNome;
            }
        }

        return false;
    }

}
