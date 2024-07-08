<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FbLeadsModel;
use App\Models\CacLeadsModel;
use App\Models\WvMrktLeads;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fbleads = FbLeadsModel::all();
        $cacleads = CacLeadsModel::all();
        $mrktleads = WvMrktLeads::all();
        return view('home', ['leads' => $fbleads, 'cacleads' => $cacleads, 'mrktleads' => $mrktleads]);
    }

    /**
     * Show all  WV leads
     */
    public function wvleads () {
        $fbleads = FbLeadsModel::paginate(12);
        $count = FbLeadsModel::count();
        return view('wvleads', ['leads' => $fbleads, 'count' => $count]);
    }

    /**
     * Show all  WV leads
     */
    public function cacleads () {
        $cacleads = CacLeadsModel::paginate(12);
        $count = CacLeadsModel::count();
        return view('cacleads', ['leads' => $cacleads, 'count' => $count]);
    }

    /**
     * Show all WV market Leads
     */
    public function wvmarket () {
        $mrktleads = WvMrktLeads::paginate(12);
        $count = WvMrktLeads::count();
        return view('mrktleads', ['leads' => $mrktleads, 'count' => $count]);
    }

    /**
     * Show remove leads page
     */
    public function removeLeads () {
        return view('remove');
    }

    /**
     * Method to remove leads
     * from CAC leads table
     * 
     * @param int $st $nd
     * 
     * @return confirmation msg
     */
    public function removecac ($st, $nd) {
        $range = CacLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->get();
        if (count($range) == 0) {
            return \redirect('remove')->with('status', 'Range does not exist');
        } else {
            CacLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->delete();
            return \redirect('remove')->with('status', 'Data deleted successfully');
        }
    }

    /**
     * Method to remove leads
     * from WV leads table
     * 
     * @param int $st $nd
     * 
     * @return confirmation msg
     */
    public function removewv ($st, $nd) {
        $range = FbLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->get();
        if (count($range) == 0) {
            return \redirect('remove')->with('status', 'Range does not exist');
        } else {
            FbLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->delete();
            return \redirect('remove')->with('status', 'Data deleted successfully');
        }
    }

    /**
     * Method to remove leads
     * from WV Market leads table
     * 
     * @param int $st $nd
     * 
     * @return confirmation msg
     */
    public function removemrkt ($st, $nd) {
        $range = WvMrktLeads::where('id', '>=', $st)->where('id', '<=', $nd)->get();
        if (count($range) == 0) {
            return \redirect('remove')->with('status', 'Range does not exist');
        } else {
            WvMrktLeads::where('id', '>=', $st)->where('id', '<=', $nd)->delete();
            return \redirect('remove')->with('status', 'Data deleted successfully');
        }
    }
}
