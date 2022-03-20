<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use App\Repository\AccesVilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/home', name: 'home')]

    public function index(AccesVilleRepository $accesVillerepository): Response
    {
        $test = $accesVillerepository->findAvgAccesNumeriqueDepartementByDepartementName('VAL DE MARNE');
        return $this->render('homepage/homepage.html.twig', [
            'controller_name' => 'HomepageController',
            'test' => $test
        ]);
    }

    #[Route('/listDatatable', name: 'listDatatable')]

    public function listDatatablesAction(Request $request): JsonResponse
    {
        if ($request->getMethod() == 'POST') {
            $draw = intval($request->request->get('draw'));
            $start = $request->request->get('start');
            $length = $request->request->get('length');
            $search = $request->request->get('search');
            $orders = $request->request->get('order');
            $columns = $request->request->get('columns');
        } else // If the request is not a POST one, die hard
        {
            die;
        }

        // Process Parameters

        // Orders
        foreach ($orders as $key => $order) {
            // Orders does not contain the name of the column, but its number,
            // so add the name so we can handle it just like the $columns array
            $orders[$key]['name'] = $columns[$order['column']]['name'];
        }

        // Further filtering can be done in the Repository by passing necessary arguments
        $otherConditions = "array or whatever is needed";

        // Get results from the Repository
        $results = $this->repository->getRequiredDTData($start, $length, $orders, $search, $columns, $otherConditions = null);
    }

    public function getRequiredDTData($start, $length, $orders, $search, $columns, $otherConditions)
    {
        // Create Main Query
        $query = $this->createQueryBuilder('town');

        // Create Count Query
        $countQuery = $this->createQueryBuilder('town');
        $countQuery->select('COUNT(town)');

        // Create inner joins
        $query
            ->join('town.department', 'department')
            ->join('department.region', 'region');

        $countQuery
            ->join('town.department', 'department')
            ->join('department.region', 'region');

        // Other conditions than the ones sent by the Ajax call ?
        if ($otherConditions === null) {
            // No
            // However, add a "always true" condition to keep an uniform treatment in all cases
            $query->where("1=1");
            $countQuery->where("1=1");
        } else {
            // Add condition
            $query->where($otherConditions);
            $countQuery->where($otherConditions);
        }

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
