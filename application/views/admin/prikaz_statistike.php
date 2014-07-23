





<div class="col-md-9">

    <?php
    echo $this->gcharts->PieChart('ProdajaZanr')->outputInto('food_div');
    echo $this->gcharts->div(700, 400);

    if ($this->gcharts->hasErrors()) {
        echo $this->gcharts->getErrors();
    }
    ?>


    <hr>

<?php
echo $this->gcharts->DonutChart('Izdavac')->outputInto('food_div2');
echo $this->gcharts->div(500, 300);

if ($this->gcharts->hasErrors()) {
    echo $this->gcharts->getErrors();
}
?>
    <hr>

    <?php
    echo $this->gcharts->ColumnChart('Prihodi')->outputInto('inventory_div');
    echo $this->gcharts->div(600, 500);

    if ($this->gcharts->hasErrors()) {
        echo $this->gcharts->getErrors();
    }
    ?>
    <hr>

    <?php
    echo $this->gcharts->ColumnChart('PrihodiLaguna')->outputInto('inventory_div2');
    echo $this->gcharts->div(600, 500);

    if ($this->gcharts->hasErrors()) {
        echo $this->gcharts->getErrors();
    }
    ?>
</div>