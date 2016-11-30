<?php
/* @var $this yii\web\View */
/* @var $hashtag string */
/* @var $candidatos \app\models\Candidato[] */

?>
<h1>Candidatos com a hashtag #<?=$hashtag?></h1>

<table border=1>
<?php foreach($candidatos as $candidato): ?>
    <tr>
        <td><?= $candidato->nome ?></td>
        <td><?= $candidato->partido ?></td>
        <td><?= $candidato->perfilView ?></td>
    </tr>
<?php endforeach; ?>
</table>