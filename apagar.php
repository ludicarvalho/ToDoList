<?php

include "./banco.php";
include "./classe.php";
$td = new Todo();
$td->SetID($_GET['id']);

if ($td->Apagar()) {
?>
    <script>
        window.close();
    </script>
<?php
}
else
    echo "Erro";
?>