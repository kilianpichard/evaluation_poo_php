<?php
// print_r($data);
?>

<table class="table table-dark text-center my-5">
    <thead>
        <tr>
            <td>Nom</td>
            <td>Prix (HT)</td>
            <td>Prix (TTC)</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart->getItems() as $item) : ?>
            <tr>
            <tr>
                <td><?= $item->label() ?></td>
                <td><?= number_format(floatval($item->cost() / 100), 2) . '€' ?></td>
                <td><?= number_format(floatval($item->cost() * (1 + ($item->taxRatePerThousands() / 1000)) / 100), 2) . '€' ?></td>
            </tr>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>