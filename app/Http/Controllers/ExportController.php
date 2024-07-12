<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\FbLeadsModel;
use App\Models\CacLeadsModel;
use App\Models\WvMrktLeads;
use App\Models\WvCityModel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportLeads() {
        return view('export');
    }

    /**
     * Method to export Walmart leads
     * to csv file for download
     * @param $st $nd int range
     */
    public function exportToCsv ($st, $nd) {
        $uniqueval = [];
        $duplicates = [];

        // Get the list of cities to be included
        $cities = WvCityModel::pluck('city');
        $range = FbLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('phone', 'id')->toArray();
        $rangeid = FbLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('id')->toArray();
        $leads = FbLeadsModel::whereNotIn('id', $rangeid)->pluck('phone')->toArray();
        
        foreach ($range as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($uniqueval, $k);
            }
        }
        foreach ($rangeid as $x=>$y) {
            if (!in_array($y, $uniqueval)) {
                array_push($duplicates, $y);
            }
        }
        
        /**
         * Dataset for all unique leads in the given range
         */
        $data = FbLeadsModel::whereIn('id', $this->filterEmails($uniqueval))->whereIn('city', $cities)->get();

        /**
         * find duplicate row IDs
         */
        $dataid = FbLeadsModel::whereIn('id', $this->filterEmails($uniqueval))->whereIn('city', $cities)->pluck('id')->toArray();
        $dupids = array_diff($rangeid, $dataid);

        /**
         * Dataset of duplicate rows in the given range
         */
        $dups = FbLeadsModel::whereIn('id', $dupids)->get();

        if (count($data) == 0){
            return redirect()->back()->with('error', 'No unique row found in range');
        }

        $fileName = 'leads.csv';
        $headers = array(
            "Content-type"        => "text/csv;charset=UTF-8",
            "Content-Encoding"    => "UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('Platform', 'Business Name', 'Full Name', 'Business Sector', 'State', 'City', 'Phone', 'Email', 'Create Dt');

        $callback = function() use($data, $dups, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fwrite($file, "Unique values"."\n");
            fputcsv($file, $columns);
            foreach ($data as $task) {
                fputcsv($file, [
                    $task->platform,
                    $task->business_name,
                    $task->full_name,
                    $task->business_sector,
                    $task->state,
                    $task->city,
                    substr($task->phone, -10),
                    $task->email,
                    $task->created_at
                ]);
            }

            /**
             * Write duplicate entries to the file
             */
            fwrite($file, "\n"."Duplicates"."\n");
            fputcsv($file, $columns);
            foreach ($dups as $task) {
                fputcsv($file, [
                    $task->platform,
                    $task->business_name,
                    $task->full_name,
                    $task->business_sector,
                    $task->state,
                    $task->city,
                    substr($task->phone, -10),
                    $task->email,
                    $task->created_at
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Method to export data to csv file
     * from CAC table
     * with unique phone and email
     */
    public function exportCsvData ($st, $nd) {
        $uniqueval = [];
        $duplicates = [];
        $range = CacLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('phone', 'id')->toArray();
        $rangeid = CacLeadsModel::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('id')->toArray();
        $leads = CacLeadsModel::whereNotIn('id', $rangeid)->pluck('phone')->toArray();
        foreach ($range as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($uniqueval, $k);
            }
        }

        foreach ($rangeid as $x=>$y) {
            if (!in_array($y, $uniqueval)) {
                array_push($duplicates, $y);
            }
        }

        /**
         * Dataset for all unique leads in the given range
         */
        $data = CacLeadsModel::whereIn('id', $this->filterCacEmails($uniqueval))->get()->unique('phone');

        /**
         * Dataset of duplicate rows in the given range
         */
        $dups = CacLeadsModel::whereIn('id', $duplicates)->get();

        if (count($data) == 0){
            return redirect()->back()->with('error', 'No unique row found in range');
        }

        $fileName = 'leads.csv';
        $headers = array(
            "Content-type"        => "text/csv;charset=UTF-8",
            "Content-Encoding"    => "UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('Form', 'Platform', 'State', 'City', 'Full Name', 'Company', 'Phone', 'Email', 'Create Dt');

        $callback = function() use($data, $dups, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fwrite($file, "Enique values"."\n");
            fputcsv($file, $columns);
            foreach ($data as $task) {
                fputcsv($file, [
                    $task->form_name,
                    $task->platform,
                    $task->state,
                    $task->city,
                    $task->first_name.' '.$task->last_name,
                    $task->company_name,
                    substr($task->phone, -10),
                    $task->email,
                    $task->created_at
                ]);
            }

            /**
             * Write duplicate entries to the file
             */
            fwrite($file, "\n"."Duplicates"."\n");
            fputcsv($file, $columns);
            foreach ($dups as $task) {
                fputcsv($file, [
                    $task->form_name,
                    $task->platform,
                    $task->state,
                    $task->city,
                    $task->first_name.' '.$task->last_name,
                    $task->company_name,
                    substr($task->phone, -10),
                    $task->email,
                    $task->created_at
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export WV Market Leads
     * to csv files and download
     */
    public function exportMrktData ($st, $nd) {
        $uniqueval = [];
        $duplicates = [];
        $range = WvMrktLeads::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('phone', 'id')->toArray();
        // dd($range);
        $rangeid = WvMrktLeads::where('id', '>=', $st)->where('id', '<=', $nd)->pluck('id')->toArray();
        $leads = WvMrktLeads::whereNotIn('id', $rangeid)->pluck('phone')->toArray();
        
        foreach ($range as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($uniqueval, $k);
            }
        }

        foreach ($rangeid as $x=>$y) {
            if (!in_array($y, $uniqueval)) {
                array_push($duplicates, $y);
            }
        }

        /**
         * Dataset for all unique leads in the given range
         */
        $data = WvMrktLeads::whereIn('id', $this->filterMrktEmails($uniqueval))->get()->unique('phone');

        /**
         * Dataset of duplicate rows in the given range
         */
        $dups = WvMrktLeads::whereIn('id', $duplicates)->get();

        if (count($data) == 0){
            return redirect()->back()->with('error', 'No unique row found in range');
        }

        $fileName = 'WvMrktleads.csv';
        $headers = array(
            "Content-type"        => "text/csv;charset=UTF-8",
            "Content-Encoding"    => "UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ID', 'Platform', 'Exporting', 'Ecommerce experience', 'Enterprise', 'Business name', 'Business type', 'Here about us', 'Full name', 'Phone', 'Email', 'City', 'State', 'Status',  'Create Dt');

        $callback = function() use($data, $dups, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fwrite($file, "Enique values"."\n");
            fputcsv($file, $columns);
            foreach ($data as $task) {
                fputcsv($file, [
                    $task->id,
                    $task->platform,
                    $task->exporting,
                    $task->ecommexp,
                    $task->enterprise,
                    $task->business_name,
                    $task->business_type,
                    $task->hereabtus,
                    $task->full_name,
                    substr($task->phone, -10),
                    $task->email,
                    $task->city,
                    $task->state,
                    $task->status,
                    $task->created_at
                ]);
            }

            /**
             * Write duplicate entries to the file
             */
            fwrite($file, "\n"."Duplicates"."\n");
            fputcsv($file, $columns);
            foreach ($dups as $task) {
                fputcsv($file, [
                    $task->id,
                    $task->platform,
                    $task->exporting,
                    $task->ecommexp,
                    $task->enterprise,
                    $task->business_name,
                    $task->business_type,
                    $task->hereabtus,
                    $task->full_name,
                    substr($task->phone, -10),
                    $task->email,
                    $task->city,
                    $task->state,
                    $task->status,
                    $task->created_at
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Method to check for duplicate email
     * in rest of the database and 
     * return ids of unique email IDs
     */
    public function filterEmails($uniqueval) {
        $vals = [];
        $rangemail = FbLeadsModel::whereIn('id', $uniqueval)->pluck('email', 'id')->toArray();
        $rangeid = FbLeadsModel::whereIn('id', $uniqueval)->pluck('id')->toArray();
        $leads = FbLeadsModel::whereNotIn('id', $rangeid)->pluck('email')->toArray();
        foreach ($rangemail as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($vals, $k);
            }
        }
        return $vals;
    }

    public function filterCacEmails($uniqueval) {
        $vals = [];
        $rangemail = CacLeadsModel::whereIn('id', $uniqueval)->pluck('email', 'id')->toArray();
        $rangeid = CacLeadsModel::whereIn('id', $uniqueval)->pluck('id')->toArray();
        $leads = CacLeadsModel::whereNotIn('id', $rangeid)->pluck('email')->toArray();
        foreach ($rangemail as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($vals, $k);
            }
        }
        return $vals;
    }

    public function filterMrktEmails($uniqueval) {
        $vals = [];
        $rangemail = WvMrktLeads::whereIn('id', $uniqueval)->pluck('email', 'id')->toArray();
        $rangeid = WvMrktLeads::whereIn('id', $uniqueval)->pluck('id')->toArray();
        $leads = WvMrktLeads::whereNotIn('id', $rangeid)->pluck('email')->toArray();
        foreach ($rangemail as $k=>$v) {
            if (!in_array($v, $leads)) {
                array_push($vals, $k);
            }
        }
        return $vals;
    }
}
