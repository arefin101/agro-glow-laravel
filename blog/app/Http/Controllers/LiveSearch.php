<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use DB;

class LiveSearch extends Controller
{

    function index1()
    {
      echo 'something....';
     //return view('live_search');
    }

    // function action(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = DB::table('products')
    //      ->where('name', 'like', '%'.$query.'%')
    //      ->get();
         
    //   }
    //   else
    //   {
    //       $data = DB::table('user')
    //     ->orderBy('userName', 'desc')
    //     ->get();
    //   }
    //   $total_row = $data->count();
    //   if($total_row > 0)
    //   {
    //    foreach($data as $row)
    //    {
    //     $output .= '
    //     <tr>
    //         <td>'.$row->productName.'</td>
    //         <td>'.$row->description.'</td>
    //         <td>'.$row->price.'</td>
    //         <td>'.$row->quantity.'</td>
    //         <td>'.$row->expDate.'</td>
    //         <td>
    //             <a href="/home/Edit_Product/'.$row->id.'" class="btn btn-primary">Edit</a>
    //             <a href="/home/Delete_Product/'.$row->id.'" class="btn btn-danger">Delete</a>
    //         </td>
    //     </tr>
    //     ';
    //    }
    //   }
    //   else
    //   {
    //    $output = '
    //    <tr>
    //     <td align="center" colspan="5">No Data Found</td>
    //    </tr>
    //    ';
    //   }
    //   $data = array(
    //    'table_data'  => $output,
    //   );

    //   echo json_encode($data);
    //  }
    // }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('products')
         ->where('productName', 'like', '%'.$query.'%')
         ->get();
         
      }
      else
      {
       $data = product::all();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
        <td>'.$row->productName.'</td>
                 <td>'.$row->description.'</td>
                <td>'.$row->price.'</td>
                 <td>'.$row->quantity.'</td>
                 <td>'.$row->expDate.'</td>
                 <td>
                    <a href="/home/Edit_Product/'.$row->id.'" class="btn btn-primary">Edit</a>
                     <a href="/home/Delete_Product/'.$row->id.'" class="btn btn-danger">Delete</a>
                 </td>
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
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

}
