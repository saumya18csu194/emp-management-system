<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
class User extends Authenticatable
{
    use Notifiable;
    const ROLE_TYPE_ADMIN='admin';
    const ROLE_TYPE_EMPLOYEE='employee';
    const ROLE_TYPE_MANAGER='manager';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    
    protected $fillable = [
       'id','name', 'role','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function find_id($id)
    {
        $user= User::find($id);  
    }
    public function store_user($admin_data)
    {
        self::create($admin_data);
    }
    public function find_managerlist()                  //when admin selects a new manager for employee
    {
        $items = self::where('role',self::ROLE_TYPE_MANAGER)->get();
        return $items;
    }

    public function store_manager($employees_under_manager,$select_manager,$value)             //if new employee is also manager:store details of employees under new manager
    {
          
            $role=array(['role'=>self::ROLE_TYPE_MANAGER]);
            $save=array_merge($select_manager,$role);
            $update= Employee::whereIn('emp_id',$employees_under_manager)
            ->update(array('m_id' => $value)); 
            
           
            
    }
    public function store_employeee($select_emp)      
    {                      
        self::insert($select_emp);
    }
    public function save_admin($update_admin_data,$id)             //save admin data to user table
    {
        $admin=self::where('id',$id)->first() ;
        self::where('id',$admin->id)->update($update_admin_data);  
    }
    public function update_employee_in_user($empid,$data,$id)      
    {
        $user=self::where('id',$empid)->first();
        $user->name=$data['full_name'];
        $user->email=$data['email'];     
        $user->save(); 
    }
    public function delete_user($empid) //Delete employee data from user table
    {   
        self::where('id', $empid)->delete();
        
    }
    public function search_user($search)
    {   
        if($search!=""){
            $employees= self::where('name', 'like', '%'.$search.'%')
                ->where('role', '=', self::ROLE_TYPE_ADMIN)
                ->paginate(2);
                $employees->appends(['search_word' => $search]);
            }     
        else{
            $employees = self::where('role', '=', self::ROLE_TYPE_ADMIN)->paginate(2);
        }
        return $employees;
    }


    public function delete_admin($id)  //Delete admin data from user table
    {
        self::where('id', $id)->delete();
    }
}




