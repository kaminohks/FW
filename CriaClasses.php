<?php

include "Conexao.php";

class CriaClasses1
{
      private $con;

      function __construct()
      {
            $this->con = (new Conexao())->conectar();
      }

      function ClassesModel()
      {
            if (!file_exists("sistema")) {
                  mkdir("sistema");
            }
            if (!file_exists("sistema/model")) {
                  mkdir("sistema/model");
            }

            $sql = "SHOW TABLES";
            $query = $this->con->query($sql);
            $tabelas = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tabelas as $tabela) {
                  $nomeTabela = array_values((array)$tabela)[0];
                  $sql = "show columns from " . $nomeTabela;
                  $atributos = $this->con->query($sql)->fetchAll(PDO::FETCH_OBJ);
                  $nomeAtributos = "";
                  foreach ($atributos as $atributo) {
                        $nomeAtributos .= "private \${$atributo->Field};\n";
                  }
                  $gets = "";
                  $sets = "";

                  foreach ($atributos as $atributo) {
                        $atributoUp = ucfirst($atributo->Field);
                        $gets .= "public function get{$atributoUp}()\n{\nreturn \$this->{$atributo->Field};\n}\n";
                        $sets .= "public function set{$atributoUp}(\${$atributo->Field}):self\n{\n\$this->{$atributo->Field}=\${$atributo->Field};\nreturn \$this;\n}\n";
                  }
                  $nomeTabela = ucfirst($nomeTabela);
                  // heardocument
                  $conteudo = <<<EOT
            <?php
            class {$nomeTabela}
            {
                {$nomeAtributos}
                {$gets}
                {$sets}
            }
            ?>
            EOT;

                  file_put_contents("sistema/model/{$nomeTabela}.php", $conteudo);
            }
      }
}

(new CriaClasses1())->ClassesModel();
