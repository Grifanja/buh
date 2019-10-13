<?php

namespace App\Controller;

use App\Entity\Esv;
use App\Entity\Zp;
use App\Form\Elements\NaviItem;
use App\Form\Elements\NaviItemList;
use App\Services\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Twig\Environment;


class TestController extends AbstractController
{
    /**ц
     * @Route("/xml", name="xml")
     */
    public function xml()
    {
       $arr = [
           'fields' => [
               'field' => [
                   '@name' => 'cost',
                   '#' => 'good'
               ]
           ]
       ];

       $xmlEncoder = new XmlEncoder();
       $xml = $xmlEncoder->encode($arr,'xml');
       $response = new Response();
       $response->setContent($xml);
       $response->headers->set('Content-Type','xml');

        return $response;
    }


    public function test2()
    {

        $url = 'https://www.avanza.se/aktier/om-aktien.html/80347/agromino';

        /**
         * @param string $url
         * @return string
         */
        function get_Utv_i_dag_SEK(string $url): string
        {
            $response = 'not found';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $file_contents = curl_exec($ch);
            curl_close($ch);

            $re = '/<span[\w\s<^\'^"^]*?class=[\'|"]([A-Za-z"^\'^\s]+)[\'|"][\w\s<^\'^"^]*?>([\w\W]+)<\/span>/mU';
            preg_match_all($re, $file_contents, $matches, PREG_SET_ORDER, 0);
            $findClasses = ["change", "SText", "bold", "negative"];

            foreach ($matches as $mat) {
                $diff = array_diff($findClasses, explode(' ', $mat[1]));
                if (empty($diff)) {
                    return $mat[2];
                }
            }

            return $response;
        }



        $response = new Response();
        $response->setContent('');


        return $response;

    }
    /**
     * @Route("/test1", name="test1")
     */
    public function test1()
    {


        /*
        Пример:
        $input = [ [1,2,3], [4,5,6] ];

        Результат работы скрипта для данного примера
        Array
        (
            [0] => Array
                (
                    [0] => 1
                    [1] => 4
                )

            [1] => Array
                (
                    [0] => 2
                    [1] => 5
                )

            [2] => Array
                (
                    [0] => 3
                    [1] => 6
                )
        )

        Array ( [0] => Array ( [0] => 1 [1] => 2 [2] => 3 ) [1] => Array ( [0] => 4 [1] => 5 [2] => 6 ) )
         Array (
        [0] => Array ( [0] => 1 [1] => 4 )
        [1] => Array ( [0] => 2 [1] => 5 )
        [2] => Array ( [0] => 3 [1] => 6 ) )

        */

        $input = [[1, 2, 3], [4, 5, 6]];
        $result = [];
        $maxCol = 0;
        $maxRow = count($input);
        foreach ($input as $i) {
            $maxCol = count($i) > $maxCol ? count($i) : $maxCol;
        }

        foreach (range(0, $maxCol - 1) as $iCol) {
            foreach (range(0, $maxRow - 1) as $iRow) {
                $result[$iCol][] = $input[$iRow][$iCol];
            }
        }

        /*
        Пример:
        $input = "12345678901234567890 123";

        Результат работы скрипта для данного примера:
        12345678901234568013
        */

        $input  = "12345678901234567890 123";
        $arr    =  explode(' ',$input);
        $result = sum($arr[0],$arr[1]);

        function sum(string $first, string $second): string
        {
            $first  = array_reverse(str_split($first));
            $second = array_reverse(str_split($second));
            $max    = count(max($second ,$first));
            $result = [];
            $tmpVal    = 0;
            for ($i = 0; $i <= $max-1; $i++) {
                $firstVal   = isset($first[$i])  ? $first[$i]  : 0 ;
                $secondVal  = isset($second[$i]) ? $second[$i] : 0 ;
                $sum        = (int)$firstVal + (int)$secondVal + (int)$tmpVal;
                $result[$i] = $sum%10;
                $tmpVal     = (int)($sum/10);
            }
            $result[$max-1] = $result[$max-1] + $tmpVal*10;
            return join('',array_reverse($result));
        }

        /*
Пример:
$json_1 = "{'one':1,'two':2,'three':3}";
$json_2 = "{'zero':0,'two':20,'three':3}";

Требуемый результат: zero (отсутствует в первом json), one (отсутствует во втором json), two (имеет разные значение)
*/


        /**
         * @param string $json_1
         * @param string $json_2
         * @return string
         * [ 'absentInFirst'=> ['key1',...], 'absentInSecond'=> ['key2',...]]
         */
        function getdifferentKeys(string $json_1, string $json_2): array
        {
            $different  = [];
            $json_1_arr = json_decode(str_replace("'",'"',$json_1),true);
            $json_2_arr = json_decode(str_replace("'",'"',$json_2),true);
            $different['absentInFirst']  = array_diff_key($json_2_arr,$json_1_arr);
            $different['absentInSecond'] = array_diff_key($json_1_arr,$json_2_arr);
            return $different;
        }

        $json_1 = "{'one':1,'two':2,'three':3}";
        $json_1_arr = json_decode(str_replace("'",'"',$json_1),true);
        $json_2 = "{'zero':0,'two':20,'three':3}";
        $json_2_arr = json_decode(str_replace("'",'"',$json_2),true);

        print_r("<br>--------------------------------<br>");
        var_dump( getdifferentKeys( $json_1,  $json_2));
        print_r("<br>");
        print_r("<br>--------------------------------<br>");




        $response = new Response();
        $response->setContent('');


        return $response;

    }

    /**
     * @Route("/test", name="test")
     */
    public function test(Environment $twig, ServiceManager $sericesManeger)
    {
        $sericesManeger->exec();
        $zps    = $this->getDoctrine()->getRepository(Zp::class)->findAll();
        $arrzp  = [];
        $sum_zp = [];


        foreach ($zps as $zp){
            $year = $zp->getDataPay()->format("Y");
            if(!isset($sum_zp[$year])){$sum_zp[$year] = 0;}
            $sum_zp[$year] += $zp->getSum();
        }
        $esvs      = $this->getDoctrine()->getRepository(Esv::class)->findAll();
        $naviItems = NaviItemList::setList(['Zp'=>'/zp','Esv'=>'/esv','Game'=>'/game']);
        $data      = ['zps'=>$zps,'esvs'=>$esvs,'naviItems'=>$naviItems,'sum_zp'=>$sum_zp];

        return $this->render('buh/index.html.twig',$data);
    }


}
