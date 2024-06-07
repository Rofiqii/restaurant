<?php

namespace App\Http\Controllers\Api\V1;

// use Encore\Admin\Controllers\AdminController;
use App\Http\Controllers\Controller;
// use Encore\Admin\Form;
// use Encore\Admin\Grid;
// use Encore\Admin\Show;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Food;
use App\Models\FoodType;
use Illuminate\Validation\Rule;


use Encore\Admin\Layout\Content;


class FoodsController extends Controller
{
    public function Index(){
        $foods = Food::latest()->get();
        return view("admin.allfoods", compact('foods'));
    }

    public function SearchFood(Request $request)
    {
        $search = $request->search;

        $foods = Food::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
            ->orWhere('name','like',"%$search%");

        })->get();

        return view('admin.allfoods', compact('foods', 'search'));
    }

    public function AddFood(){
        $foodtype = FoodType::latest()->get();
        $typeid = FoodType::latest()->get();
        return view("admin.addfoods", compact("foodtype", "typeid"));
    }

    public function StoreFood(Request $request){
        $request->validate([
            'name' =>'required|unique:foods',
            'price' => 'required',
            'location' =>'required',
            'stars' => 'required',
            'type_id' =>'required',
            'description' =>'required',
            'people' => 'required',
            'selected_people' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('img');
        $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->img->move(public_path('uploads/images'),$img_name);
        $img_url = 'images/' . $img_name;

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Food::insert([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'stars' => $request->stars,
            'type_id' => $request-> type_id,
            'description' => $request-> description,
            'people' => $request-> people,
            'selected_people' => $request-> selected_people,
            'created_at' => $mytime,
            'updated_at' => $mytime,
            'img' => $img_url,
        ]);

        return redirect()->route('allfoods')->with('message', 'Makanan telah berhasil ditambah!');


    }

    public function EditFoodImg($id){
        $foodinfo = Food::findOrFail($id);
        return view('admin.editfoodimg', compact('foodinfo'));
    }

    public function UpdateFoodImg(Request $request){
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('img');
        $img_name = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
        $request->img->move(public_path('uploads/images'),$img_name);
        $img_url = 'images/' . $img_name;

        Food::findOrFail($id)->update([
            'img' => $img_url,
        ]);

        return redirect()->route('allfoods')->with('message', 'Update Foto Makanan Berhasil!');
    }



    public function EditFood($id){

        $foodinfo = Food::findOrFail($id);
        $category_parent = $foodinfo->type_id;
        $parent_title = FoodType::where('id',$category_parent)->first();
        $typeid = FoodType::latest()->get();

        return view('admin.editfood', compact('foodinfo', 'parent_title', 'typeid'));
    }

    public function UpdateFood(Request $request){
        $foodid = $request->id;

        $request->validate([
            'name' => ['required',Rule::unique('foods')->ignore($request->id),],
            'price' => 'required',
            'stars' =>'required',
            'location' => 'required',
            'description' =>'required',
            'type_id' => 'required'
        ]);

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Food::findOrFail($foodid)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stars' => $request->stars,
            'location' => $request->location,
            'description' => $request->description,
            'updated_at' => $mytime,
            'type_id' => $request ->type_id,


        ]);

        return redirect()->route('allfoods')->with('message', 'Update Informasi Makanan Berhasil!');
    }

    public function DeleteFood($id){
        Food::findOrFail($id)->delete();

        return redirect()->route('allfoods')->with('message', 'Penghapusan Makanan Berhasil!');
    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Foods';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Food());
        $grid->model()->latest();
        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
         $grid->column('FoodType.title', __('Category'));
        $grid->column('price', __('Price'));
        //$grid->column('location', __('Location'));
        $grid->column('stars', __('Stars'));
        $grid->column('img', __('Thumbnail Photo'))->image('',60,60);
        $grid->column('description', __('Description'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
            return substr($val,0,30);
        });
        //$grid->column('total_people', __('People'));
       // $grid->column('selected_people', __('Selected'));
        $grid->column('created_at', __('Created_at'));
        $grid->column('updated_at', __('Updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Food::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Food());
        $form->text('name', __('Name'));
          $form->select('type_id', __('Type_id'))->options((new FoodType())::selectOptions());
        $form->number('price', __('Price'));
        $form->text('location', __('Location'));
        $form->number('stars', __('Stars'));
        $form->number('people', __('People'));
        $form->number('selected_people', __('Selected'));
        $form->image('img', __('Thumbnail'))->uniqueName();
        $form->UEditor('description','Description');



        return $form;
    }
}
