<?php
class App extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->model('region_model');
        $this->load->model('sys_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    function index()
    {
        $data['summoner'] = "";
        $data['regions'] = $this->region_model->get_regions();
        $data['region_selected'] = 1;
        $data['mastery'] = "null";
        $data['generalScore'] = 0;

        $this->form_validation->set_rules('region', 'Region', 'required');
        $this->form_validation->set_rules('summoner', 'Summoner', 'required');

        if ($this->form_validation->run() != FALSE){
            $data = $this->searchData($data, $_GET['region'], $_GET['summoner']);
        }else if(@$_GET['region'] && @$_GET['summoner']){
            $data = $this->searchData($data, $_GET['region'], $_GET['summoner']);
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('app/index', $data);
        $this->load->view('layouts/footer', $data);
    }

    function searchData($data, $region, $summoner){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $key = $this->sys_model->get_apikey()['dat_key'];
        $region_instance = $this->region_model->get_region($region); 
        $host = $region_instance['reg_host'];
        $region = $region_instance['reg_region'];
        $platform = $region_instance['reg_platform'];
        $name = strtolower($summoner);
        $data['summoner'] = $name;

        $championInstance = $this->getSummonerByName($host, $region, $name, $key, $arrContextOptions);
        if($championInstance!=null){
            $summonerId = $championInstance->$name->id;
            $data['mastery'] = $this->getChampionMasteryDataBySummonerId($host, $platform, $summonerId, $key, $arrContextOptions);
            $data['generalScore'] = $this->getGeneralScore($host, $platform, $summonerId, $key, $arrContextOptions);
        }else{
            $data['mastery'] = "notFound";
        }
        return $data;
    }

    function getSummonerByName($host, $region, $name, $key, $arrContextOptions){  
        if (!$result = @file_get_contents('https://'.$host.'/api/lol/'.$region.'/v1.4/summoner/by-name/'.$name.'?api_key='.$key, false, stream_context_create($arrContextOptions))) {
            $result = null;
        }else{
            $result = json_decode($result);
        }
        return $result;
    }

    function getChampionMasteryDataBySummonerId($host, $platform, $summonerId, $key, $arrContextOptions){
        if (!$champions = file_get_contents('https://'.$host.'/championmastery/location/'.$platform.'/player/'.$summonerId.'/champions?api_key='.$key, false, stream_context_create($arrContextOptions))) {
            $result = "noMasteryData";
        }else{
            $result = $champions;
        }
        return $result;
    }

    function getGeneralScore($host, $platform, $summonerId, $key, $arrContextOptions){
        if (!$champions = file_get_contents('https://'.$host.'/championmastery/location/'.$platform.'/player/'.$summonerId.'/score?api_key='.$key, false, stream_context_create($arrContextOptions))) {
            $result = null;
        }else{
            $result = $champions;
        }
        return $result;
    }

    function getChampionName(){
        $sucess = true;
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $key = $this->sys_model->get_apikey()['dat_key'];
        $id = $_POST['id'];
        

        if (!$result = @file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/'.$id.'?champData=passive,spells&api_key='.$key, false, stream_context_create($arrContextOptions))) {
            $name = "";    
        }else{
            try{
                $json = json_decode($result);
                $name = $json->name;
                $key = $json->key;
                $spells = $json->spells;
                $passiveImage = $json->passive->image->full;

                $data['championName'] = $name;
                $data['championKey'] = $key;
                $data['championLevel'] = $_POST['championLevel'];
                $data['lastPlayTime'] = $_POST['lastPlayTime'];
                $data['championPoints'] = $_POST['championPoints'];
                $data['championPointsUntilNextLevel'] = $_POST['championPointsUntilNextLevel'];

                $data['passiveDescription'] = $json->passive->description;
                $data['spellDescription1'] = $json->spells[0]->description;
                $data['spellDescription2'] = $json->spells[1]->description;
                $data['spellDescription3'] = $json->spells[2]->description;
                $data['spellDescription4'] = $json->spells[3]->description;

                $data['spell1'] = $spells[0]->image->full;
                $data['spell2'] = $spells[1]->image->full;
                $data['spell3'] = $spells[2]->image->full;
                $data['spell4'] = $spells[3]->image->full;
                $data['passiveImage'] = $passiveImage;
                

                $data['result'] = $result;
                if(@$_POST['highestGrade']!=''){
                    $data['highestGrade'] = $_POST['highestGrade'];
                }else{
                    $data['highestGrade'] = '-';
                }
                
                $data['chestGranted'] = $_POST['chestGranted'];
                $this->load->view('layouts/champion', $data);
            }catch(Exception $e){
                $sucess = false;
            }
        }
    }
}
