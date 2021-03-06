<?php
// 本程序自动生成 @2016-06-28 20:47:11
require_once('loader/Controller.php');
require_once('loader/App.php');
require_once('lib/Utils.php');
require_once('lib/Tuan.php');

use \Tuanduimao\Loader\App as App;
use \Tuanduimao\Utils as Utils;
use \Tuanduimao\Tuan as Tuan;
use \Tuanduimao\Excp as Excp;
use \Tuanduimao\Conf as Conf;


class DataController extends \Tuanduimao\Loader\Controller {
	
	function __construct() {
	}

	
	/**
	 * 表单主框架
	 * @return
	 */
	function index() {
		
		$tid = (isset($_GET['tid']))? trim($_GET['tid']) : null;

		// 读取类型清单
		$dt = App::M('Datatype');
		$datatype = $dt->getLine("WHERE typeid='{$tid}' LIMIT 1");



		// $object =  $dt->M($tid ,'typeid' );
		// $schema = $dt->toSchema($tid, 'typeid');

		// echo "<pre>";

		// $columns = $object->sheet()['columns'];
		// echo "\n== 数据表结构: ==============\n";
		// foreach ($columns as $field => $type) {
		// 	$t  =  $type->toArray();
		// 	echo "{$t['data']['screen_name']} | {$t['data']['column_name']} \n";
		// }

		// echo "\n\n";
		// print_r( $schema );



		// echo "\n== 插入数据测试: ==============\n";
		
		// var_dump($object->create(['name'=>'天安门城楼']));
		// print_r( $object->errors );

		// echo "</pre>";


		// 默认: 如果有类型，first 参数不为空, 则选中第一个, 
		// if ( $datatype['total'] > 0 && $allowkeys["first"] != null ) {
		// 	$allowkeys["tid"] = current($datatype['data'])['typeid'];
		// }


		// $data = ['query'=>$allowkeys, 'datatype'=>$datatype ];
		// App::render($data, 'h5/datatype','index');

		$data = [];
		App::render($data, 'h5/data', 'index' );

		return [
        	'js' => [
                'js/plugins/jquery-ui/jquery-ui.min.js',
                'js/plugins/jquery-validation/jquery.validate.min.js',
        		'js/plugins/jquery-tags-input/jquery.tagsinput.min.js',
        		'js/plugins/dropzonejs/dropzone.min.js',
        		'js/plugins/cropper/cropper.min.js',
        		'js/plugins/select2/select2.full.js',
        		'js/plugins/jquery-quicksearch/jquery.quicksearch.js',
        		'js/plugins/multi-select/js/jquery.multi-select.js',

        		// Page JS 
        		App::$APP_HOME_STATIC . '/static/js/page.js',
        	],

        	'css'=> [
        		'js/plugins/jquery-tags-input/jquery.tagsinput.min.css',
        		'js/plugins/dropzonejs/dropzone.min.css',
        		'js/plugins/cropper/cropper.css',
        		'js/plugins/select2/select2.min.css',
        		'js/plugins/multi-select/css/multi-select.css',
        	],

            'crumb' => [
                "{$datatype['cname']}管理" => APP::R('data','index',['tid'=>$tid]),
                "数据列表" => "",
            ]
        ];
	}


	/**
	 * 搜索结果列表
	 * @return [type] [description]
	 */
	function search() {
		
		$ls = (isset($_GET['_list_style']) ) ? '_' . trim($_GET['_list_style']) : '_list';
		$lm = (isset($_GET['_list_mode']) ) ? '_' .trim($_GET['_list_mode']) : '';
		$tpl = "table{$ls}{$lm}";

		$data = [];
		App::render($data, 'h5/data/tabs', $tpl );

	}

}