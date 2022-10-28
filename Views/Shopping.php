<?php
// print_r($data);
?>

<table class="table table-dark text-center my-5">
    <thead>
        <tr>
            <td>Article</td>
            <td>Prix (HT)</td>
            <td>Prix (TTC)</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart->getItems() as $item) : ?>
            <tr>
                <td><?= $item->label() ?></td>
                <td><?= number_format(floatval($item->cost() / 100), 2) . '€' ?></td>
                <td><?= number_format(floatval(($item->cost() + $item->taxRatePerThousands()) / 100), 2) . '€' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>