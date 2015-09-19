<?php

class Generate extends CI_Controller
{

    function Generate()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('csv');
    }

        function create_csv(){

            $query = $this->db->query('SELECT * FROM user ');
           // $query=$query->result();
           
            // $num = $query->num_fields();
            // // var_dump($num); exit();
            // $var =array();
            // $i=1;
            // $fname="";
            // while($i <= $num){
            //     $test = $i;
            //     $value = $this->input->post($test);

            //     if($value != ''){
            //             $fname= $fname." ".$value;
            //             array_push($var, $value);

            //         }
            //      $i++;
            // }

            // $fname = trim($fname);

            // $fname=str_replace(' ', ',', $fname);

            // $this->db->select($fname);
           // $quer = $this->db->get('user');
           // $quer=$quer->result();
           // var_dump($quer); exit();
         //   query_to_csv($quer,TRUE,'Products_'.date('dMy').'.csv');

                $array = array(
    array('Last Name', 'First Name', 'Gender'),
    array('Furtado', 'Nelly', 'female'),
    array('Twain', 'Shania', 'female'),
    array('Farmer', 'Mylene', 'female')
);
 
//$this->load->helper('csv');
//echo array_to_csv($array);
                array_to_csv($array, 'toto.csv');
            
        }
}
