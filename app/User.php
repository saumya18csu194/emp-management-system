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
        'name', 'role','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function create_user(Request $request)
    {
        $user=new User();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = bcrypt('pass@admin');
        $user->role='admin';
        $user->save();
    }
    public function store_user(Request $request,$value)
    {
        $user1=new User();
        if($request->input('select_manager')=='On')
        { 
            $user1->id=$value;
            $user1->name=$request->input('full_name');
            $user1->email=$request->input('email');
            $user1->password = bcrypt('pass@manager');
            $user1->role='manager';
            $abcd=$request->input('selectEmp1');
            foreach ($abcd as $a)
            {
                Employee::where('emp_id', $a)->update(array('m_id' => $value));
            }
            $user1->save();
        }
        else
        {
        $user1->id=$value;
        $user1->name=$request->input('full_name');
        $user1->email=$request->input('email');
        $user1->password = bcrypt('pass@employee');
        $user1->role='employee';
        $user1->save();

        }
    }
    public function save_user(Request $request,$id)
    {
        $user = User::find($id); 
        $user->name =$request->get('name');  
        $user->email =$request->get('email');
        $user->password = bcrypt('pass@admin');  
        $user->role='admin';
        $user->save();  
    }
    public function search_user(Request $request)
    {
        $s=User::count();
        $search =  $request->input('q');
        if($search!=""){
            $employees= User::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                ->where('role', '=', 'admin');
            })
            ->paginate(2);
            $employees->appends(['q' => $search]);
        }
        else{
            $employees = User::where('role', '=', 'admin')->paginate(2);
        }
        return $employees;
    }
}
