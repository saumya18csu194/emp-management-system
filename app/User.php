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
    public function findId($id)
    {
        $user= User::find($id);  
    }

    public function storeUser($admin_data)
    {
        self::create($admin_data);
    }

    public function findManagerList()                  //when admin selects a new manager for employee
    {
        $items = self::where('role',self::ROLE_TYPE_MANAGER)->get();
        return $items;
    }
    public function storeManager($select_manager)   //if new employee is manager
    {          
            self::insert($select_manager);              
    }
    public function storeEmployeee($select_emp)      
    {                      
        self::insert($select_emp);
    }

    public function saveAdmin($update_admin_data,$id)             //save admin data to user table
    {
        $admin=self::where('id',$id)->first() ;
        self::where('id',$admin->id)->update($update_admin_data);  
    }

    public function updateEmployeeInUser($empid,$data)      
    {
        $user=self::where('id',$empid)->first();
        $user->name=$data['full_name'];
        $user->email=$data['email'];     
        $user->save(); 
    }

    public function deleteUser($empid) //Delete employee data from user table
    {   
        self::where('id', $empid)->delete();       
    }

    public function searchUser($search)
    {   
        if($search!="")
        {
            $employees= self::where('name', 'like', '%'.$search.'%')
                ->where('role', '=', self::ROLE_TYPE_ADMIN)
                ->paginate(2);
                $employees->appends(['search_word' => $search]);
        }     
        else
        {
            $employees = self::where('role', '=', self::ROLE_TYPE_ADMIN)->paginate(2);
        }
        return $employees;
    }

    public function deleteAdmin($id)  //Delete admin data from user table
    {
        self::where('id', $id)->delete();
    }
}




