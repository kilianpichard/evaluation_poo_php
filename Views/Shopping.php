<?php
// print_r($data);
?>

<table class="table table-dark text-center my-5">
    <thead>
        <tr>
            <td>Nom</td>
            <td>Poids</td>
            <td>Prix (HT)</td>
            <td>Prix (TTC)</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item->label() ?></td>
                <td><?= $item->getWeight() ?>g</td>
                <td><?= number_format(floatval($item->cost() / 100), 2) . '€' ?></td>
                <td><?= number_format(floatval($item->cost() * (1 + ($item->taxRatePerThousands() / 1000)) / 100), 2) . '€' ?></td>
                <td><a href="?action=add&item=<?= $item->label() ?>" class="btn btn-success">Ajouter</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-dark text-center my-5">
    <thead>
        <tr>
            <td>Nom</td>
            <td>Poids</td>
            <td>Prix (HT)</td>
            <td>Prix (TTC)</td>
            <td>DLC</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($freshItems as $item) : ?>
            <tr>
                <td><?= $item->label() ?></td>
                <td><?= $item->getWeight() ?>g</td>
                <td><?= number_format(floatval($item->cost() / 100), 2) . '€' ?></td>
                <td><?= number_format(floatval($item->cost() * (1 + ($item->taxRatePerThousands() / 1000)) / 100), 2) . '€' ?></td>
                <td><?= date("D d M Y", strtotime($item->getBestBeforeDate())) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>