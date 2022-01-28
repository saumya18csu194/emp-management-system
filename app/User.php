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
    public function find_managerlist()
    {
        $items = self::where('role',self::ROLE_TYPE_MANAGER)->get();
        return $items;
    }

    public function store_manager($abcd,$select_manager,$value)
    {
            $role=array(['role'=>self::ROLE_TYPE_MANAGER]);
            $save=array_merge($select_manager,$role);
            foreach ($abcd as $a)
            {
                Employee::where('emp_id', $a)->update(array('m_id' => $value));
            }
            self::update($save);   
    }
    public function store_employeee($select_emp)
    {
        try
        {            
        $save=array_merge($select_emp);
        self::insert($save);
        }
        catch(Exception $e)
        {
            error_log($e);
        }
    }
    public function save_admin($update_admin_data,$id)
    {
        $admin=self::where('id',$id)->first() ;
        self::where('id',$admin->id)->update($update_admin_data);  
    }
    public function update_employee_in_user($data,$id)
    {
        $user=new self();
        $user->name=$data['name'];
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


    public function delete_admin($emp2)  //Delete admin data from user table
    {
        self::where('id', $emp2)->delete();
    }
}




