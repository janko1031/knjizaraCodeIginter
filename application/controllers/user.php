<?php

class User extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('gcharts');
    }

    public function prikazi_statistiku() {
        $this->load->model('knjiga_model');
        $this->gcharts->load('PieChart');
        $zanrovi = $this->knjiga_model->vratiSveZanrove();

        $slice1 = $this->knjiga_model->vratiProdajuPoZanru(1);
        $slice2 = $this->knjiga_model->vratiProdajuPoZanru(2);
        $slice3 = $this->knjiga_model->vratiProdajuPoZanru(3);
        $slice4 = $this->knjiga_model->vratiProdajuPoZanru(4);
        $slice5 = $this->knjiga_model->vratiProdajuPoZanru(5);
        $slice6 = $this->knjiga_model->vratiProdajuPoZanru(6);
        $slice7 = $this->knjiga_model->vratiProdajuPoZanru(7);
        $slice8 = $this->knjiga_model->vratiProdajuPoZanru(8);
        $this->gcharts->DataTable('ProdajaZanr')
                ->addColumn('string', 'Foods', 'food')
                ->addColumn('string', 'Amount', 'amount');

        foreach ($zanrovi as $zanr) {
            $this->gcharts->DataTable('ProdajaZanr')
                    ->addRow(array($zanr->nazivZanra, $this->knjiga_model->vratiProdajuPoZanru($zanr->zanr_id)));
        }


        $config = array(
            'title' => 'Prikaz dijagrama prodatih količina odredjenog žanra:',
            'is3D' => TRUE
        );

        $this->gcharts->PieChart('ProdajaZanr')->setConfig($config);

//UDEO U PRODAJI IZDAVACA

        $this->gcharts->load('DonutChart');



        $this->gcharts->DataTable('Izdavac')
                ->addColumn('string', 'Izdavac', 'izdavac')
                ->addColumn('string', 'Kolicina', 'kolicina')
                ->addRow(array('Evro-Giunti', $this->knjiga_model->vratiProdajuIzdavaca('Evro-Giunti')))
                ->addRow(array('Laguna', $this->knjiga_model->vratiProdajuIzdavaca('Laguna')))
                ->addRow(array('Vulkan izdavaštvo', $this->knjiga_model->vratiProdajuIzdavaca('Vulkan izdavaštvo')))
                ->addRow(array('Mikro knjiga', $this->knjiga_model->vratiProdajuIzdavaca('Mikro knjiga')));

        $config = array(
            'title' => 'Udeo izdavača u prodaji knjižare:',
            'pieHole' => .4
        );
        $this->gcharts->DonutChart('Izdavac')->setConfig($config);



//PRIHODI EVRO

        $this->gcharts->load('ColumnChart');

        $this->gcharts->DataTable('Prihodi')
                ->addColumn('string', 'Godine', 'class')
                ->addColumn('number', '2011', 'erasers')
                ->addColumn('number', '2012', 'pencils')
                ->addColumn('number', '2013', 'markers')
                ->addColumn('number', '2014', 'erasers')
                ->addRow(array(
                    'Prihod od prodaje',
                    $this->knjiga_model->vratiPrihodPoGodinama('2011-1-1', '2011-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2012-1-1', '2012-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2013-1-1', '2013-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2014-1-1', '2014-12-31', 'Evro-Giunti'),
        ));

        $config = array(
            'title' => 'Godišnji prihodi izdavaža Evro-Giunti'
        );

        $this->gcharts->ColumnChart('Prihodi')->setConfig($config);



//PRIHODI LAGUNA
        $this->gcharts->load('ColumnChart');

        $this->gcharts->DataTable('PrihodiLaguna')
                ->addColumn('string', 'Godine', 'class')
                ->addColumn('number', '2011', 'erasers')
                ->addColumn('number', '2012', 'pencils')
                ->addColumn('number', '2013', 'markers')
                ->addColumn('number', '2014', 'erasers')
                ->addRow(array(
                    'Prihod od prodaje',
                    $this->knjiga_model->vratiPrihodPoGodinama('2011-1-1', '2011-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2012-1-1', '2012-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2013-1-1', '2013-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2014-1-1', '2014-12-31', 'Laguna'),
        ));

        $config = array(
            'title' => 'Godisnji prihodi izdavača Laguna'
        );

        $this->gcharts->ColumnChart('PrihodiLaguna')->setConfig($config);

        $this->load->view('template'
                , array("folder" => "admin",
            "user" => $this->user,
            "broj" => $this->broj,
            "title" => "Statistike prodaje",
            "page" => "prikaz_statistike.php",
        ));
    }

}

?>
