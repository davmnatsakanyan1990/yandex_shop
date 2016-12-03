<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index(){
        return view('home');
    }

    public function formatCategories($data){
        $categories = array();

        foreach($data->category as $category) {
            $attributes = $category->attributes();

            $cat = array();

            $cat['name'] = $category;
            $cat['url'] = str_replace(' ', '-', $category);
            $cat['parentUrl'] = " ";
            $cat['description'] = " ";
            $cat['image'] = " ";
            $cat['title_seo'] = " ";
            $cat['keywords_seo'] = " ";
            $cat['description_seo'] = " ";
            $cat['seo_description'] = "";
            $cat['mark_up'] = 0;
            $cat['hide_from_menu'] = 0;
            $cat['activity'] = 1;
            $cat['donot_uplod_yml'] = 1;
            $cat['sorting'] = 1;
            $cat['identifier'] = "";

            foreach($attributes as $key => $val){
                if(count($attributes) == 1) {
                    $cat['parentId'] = 0;
                    $cat['id'] = (int)$val;
                }
                else{
                    $cat[$key] = (int)$val;
                }
            }

            array_push($categories, $cat);
        }

        return $categories;
    }

    public function formatModels($data){
        $models = array();

        foreach($data->model as $model) {
            $attributes = $model->attributes();

            $options = "";
            $index = 0;
            foreach($model->param as $param){
                $p_attrs = $param->attributes();
                foreach($p_attrs as $key => $value){
                    if($key == 'name') {
                        if($p_attrs['unit'])
                            $item = $value . ' ('.$p_attrs['unit'].')='. $param;
                        else
                            $item = $value . '=' . $param;

                    }
                }
                $index++;
                if(count($model->param) == $index)
                    $options.=$item;
                else
                    $options.=$item.'&';

            }

            $arr = explode('/',$model->pictureUrl);
            $length = count($arr);

            $mod = array();

            $mod['name'] = $model->name;
            $mod['category_url'] = "";
            $mod['version'] =  $model->name;
            $mod['description'] = $model->description;
            $mod['price'] = 15;
            $mod['url'] = str_replace(' ', '-', $model->name);
            $mod['image'] = $arr[$length-1];
            $mod['vendor_code'] = $model->vendorCode;
            $mod['count'] = 10;
            $mod['activity'] = 1;
            $mod['title_seo'] = $model->name;
            $mod['keywords_seo'] = $model->name;
            $mod['description_seo'] = "";
            $mod['old_price'] = "";
            $mod['recommended'] = 1;
            $mod['new'] = 0;
            $mod['sorting'] = 16;
            $mod['weight'] = "";
            $mod['related_vendors'] = "";
            $mod['related_categories'] = "";
            $mod['link_to_product'] = $model->promoUrl;
            $mod['currency'] = "RUR";
            $mod['option'] = $options;

            foreach($attributes as $key => $val){
                if($key == 'categoryId'){
                    $cat_id = $val;
                    $mod['category'] = Category::find($cat_id)->name;
                }
            }


            array_push($models, $mod);
        }

        return $models;
    }

    public function convert(){
        $fileUrl = request('file_url');
        $xml = simplexml_load_file($fileUrl);

        $categories = $this->formatCategories($xml->vendor->categories);
        DB::table('categories')->insert($categories);

        $models = $this->formatModels($xml->vendor->models);
        DB::table('products')->insert($models);
        
        return redirect()->back();


    }
}
