<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modelitem');

class AuroraSearchModelAuroraSearch extends JModelList
{
	protected $xmlParam;
	//protected $dbParam;	Should I create this???

	public function getParamFromRequest()
	{
		if (!isset($this->xmlParam)) 
		{
			//Get xmlParam param from the query. It can be resides there while creating a menu link
			//Possible menu link params could be get from xml or database
			//xml_param param was got from section xml_params of \site\views\aurorasearch\tmpl\default.xml
			//Where can I see the format of this xml???
			//Can I reside several param definitions per one xml-file???
			if(!get_magic_quotes_gpc()) {
				$xml_param = JFactory::getApplication()->input->get('xml_param', 1, 'INT' );
			} else {
				$xml_param = JRequest::getInt('xml_param');
			}
			
			$this->xmlParam = $xml_param;		
		}
		return $this->xmlParam;
	}

	/*
		We can store param values in a database. For this, we should do the following:
			* define param like in the db_param section in \site\views\aurorasearch\tmpl\default.xml
			* create \admin\models\fields\FieldIDAuroraSearchMenu.php - it will fetch a set of values
				of param from database and pack them into html for using in adminpanel
			* create \admin\tables\aurorasearch.php - it will be used in site side model (here) for
				fetching param value
			* use \admin\tables\aurorasearch.php in the site side model (here) in corresponding
				getTable method
	*/
	public function getParamFromDatabase ( $db_param = 1 )
	{
		if (!is_array($this->dbParam))
		{
			$this->dbParam = array();
		}
 
		if (!isset($this->dbParam[$db_param])) 
		{
			$jinput = JFactory::getApplication()->input;
			$db_param = $jinput->get('db_param', 1, 'INT' );
 
			// Get a Table instance
			$table = $this->getTable();
 
			// Load the message
			$table->load($db_param);
 
			// Assign the message
			$this->dbParam[$db_param] = $table->field_1; //[$table->field_1, $table->field_2]
		}
 
		return $this->dbParam[$db_param];
	}

/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 
	 * @inherits getTAble method in JModel class
	 * @since	2.5
	 
	 * @waf		parent implementation (and again in getInstance) remove all chars form $type and $preffix
	 * except letters, numbers, dots, hyphens and underscores. Then getInstance creates classname concatenating
	 * $preffix and $path (last with UC first letter) and find it in some includepathes in file LC $type.php
	 *
	 *JTable provides basic functions like save row, load row, convert to xml etc
	 */
	public function getTable($type = 'AuroraSearchOptions', $prefix = 'AuroraSearchTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	//Можно использовать запрос к базе данных...
	public function getProducts (  ) {
		$db = &JFactory::getDBO();	
		//todo language support
		//$lang = &JSFactory::getLang();
		//$name = $lang->get("name");		
		//p.{$db->quoteName ( 'product_ean' )}
		$db->setQuery ( "select 1, 2, 3" );/*
			"select p.`product_ean`, p.`name_ru-RU`, concat(ifnull(concat(c2.`name_ru-RU`,'/'),''),c1.`name_ru-RU`) as ctg, ".
			
			"(select group_concat(av.`name_ru-RU`) from `#__jshopping_products_attr2` as pa left join `#__jshopping_attr_values` as av on pa.`attr_value_id` = av.`value_id` where pa.`product_id` = p.`product_id`)"
			
			.", round(p.`product_price`/c.`currency_value`, 2)
				from `#__jshopping_products` as p 
				left join
				`#__jshopping_products_to_categories` as pc 
				on p.`product_id` = pc.`product_id`
				left join
				`#__jshopping_categories` as c1 
				on pc.`category_id` = c1.`category_id`
				left join 
				`#__jshopping_categories` as c2 
				on c1.`category_parent_id` = c2.`category_id` 
				left join
				`#__jshopping_currencies` as c
				on c.`currency_id` = p.`currency_id`
				
			where p.`product_publish` = 1
			order by ctg"
		);*/
		//$result = $db->loadAssocList (  );
		$result = $db->loadRowList (  );
		
		$er = $db->getErrormode (  );
		if ( $er ) {
			return array($er);
		}
		
		//todo	Добавить нормальную поверку на пустой результат
		if ( ! $result ) {
			return "";
		}
		
		return $result;
	}

	//В методы модели, вызываемые из вида посредством get нет возможности передавать аргументы
	//Следует внутри метода использовать данные из запроса
	public function getProbableKeywords ( /*$kw*/ ) {
		$keywords = "Dummy keywords";
		return $keywords;
	}
	
}
