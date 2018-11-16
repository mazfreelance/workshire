<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jobPost;

class LivesearchController extends Controller
{
    public function index(){
    	return view('live_search');
    }

    function action(Request $request)
	{
		if($request->ajax())
		{
			$output = '';
			$query = $request->get('cite');
	      	if($query != '')
	      	{
				$data = jobPost::where('jobpost_refNumber', 'like', '%'.$query.'%') 
				->orWhere('jobpost_loc_city', 'like', '%'.$query.'%')
				->orWhere('jobpost_loc_state', 'like', '%'.$query.'%')
				->orWhere('jobpost_position', 'like', '%'.$query.'%')
				->orWhere('job_noofvacancy', 'like', '%'.$query.'%')
				->orderBy('id', 'desc')
   				->get();	
			}
	      	else
	      	{
				$data = jobPost::orderBy('id', 'desc')->get();
	      	}
	      	$total_row = $data->count();
	      	if($total_row > 0)
	      	{
	       		foreach($data as $row)
	       		{
					$output .= '
					<tr>
					<td>'.$row->jobpost_refNumber.'</td>
					<td>'.$row->jobpost_loc_city.'</td>
					<td>'.$row->jobpost_loc_state.'</td>
					<td>'.$row->jobpost_position.'</td>
					<td>'.$row->job_noofvacancy.'</td>
					</tr>
					';
	       		}
	      	}
	      	else
	      	{
				$output = '
				<tr>
				<td align="center" colspan="5">No Data Found</td>
				</tr>
				';
	      	}
			$data = array(
			'table_data'  => $output,
			'total_data'  => $total_row,
			'all'  => $data
			);

      		echo json_encode($data);
		}
    }
}
