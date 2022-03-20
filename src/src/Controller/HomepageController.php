<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use App\Repository\AccesVilleRepository;

use App\Entity\AccesVille;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function main(): Response
    {
        return $this->render('homepage/main.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    #[Route('/home', name: 'home')]

    public function index(AccesVilleRepository $accesVillerepository): Response
    {
      
        $testsingle = $accesVillerepository->findAvgAccesInformationRegionByRegionName('CORSE');
        $testarray = $accesVillerepository->findVilleIndicesDepartementRegion('Abancourt');
        return $this->render('homepage/homepage.html.twig', [
            'controller_name' => 'HomepageController',
            'testarray' => $testarray,
            'test' => $testsingle
        ]);
    }


    #[Route('/listDatatable', name: 'listDatatable')]

    public function listDatatablesAction(Request $request)
    {
        //dump($request);
        ini_set('memory_limit', '-1');
        // $draw = intval($request->request->get('draw'));
        // $start = $request->request->get('start');
        // $length = $request->request->get('length');
        // $search = $request->request->get('search');
        // $orders = $request->request->get('order');
        // $columns = $request->request->get('columns');
        // foreach ($orders as $key => $order)
        // {
        //     // Orders does not contain the name of the column, but its number,
        //     // so add the name so we can handle it just like the $columns array
        //     $orders[$key]['name'] = $columns[$order['column']]['name'];
        // }
        // $result = $this->getDoctrine()->getRepository(AccesVille::class)->findAll();
        // $result = array_slice($result, 0, 10);










        // dump($request);
        $length = $request->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $request->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $request->get('search');
        $filters = [
            'query' => @$search['value']
        ];




        $results = $this->getDoctrine()->getRepository(AccesVille::class)->findSearch(
            $filters, $start, $length
        );
        // foreach($results as $result => $key)
        // {
        //     $results[$key] = json_encode($result);
        // }
        // $results = json_encode($results);
        dump($results);
        $output = [
            // 'data' => array_slice($results,$start,$length),
            'data' => $results,
            'recordsFiltered' => count($this->getDoctrine()->getRepository(AccesVille::class)->findSearch($filters, 0, false)),
            'recordsTotal' => count($this->getDoctrine()->getRepository(AccesVille::class)->findSearch(array(), 0, false)),
            'iTotalRecords' => count($this->getDoctrine()->getRepository(AccesVille::class)->findSearch($filters, 0, false)),
            'iTotalDisplayRecords' => count($this->getDoctrine()->getRepository(AccesVille::class)->findSearch($filters, 0, false)),
            'draw' => $request->get('draw'),
            'start' => $request->get('start'),
            'length' => $request->get('length'),
        ];


        dump($output);
        // dump($output);

        return new JsonResponse($output);
    }





    public function getRequiredDTData($start, $length, $orders, $search, $columns, $otherConditions)
    {
        // Create Main Query
        $query = $this->createQueryBuilder('accesville');

        // Create Count Query
        $countQuery = $this->createQueryBuilder('accesvill');
        $countQuery->select('COUNT(id)');

        // Create inner joins



        // Fields Search
        foreach ($columns as $key => $column) {
            if ($column['search']['value'] != '') {
                // $searchItem is what we are looking for
                $searchItem = $column['search']['value'];
                $searchQuery = null;

                // $column['name'] is the name of the column as sent by the JS
                switch ($column['name']) {
                    case 'name': {

                        $searchQuery = 'town.name LIKE \'%' . $searchItem . '%\'';
                        break;
                    }
                    case 'postalCode': {
                        $searchQuery = 'town.postalCode LIKE \'%' . $searchItem . '%\'';
                        break;
                    }
                    case 'department': {
                        $searchQuery = 'department.name LIKE \'%' . $searchItem . '%\'';
                        break;
                    }
                    case 'region': {
                        $searchQuery = 'region.name LIKE \'%' . $searchItem . '%\'';
                        break;
                    }

                }

                if ($searchQuery !== null) {
                    $query->andWhere($searchQuery);
                    $countQuery->andWhere($searchQuery);
                }
            }
        }

        // Limit
        $query->setFirstResult($start)->setMaxResults($length);

        // Order
        foreach ($orders as $key => $order) {
            // $order['name'] is the name of the order column as sent by the JS
            if ($order['name'] != '') {
                $orderColumn = null;

                switch ($order['name']) {
                    case 'name': {

                        $orderColumn = 'town.name';
                        break;
                    }
                    case 'postalCode': {
                        $orderColumn = 'town.postalCode';
                        break;
                    }
                    case 'department': {
                        $orderColumn = 'department.name';
                        break;
                    }
                    case 'region': {
                        $orderColumn = 'region.name';
                        break;
                    }

                }

                if ($orderColumn !== null) {
                    $query->orderBy($orderColumn, $order['dir']);
                }
            }
        }

        // Execute
        $results = $query->getQuery()->getResult();
        $countResult = $countQuery->getQuery()->getSingleScalarResult();

        return array(
            "results"         => $results,
            "countResult"    => $countResult
        );
        // Returned objects are of type Town
        $objects = $results["results"];
        // Get total number of objects
        $total_objects_count = $this->repository->count();
        // Get total number of results
        $selected_objects_count = count($objects);
        // Get total number of filtered data
        $filtered_objects_count = $results["countResult"];

        // Construct response
        $response = '{
            "draw": ' . $draw . ',
            "recordsTotal": ' . $total_objects_count . ',
            "recordsFiltered": ' . $filtered_objects_count . ',
            "data": [';

        $i = 0;

        foreach ($objects as $key => $town) {
            $response .= '["';

            $j = 0;
            $nbColumn = count($columns);
            foreach ($columns as $key => $column) {
                // In all cases where something does not exist or went wrong, return -
                $responseTemp = "-";

                switch ($column['name']) {
                    case 'name': {

                        $name = $town->getName();

                        // Do this kind of treatments if you suspect that the string is not JS compatible
                        $name = htmlentities(str_replace(array("\r\n", "\n", "\r"), ' ', $name));

                        // View permission ?
                        if ($this->get('security.authorization_checker')->isGranted('view_town', $town)) {
                            // Get the ID
                            $id = $town->getId();
                            // Construct the route
                            $url = $this->generateUrl('playground_town_view', array('id' => $id));
                            // Construct the html code to send back to datatables
                            $responseTemp = "<a href='" . $url . "' target='_self'>" . $ref . "</a>";
                        } else {
                            $responseTemp = $name;
                        }
                        break;
                    }

                    case 'postalCode': {
                        // We know from the class definition that the postal code cannot be null
                        // But if that werent't the case, its value should have been tested
                        // before assigning it to $responseTemp
                        $responseTemp = $town->getPostalCode();
                        break;
                    }

                    case 'department': {
                        $department = $town->getDepartment();
                        // This cannot happen if inner join is used
                        // However it can happen if left or right joins are used
                        if ($department !== null) {
                            $responseTemp = $department->getName();
                        }
                        break;
                    }
                    case 'region': {
                        $department = $town->getDepartment();
                        if ($department !== null) {
                            $region = $department->getRegion();
                            if ($region !== null) {
                                $responseTemp = $region->getName();

                            }
                            break;
                        }
                }

                // Add the found data to the json
                $response .= $responseTemp;

                if (++$j !== $nbColumn)
                    $response .= '","';
            }

            $response .= '"]';

            // Not on the last item
            if (++$i !== $selected_objects_count)
                $response .= ',';
        }

        $response .= ']}';

        // Send all this stuff back to DataTables
        $returnResponse = new JsonResponse();
        $returnResponse->setJson($response);

        return $returnResponse;
    }
}