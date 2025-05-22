<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\FoodType;
// use Encore\Admin\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;
use Illuminate\Validation\Rule;

class FoodTypeController extends Controller
{

    public function Index(){
        $cold = FoodType::orderBy('parent_id', 'ASC')->get(
        // ->where('parent_id', 'id')
        );
        // $foodtype = FoodType::whereNull('parent_id', 'ASC')
        // ->paginate(10);
        $foodtype = FoodType::orderBy('parent_id', 'ASC')
        ->where('parent_id', 0)
        ->paginate(10);
        return view("admin.allfoodtype", compact('foodtype', 'cold'));
    }

    // public function SearchFoodType(Request $request)
    // {
    //     $search = $request->search;

    //     $foods = FoodType::where(function ($query) use ($search) {

    //         $query->where('id', 'like', "%$search%")
    //         ->orWhere('title','like',"%$search%")
    //         ->orWhereHas('description','like',"%$search%");

    //     })->get();

    //     return view('admin.allfoods', compact('foods', 'search'));
    // }

    public function AddFoodType(){
        $typeid = FoodType::latest()->get();
        return view("admin.addfoodtype", compact("typeid"));
    }

    public function StoreFoodType(Request $request){
        $request->validate([
            // 'id' => 'required',
            'title' =>'required|unique:food_types,title',
            'parent_id' => 'required',
            'description' => 'required',
            'order' =>'required',


        ]);

        // $category_id = $request->id;
        $parent_id = $request->parent_id;
        // $child_id = $request->parent_id;

        // $category_name = FoodType::where('id', $category_id)->value('title');
        $parent_name = FoodType::where('parent_id', $parent_id)->value('title');

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        FoodType::insert([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'created_at' => $mytime,
            'updated_at' => $mytime,

        ]);

        return redirect()->route('allfoodtype')->with('message', 'Kategori berhasil ditambah!');


    }

    public function EditFoodType($id){
        $category_info = FoodType::findOrFail($id);
        $category_parent = $category_info->parent_id;
        $parent_title = FoodType::where('id',$category_parent)->first();

        $typeid = FoodType::latest()->get();

        return view('admin.editfoodtype', compact('category_info', 'typeid', 'parent_title'));
    }

    public function UpdateFoodType(Request $request){
        $category_id = $request->id;


        $request->validate([
            'title' => ['required',Rule::unique('food_types')->ignore($request->id),],
            'parent_id' => 'required',
            'description' => 'required',
            'order' =>'required',
        ],[
            'title.required' => 'Kolom nama harus diisi'],
        );

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        FoodType::findOrFail($category_id)->update([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'order' => $request->order,
            'updated_at' => $mytime,
        ]);

        return redirect()->route('allfoodtype')->with('message', 'Kategori berhasil diubah!');
    }

    public function DeleteFoodType($id){
        FoodType::findOrFail($id)->delete();

        return redirect()->route('allfoodtype')->with('message', 'Kategori berhasil dihapus!');
    }

    // public function recent(){
    //     try{
    //         $parent = $this->parent->orderBy('id', 'desc')->firstOrFail();
    //         $child= Child::where('parent_id', $parent->id)->get();
    //         return response()->json(['List parent recent' => $parent , 'all child data' => $child], 300);
    //     }catch (ModelNotFoundException){
    //         return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!'], 404 );
    //     }

    // }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Food Type';

    // $foodtype = FoodType::with('children')->get();



    // public function children() {
    //     FoodType::whereNull('parent_id')
    //     ->with(['children'])
    //     ->get();
    // }


    // FoodType::whereNull('parent_id')
    // ->with(['children' => function ($query) {

    // }])
    // ->get();

    // public function Index()
    // {
    //     $foodtype = new Tree(new FoodType);
    //     $foodtypes = FoodType::whereNull('parent_id')
    //     ->with(['asc'])
    //     ->get();

    //     return view("admin.allfoodtype", compact('tree'));
    // }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(FoodType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('order', __('Order'));
        $show->field('created_at', __('Created_at'));
        $show->field('updated_at', __('Updated_at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FoodType());
        $form->select('parent_id', __('Parent Category'))->options((new FoodType())::selectOptions());
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->number('order', __('Order'))->default(1);
        return $form;
    }
}
