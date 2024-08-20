<?php

namespace App\Http\Controllers\Dashbored;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use RealRashid\SweetAlert\Facades\Alert;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('dashboard.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('dashboard.roles/create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'الرجاء ادخل الاسم',
            'name.unique'=>'الاسم  مستخدم مسبقا ',
            'permission.required' => 'الرجاء تحديد الاذونات المستخدم',
        ];
        $this->validate($request, [
            'name' => ['required', 'unique:roles,name'],
            'permission' => 'required'

        ], $messages);

        try {
            DB::transaction(function () use ($request) {

            $role = Role::create(['name' => $request->input('name')]);

            // Retrieve permission models from the provided IDs
            $permissions = Permission::whereIn('id', $request->input('permission'))->get();

            // Sync the permissions with the role
            $role->syncPermissions($permissions);


            });

            Alert::success('تمت عملية إضافة صلاحية بنجاح');
            ActivityLogger::activity($request->name . ":إضافة صلاحية جديد ");
            return redirect()->route('roles');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($request->name . ":فشل عملية إضافة صلاحية جديد ");
            return redirect()->back();
        }
        ;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role_id = decrypt($id);

        $role = Role::find($role_id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$role_id)
            ->get();

        return view('dashboard.roles/show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role_id = decrypt($id);

        $role = Role::find($role_id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role_id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles/edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role_id = decrypt($id);


        $messages = [
            'name.required' => 'الرجاء ادخل الاسم',
            'name.unique'=>'الاسم  مستخدم مسبقا ',
            'permission.required' => 'الرجاء تحديد الاذونات المستخدم',

        ];
        $this->validate($request, [
            'name' => ['required', 'unique:roles,name,'.$role_id],

            'permission' => 'required'

        ], $messages);
        try {
            DB::transaction(function () use ($request,$role_id) {
                $role = Role::find($role_id);
                $role->name = $request->input('name');
                $role->save();
                $permissions = Permission::whereIn('id', $request->input('permission'))->get();

                $role->syncPermissions($permissions);


            });

            Alert::success('تمت عملية تعديل بيانات صلاحية بنجاح');
            ActivityLogger::activity($role_id . ":تعديل صلاحية");
            return redirect()->route('roles');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($role_id . ":فشل عملية تعديل بيانات صلاحية");
            return redirect()->back();
        }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role_id = decrypt($id);
     $roleRelationWithUser=DB::table("model_has_roles")->where("model_has_roles.role_id",$role_id)
    ->where('model_has_roles.model_type',"=","App\User")
    ->where('model_has_roles.model_id',"=",auth()->user()->id)->get();
    if($roleRelationWithUser->count() != 0){
        ActivityLogger::activity($role_id . ":محاوله الغاء صلاحية");
        Alert::warning("لايمكنك الغاء هذه الصلاحية ");
        return redirect()->back();

    }
        try {
            DB::transaction(function () use ($role_id) {

                DB::table("roles")->where('id',$role_id)->delete();
                return redirect()->route('roles');

            });

            Alert::success('تمت عملية الغاء صلاحية بنجاح');
            ActivityLogger::activity($role_id . ":الغاء صلاحية");
            return redirect()->route('roles');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($role_id . ":فشل عملية الغاء صلاحية");
            return redirect()->back();
        }


    }
}
