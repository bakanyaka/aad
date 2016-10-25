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

    public function index()
    {
        if (!request()->ajax()) {
            return view('ad.computers.index');
        } else {
            return response()->json();
        }
    }

    public function search(Request $request)
    {
        if ($request->has('username')) {
            $result = $this->computers->findByUsername($request->input('username'));
            return response()->json($result);
        }
        return response()->json();
    }

}
