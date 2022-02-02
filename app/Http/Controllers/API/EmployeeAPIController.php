<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\User;
use Validator;
use Exception;
use App\Http\Controllers\API\APIBaseController as APIBaseController;

class EmployeeAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchById(Request $request)
    {
        $emp = new Employee();
        try {
            $find_api_id = $request->input('find_api_id');
            $validator = Validator::make($request->all(), ['find_api_id' => 'required',]);
            if ($validator->fails()) {
                return $this->sendError('Employee ID is required');
            }
            $get_results = $emp->findApiId($find_api_id);
            if ($get_results == null) {
                return $this->sendError('failed to find the employee');
            } else {
                return $this->sendResponse($get_results, ' retrieved successfully.');
            }
        } catch (Exception $e) {
            error_log($e);
        }
    }
    public function sortByJoiningDate(Request $request)           //sorting by date employee joined company
    {
        try {
            $emp = new Employee();
            $joining_date_sort = $request->input('joining_date_sort');
            $validator = Validator::make($request->all(), ['joining_date_sort' => 'required',]);
            if ($validator->fails()) {
                return $this->sendError('high_low or low_high is required');
            }
            $get_results = $emp->sortApi($joining_date_sort);
            if ($get_results == null) {
                return $this->sendError('enter high_low or low_high,');
            }
            return $this->sendResponse($get_results, ' retrieved successfully.');
        } catch (Exception $e) {
            error_log($e);
        }
    }
    public function selectRole(Request $request)          //choose role:manager or employee 
    {
        $emp = new Employee();
        try {
            $find_api_role = $request->input('find_api_role');
            $validator = Validator::make($request->all(), ['find_api_role' => 'required',]);
            if ($validator->fails()) {
                return $this->sendError('role(manager or employee) is required');
            }
            $get_results = $emp->findApiRole($find_api_role);
            if ($get_results == null) {
                return $this->sendError('failed to find');
            } else {
                return $this->sendResponse($get_results, ' retrieved successfully.');
            }
        } catch (Exception $e) {
            error_log($e);
        }
    }
    public function searchByName(Request $request)
    {
        $emp = new Employee();
        try {
            $find_api_name = $request->input('find_api_name');
            $validator = Validator::make($request->all(), ['find_api_name' => 'required',]);
            if ($validator->fails()) {
                return $this->sendError('Employee Name is required');
            }
            $get_results = $emp->findApiName($find_api_name);
            if ($get_results == null) {
                return $this->sendError('failed to find the employee');
            } else {
                return $this->sendResponse($get_results, ' retrieved successfully.');
            }
        } catch (Excepton $e) {
            error_log($e);
        }
    }
    public function searchByMail(Request $request)
    {
        try {
            $emp = new Employee();
            $find_api_mail = $request->input('find_api_mail');
            $validator = Validator::make($request->all(), ['find_api_mail' => 'required',]);
            if ($validator->fails()) {
                return $this->sendError('Employee Mail ID is required');
            }
            $get_results = $emp->findApiMail($find_api_mail);
            if ($get_results == null) {
                return $this->sendError('failed to find the employee');
            } else {
                return $this->sendResponse($get_results, ' retrieved successfully.');
            }
        } catch (Exception $e) {
            error_log($e);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
