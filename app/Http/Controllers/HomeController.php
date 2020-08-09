<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Building;
use App\Group;
use App\Section;
use App\ItemGroup;
use App\Item;
use App\User;
use App\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        $data = auth()->user();
        $data->building = $data->building()->first();
        $data->building->sectionGroups = $data->building->sectionGroups()->get();
        foreach($data->building->sectionGroups as $sectionGroup){
            $sectionGroup->itemGroups = $sectionGroup->itemGroups()->get();
            $sectionGroup->totalItemCount = $sectionGroup->items()->count();
            $sectionGroup->totalActiveItemCount = $sectionGroup->items()->where('status', 1)->count();
        }
        $data->totalSectionGroupCount = Building::find($data->building_id)->sectionGroups()->count();
        $data->totalSectionCount = Building::find($data->building_id)->sections()->count();
        $data->totalItemGroupCount = Building::find($data->building_id)->itemGroups()->count();
        $data->totalItemCount = Building::find($data->building_id)->items()->count();
        $data->totalUserCount = Building::find($data->building_id)->users()->count();

        
        
        return response()->json([
            'success' => true,
            'user' => $data,
        ]);
    }


    function getSections($group){
        $user = auth()->user();
        $group = Group::find($group);
        $group->sections = $group->sections()->get();

        foreach($group->sections as $section){
            $section->totalItemGroupCount = $section->totalItemGroupCount();
            $section->totalItemCount = $section->totalItemCount();
            $section->totalActiveItemCount = $section->items()->where('status', 1)->count();
        }
        return response()->json([
            'success' => true,
            'group' => $group,
        ]);
    }

    function getSection($group, $section){
        $user = auth()->user();
        $section = Section::find($section);
        $section->itemGroups = $section->itemGroups()->get();
        $section->sectionGroup = $section->sectionGroup()->first();

        foreach($section->itemGroups as $itemGroup){
            $itemGroup->totalItemCount = $itemGroup->totalItemCount();
            $itemGroup->totalActiveItemCount = $itemGroup->items()->where('status', 1)->count();
        }
        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    function getItems($group, $section, $itemGroup){
        $user = auth()->user();
        $section = Section::find($section);
        $section->sectionGroup = $section->sectionGroup()->first();
        $section->itemGroup = ItemGroup::find($itemGroup);
        $section->itemGroup->items = $section->itemGroup->items()->get();
        foreach($section->itemGroup->items as $data){
            $data->access = 0;
            $check = Permission::where('user_id', $user->id)
                ->where('item_id', $data->id)->first();
            if($check){
                $data->access = 1;
            } 
        }

        foreach($section->itemGroups as $itemGroup){
            $itemGroup->totalItemCount = $itemGroup->totalItemCount();
            $itemGroup->totalActiveItemCount = $itemGroup->items()->where('status', 1)->count();
        }
        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    function changeItemState($item){
        $user = auth()->user();
        if($user->role != 'admin' || $user->role != 'super admin'){
            $item = Item::find($item);
            if($item->building_id == $user->building_id){
                if($item->status == 1){
                    $item->status = 0;
                }else{
                    $item->status = 1;
                }

                if($item->update()){
                    return response()->json([
                        'success' => true,
                        'item' => $item,
                    ]);
                }
            }
        }
    }

    function updateProfile(Request $request){
        $user = auth()->user();

        $user = User::find($user->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];

            if($user->update()){
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function changePassword(Request $request){

        $user = User::find(auth()->user()->id);

        // dd($user->password);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->update();

        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function adminIndex(){
        $data = auth()->user();
        $data->building = $data->building()->first();
        $data->building->sectionGroups = $data->building->sectionGroups()->get();
        foreach($data->building->sectionGroups as $sectionGroup){
            $sectionGroup->itemGroups = $sectionGroup->itemGroups()->get();
            $sectionGroup->totalItemCount = $sectionGroup->items()->count();
            $sectionGroup->totalActiveItemCount = $sectionGroup->items()->where('status', 1)->count();

        }
        $sectionGroups = Group::where('building_id', $data->building_id)->get();

        foreach($sectionGroups as $data){
            $data->totalSectionCount = $data->totalSectionCount();
            $data->totalItemCount = $data->totalItemCount();
        }
        $sections = Section::where('building_id', $data->building_id)->get();
        foreach($sections as $data){
            $data->sectionGroup = $data->sectionGroup()->first();
            $data->totalItemGroupCount = $data->totalItemGroupCount();
            $data->totalItemCount = $data->totalItemCount();
        }
        $itemGroups = ItemGroup::where('building_id', $data->building_id)->get();
        foreach($itemGroups as $data){
            $data->totalItemCount = $data->totalItemCount();
        }
        $items = Item::with(['section', 'itemGroup', 'sectionGroup'])->where('building_id', $data->building_id)->get();
        $users = User::where('building_id', $data->building_id)->get();
        foreach($users as $user){
            $user->sectionGroups = Group::where('building_id', $data->building_id)->get();
        
            foreach($user->sectionGroups as $data){
                $data->access = 0;
                $check = Permission::where('user_id', $user->id)
                    ->where('section_group_id', $data->id)->first();
                if($check){
                    $data->access = 1;
                } 

                $data->sections = Section::where('building_id', $data->building_id)
                                    ->where('section_group_id', $data->id)->get();
                foreach($data->sections as $data){
                    $data->access = 0;
                    $check = Permission::where('user_id', $user->id)
                        ->where('section_id', $data->id)->first();
                    if($check){
                        $data->access = 1;
                    } 
                    $data->itemGroups = ItemGroup::where('building_id', $data->building_id)
                        ->where('section_id', $data->id)->get();
                    foreach($data->itemGroups as $data){
                        $data->access = 0;
                        $check = Permission::where('user_id', $user->id)
                            ->where('item_group_id', $data->id)->first();
                        if($check){
                            $data->access = 1;
                        } 
                        $data->items = Item::where('building_id', $data->building_id)
                                        ->where('item_group_id', $data->id)->get();  
                        foreach($data->items as $data){
                            $data->access = 0;
                            $check = Permission::where('user_id', $user->id)
                                ->where('item_id', $data->id)->first();
                            if($check){
                                $data->access = 1;
                            }         
                        }              
                    }
                }

            }
        }
        
        return response()->json([
            'success' => true,
            'sectionGroups' => $sectionGroups,
            'sections' => $sections,
            'itemGroups' => $itemGroups,
            'items' => $items,
            'users' => $users,
        ]);
    }

    function addUser(Request $request){
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $newUser = new User();
        $newUser->building_id = $user->building_id;
        $newUser->name = $request['name'];
        $newUser->email = $request['email'];
        $newUser->phone = $request['phone'];
        $newUser->role = $request['role'];
        if($newUser->role == null){
            $newUser->role = 'member';
        }
        $newUser->password = bcrypt($request['password']);
        if($newUser->save()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function updateUser(Request $request){
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required'],
            'role' => ['required'],
        ]);

        $oldUser = User::find($request['id']);
        $oldUser->building_id = $user->building_id;
        $oldUser->name = $request['name'];
        $oldUser->email = $request['email'];
        $oldUser->phone = $request['phone'];
        $oldUser->role = $request['role'];
        if($oldUser->update()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function deleteUser(Request $request){
        $user = auth()->user();
        $oldUser = User::find($request['id']);
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $oldUser->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function grantUserAccess(Request $request){
        $user = auth()->user();
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $user1 = User::find($request['user']);
            $item = Item::find($request['item']);


            $check = Permission::where('user_id', $user1->id)
                ->where('item_id', $item->id)->first();
            if(!$check){
                $permit = new Permission();
                $permit->user_id = $user1->id;
                $permit->building_id = $item->building_id;
                $permit->section_group_id = $item->section_group_id;
                $permit->section_id = $item->section_id;
                $permit->item_group_id = $item->item_group_id;
                $permit->item_id  = $item->id;
                $permit->save();
            }else{
                $check->delete();
            }

            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
    

    // Start section group
    function addSectionGroup(Request $request){
        $user = auth()->user();

        $group = new Group();
        $group->building_id = $user->building_id;
        $group->name = $request['name'];
        $group->icon = $request['icon'];
        if($group->save()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function updateSectionGroup(Request $request){
        $user = auth()->user();

        $group = Group::find($request['id']);
        $group->name = $request['name'];
        $group->icon = $request['icon'];
        if($group->update()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function deleteSectionGroup(Request $request){
        $user = auth()->user();
        $group = Group::find($request['id']);
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $group->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
    // End section group

    function addSection(Request $request){
        $user = auth()->user();

        $section = new Section();
        $section->building_id = $user->building_id;
        $section->name = $request['name'];
        $section->section_group_id = $request['sectionGroup'];
        $section->icon = $request['icon'];
        if($section->save()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function updateSection(Request $request){
        $user = auth()->user();

        $section = Section::find($request['id']);
        $section->name = $request['name'];
        $section->section_group_id = $request['section_group_id'];
        $section->icon = $request['icon'];
        $section->icon_color = $request['icon_color'];
        if($section->update()){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function deleteSection(Request $request){
        $user = auth()->user();
        $section = Section::find($request['id']);
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $section->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    // Start Item
    function addItem(Request $request){
        $user = auth()->user();

        $itemGroup = ItemGroup::find($request['itemGroup']);
        if($itemGroup){
            $item = new Item();
            $item->building_id = $user->building_id;
            $item->name = $request['name'];
            $item->item_code = $request['item_code'];
            $item->section_group_id = $itemGroup->section_group_id;
            $item->section_id = $itemGroup->section_id;
            $item->item_group_id = $itemGroup->id;
            $item->icon = $request['icon'];
            $item->icon_color = $request['icon_color'];
            if($item->save()){
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function updateItem(Request $request){
        $user = auth()->user();

        $itemGroup = ItemGroup::find($request['itemGroup']);
        if($itemGroup){
            $item = Item::find($request['id']);
            $item->name = $request['name'];
            $item->item_code = $request['item_code'];
            $item->section_group_id = $itemGroup->section_group_id;
            $item->section_id = $itemGroup->section_id;
            // $item->item_group_id = $itemGroup->id;
            $item->icon = $request['icon'];
            $item->icon_color = $request['icon_color'];
            if($item->update()){
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function deleteItem(Request $request){
        $user = auth()->user();
        $item = Item::find($request['id']);
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $item->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
    

    // Start section group
    function addItemGroup(Request $request){
        $user = auth()->user();
        $section = Section::find($request['section']);
        if($section){
            $itemGroup = new ItemGroup();
            $itemGroup->building_id = $user->building_id;
            $itemGroup->name = $request['name'];
            $itemGroup->icon = $request['icon'];
            $itemGroup->section_group_id = $section->section_group_id;
            $itemGroup->section_id = $section->id;
            // $itemGroup->icon_color = $request['icon_color'];
            if($itemGroup->save()){
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function updateItemGroup(Request $request){
        $user = auth()->user();

        $section = Section::find($request['section_id']);
        if($section){
            $itemGroup = ItemGroup::find($request['id']);
            $itemGroup->name = $request['name'];
            $itemGroup->icon = $request['icon'];
            $itemGroup->section_group_id = $section->section_group_id;
            $itemGroup->section_id = $section->id;
            $itemGroup->icon_color = $request['icon_color'];
            if($itemGroup->update()){
                return response()->json([
                    'success' => true,
                ]);
            }else{
                return response()->json([
                    'success' => false,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    function deleteItemGroup(Request $request){
        $user = auth()->user();
        $itemGroup = ItemGroup::find($request['id']);
        if($user->role == 'admin'|| $user->role == 'super admin'){
            $itemGroup->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
    // End section group
}
