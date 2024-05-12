<?php

namespace App\Http\Controllers\Admin;

// use Encore\Admin\Controllers\AdminController;
use App\Http\Controllers\Controller;
// use Encore\Admin\Form;
// use Encore\Admin\Grid;
// use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodType;


use Encore\Admin\Layout\Content;


class FoodsController extends Controller
{
    public function Index(){
        $foods = Food::latest()->get();
        return view("admin.allfoods", compact('foods'));
    }

    public function AddFood(){
        $foodtype = FoodType::latest()->get();
        return view("admin.addfoods", compact("foodtype"));
    }

    public function StoreFood(Request $request){
        $request->validate([
            'name' =>'required|unique:foods',
            'price' => 'required',
            'quantity' =>'required',
            'product_short_des' => 'required',
            'product_long_des' =>'required',
            'product_category_id' => 'required',
            'product_subcategory_id' =>'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' => $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ','-', $request->product_name)),

        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allfood')->with('message', 'Produk berhasil ditambah!');


    }

    public function EditFoodImg($id){
        $foodinfo = Food::findOrFail($id);
        return view('admin.editfoodimg', compact('foodinfo'));
    }

    public function UpdateFoodImg(Request $request){
        $request->validate([
            'food_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('food_img');
        $img_name = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
        $request->food_img->move(public_path('uploads/images'),$img_name);
        $img_url = 'uploads/images' . $img_name;

        Food::findOrFail($id)->update([
            'food_img' => $img_url,
        ]);

        return redirect()->route('allfoods')->with('message', 'Update Foto Makanan Berhasil!');
    }



    public function EditFood($id){
        // $category_info = FoodType::findOrFail($id);
        $foodinfo = Food::findOrFail($id);
        $category_parent = $foodinfo->type_id;
        $parent_title = FoodType::where('id',$category_parent)->first();
        $typeid = FoodType::latest()->get();
        return view('admin.editfood', compact('foodinfo', 'parent_title', 'typeid'));
        // return view('admin.editfood', compact('foodinfo'));
    }

    public function UpdateFood(Request $request){
        $foodid = $request->id;

        $request->validate([
            'name' =>'required|unique:foods',
            'price' => 'required',
            'stars' =>'required',
            'location' => 'required',
            'description' =>'required',
        ]);

        Food::findOrFail($foodid)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stars' => $request->stars,
            'location' => $request->location,
            'description' => $request->description,
            // 'slug' => strtolower(str_replace(' ','-', $request->product_name)),

        ]);

        return redirect()->route('allfoods')->with('message', 'Update Informasi Makanan Berhasil!');
    }

    public function DeleteFood($id){
        $cat_id=Food::where('id',$id)->value('type_id');
        // $subcat_id=Product::where('id',$id)->value('product_subcategory_id');
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
