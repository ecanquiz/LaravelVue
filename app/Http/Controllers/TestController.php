<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class TestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function interestOnArrears(Request $request)
    {        
        return Inertia::render("Tests/InterestOnArrears");        
    }
    
    public function interestOnArrearsTest(Request $request)
    {
        $numberOfMonths = $request->numberOfMonths ? $request->numberOfMonths : 1;
        
        $interests=self::_monthlyInterestAccumulation($request->capital, 3, $numberOfMonths);
        $totalInterest = $interests[count($interests)-1]["total"];

        return response()->json([
            "interests"=> self::_monthlyInterestAccumulation($request->capital, 3, $numberOfMonths),
            "totalInterest" => $totalInterest,
            "success" => "Prueba resuelta."
        ], 200); 
    }
    
    static private function _monthlyInterestAccumulation($capital, $xpercent, $numberOfMonths)
    {
        $result = [];
        $total = 0;
        $interest = 0;

        for ($i = 0; $i < $numberOfMonths; $i++) {
            $interest = self::_monthlyInterestCalculation($capital, $xpercent);
            $total += $interest;
            $result[] = [
              "interest" => $interest,
              "total" => $total
            ];            
        }
        
        return $result;
    }

    static private function _monthlyInterestCalculation($capital, $xpercent)
    {
        $xpercent = $xpercent/100;
        
        return (($capital*$xpercent)/360)*30;
    }
}
