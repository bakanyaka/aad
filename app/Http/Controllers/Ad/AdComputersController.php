<?php

namespace App\Http\Controllers\Ad;

use App\Repositories\IComputerRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AdComputersController extends Controller
{
    //
    protected $computers;

    /**
     * AdComputersController constructor.
     * @param IComputerRepository $computersRepo
     */
    public function __construct(IComputerRepository $computersRepo)
    {
        $this->computers = $computersRepo;
    }

    public function search(Request $request)
    {
        if(!empty($request->input('username'))){
            $result = $this->computers->findByUsername($request->input('username'));
            return response()->json($result);
        }
        return response()->json();
    }

}
