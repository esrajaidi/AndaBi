<?php
    
namespace App\Http\Controllers\Dashbored;

use App\Http\Controllers\Controller;    
use App\Models\Branche;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;
use File;

    
class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete|user-changestatus', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
         $this->middleware('permission:user-changestatus', ['only' => ['changeStatus']]);

    }

    public function profile($id)
    {
        $user_id = decrypt($id);

        $user = User::find($user_id);
        return view('dashboard.users.profile',compact('user'));
    }
    public function ImageUploadStore(Request $request)
    {
        $request->validate([
            'personal_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {

     
      DB::transaction(function () use ($request) {

        if ($request->hasFile('personal_image')) {
            $user = User::find(Auth::user()->id);

           
            $oldImage=$user->image;
            if($user->image!=null)
            {
                $image_path='images/users/files_'.Auth::user()->username.'/'.$oldImage;
                
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }


            }
            $imageName = 'personal_image'.time().'.'.$request->personal_image->extension();  
            $imagePath='images/users/files_'.Auth::user()->username;
            $request->personal_image->move(public_path($imagePath), $imageName);
            $user->image=$imageName;
            $user->save();
        }
      
      });

      Alert::success(title: 'تمت عملية تحميل الصورة بنجاح');
      ActivityLogger::activity(Auth::user()->id. ": تم تحميل الصورة الشخصية للمستخدم  رقم ");
      return redirect()->back();
  } catch (\Exception $e) {

      Alert::warning($e->getMessage());
      ActivityLogger::activity(Auth::user()->id. ":فشل عملية تحميل الصورة الشخصية للمستخدم رقم ");
      return redirect()->back();
  }
    	
    
       
  
        
    }
    public function index(Request $request)
    {
        ActivityLogger::activity("عرض صفحة كافة المستخدمين");

        $data = User::where('id','!=',auth()->user()->id)->orderBy('id','DESC')->paginate(5);
        return view('dashboard.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('name','name')->all();
        $branches = Branche::where('active', 1)->get();
        return view('dashboard.users.create')
        ->with('roles',$roles)
        ->with('branches',$branches);

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
            'username.required' => 'الرجاء ادخل اسم المستخدم',
            'email.required' => 'الرجاء ادخل البريد الإلكتروني',
            'email.unique'=>'البريد الإلكتروني مستخدم مسبقا ',
            'password.required' => 'الرجاء ادخل كلمة المرور',
            'password.same' => 'كلمة المرور وتاكيد كلمة المرور غير متطابقتين',
            'roles.required' => 'الرجاء تحديد صلاحيات المستخدم',

        ];
        $this->validate($request, [
            'username' => ['required', 'string', 'max:50','unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'same:confirm-password'],
            'roles' => 'required',
            'branches_id' => 'required'


        ], $messages);
    
        try {
            DB::transaction(function () use ($request) {

            
                $user = new User();
                $user->username=$request->username;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                if(in_array("مدير نظام", $request->input('roles'))){
                    $user->branches_id=null;
                }
                else{
                    $user->branches_id=$request->branches_id;

                }
                $user->assignRole($request->input('roles'));
                $user->save();

            });

            Alert::success('تمت عملية إضافة مستخدم بنجاح');
            ActivityLogger::activity($request->name . ":إضافة مستخدم جديد ");
            return redirect()->route('users');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($request->name . ":فشل عملية إضافة مستخدم جديد ");
            return redirect()->back();
        }
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = decrypt($id);

        $user = User::with('branches')->find($user_id);
        return view('dashboard.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = decrypt($id);

        $user = User::find($user_id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $branches = Branche::where('active', 1)->get();

        return view('dashboard.users.edit')
        ->with('user',$user)
        ->with('roles',$roles)
        ->with('userRole',$userRole)
        ->with('branches',$branches);

    }
    
    
    public function update(Request $request, $id)
    {
        $user_id = decrypt($id);

        $messages = [
            'username.required' => 'الرجاء ادخل اسم المستخدم',
            'email.required' => 'الرجاء ادخل البريد الإلكتروني',
            'email.unique'=>'البريد الإلكتروني مستخدم مسبقا ',
            'password.required' => 'الرجاء ادخل كلمة المرور',
            'password.same' => 'كلمة المرور وتأكيد كلمة المرور غير متطابقتين',
            'roles.required' => 'الرجاء تحديد صلاحيات المستخدم',
        ];
        $this->validate($request, [
            'username' => ['required', 'string', 'max:50','unique:users,username,'.$user_id],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$user_id],
            'password' => ['nullable', 'string', 'min:6', 'same:confirm-password'],
            'roles' => 'required',
            'branches_id' => 'required'

        ], $messages);
    
        try {
            DB::transaction(function () use ($request,$user_id) {
                DB::table('model_has_roles')->where('model_id',$user_id)->delete();

                $user = User::find($user_id);
                
                $user->username=$request->username;
                $user->email=$request->email;
                if(!empty($request->password)){ 
                    $user->password=Hash::make($request->password);
                }

                if(in_array("مدير نظام", $request->input('roles'))){
                    $user->branches_id=null;
                }
                else{
                    $user->branches_id=$request->branches_id;

                }

                $user->assignRole($request->input('roles'));
                $user->save();
            
            });

            Alert::success('تمت عملية تعديل بيانات مستخدم بنجاح');
            ActivityLogger::activity($user_id . ":تعديل مستخدم");
            return redirect()->route('users');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($user_id . ":فشل عملية تعديل بيانات مستخدم");
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
        $user_id = decrypt($id);

        try {
            DB::transaction(function () use ($user_id) {

                User::find($user_id)->delete();
                return redirect()->route('users');
            
            });

            Alert::success('تمت عملية الغاءمستخدم بنجاح');
            ActivityLogger::activity($user_id . ":الغاء مستخدم");
            return redirect()->route('users');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($user_id . ":فشل عملية الغاء مستخدم");
            return redirect()->back();
        }
    
    }

    public function changePassword()
    {
       return view('dashboard.users.changepassword');
    }

    public function updatePassword(Request $request)
    {
     
    $messages = [
        'old_password.required' => 'الرجاء ادخل كلمةالمرور القديمة',
        'new_password.required' => 'الرجاء ادخل كلمةالمرور الجديده',
        'new_password.same'=>'كلمة المرور الجديدة وتأكيد كلمة المرور الجديدة غير متطابقين',

    ];
    $this->validate($request, [
        'old_password' => 'required',
        'new_password' => 'required|same:new_password_confirmation',

    ], $messages);
    try {
        DB::transaction(function () use ($request) {
              #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            Alert::error("كلمة المرور القديمة غير متطابقة");
            return back()->with("error", "كلمة المرور القديمة غير متطابقة! ");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        });

        Alert::success('تمت عملية تغير كلمة المرور بنجاح');
        ActivityLogger::activity($request->id . ":تغير كلمة مرور للمستخدم");
        return redirect()->route("home");

    } catch (\Exception $e) {

        Alert::warning($e->getMessage());
        ActivityLogger::activity($request->id . ":فشل عملية تغير كلمه مرور للمستخدم");
        return redirect()->back();
    }
}

public function changeStatus(Request $request, $id)
{
    $user_id = decrypt($id);

    try {
        DB::transaction(function () use ($request, $user_id) {
            $users = User::find($user_id);
            if ($users->active == 1) {
                $active = 0;
            } else {
                $active = 1;
            }

            $users->active = $active;
            $users->save();
        });
        ActivityLogger::activity($user_id . "تغيير حالة  مستخدم:");

        Alert::success('تمت عملية تغيير حالةالمستخدم بنجاح');

        return redirect('users');
    } catch (\Exception $e) {

        Alert::warning($e->getMessage());
        ActivityLogger::activity($user_id . " فشل تغيير حالة  مستخدم");

        return redirect()->back();
    }
}
 
}
