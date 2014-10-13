<?php defined('_JEXEC') or die;

class Quick_CSV_Import
{
	public $index;
	public $file_name;  //where to import from
	public $error; //error message
	public $arr_csv_import;
	public $arr_csv_export;
	public $arr_csv_columns; //array of columns
	public $table_exists; //flag: does table for import exist
	public $encoding; //encoding table, used to parse the incoming file. Added in 1.5 version

	public function __construct($file_name = '')
	{
		$this->file_name = $file_name;
		$this->arr_csv_columns = array();
		$this->use_csv_header = true;
		$this->field_separate_char = ",";
		$this->field_enclose_char  = "\"";
		$this->field_escape_char   = "\\";
		$this->table_exists = false;
	}

	public function mapField()
	{
		return array(
			'Manufacture'    => 'mfc',
			'Part Number'    => 'part_number',
			'Description'    => 'des',
			'New/Used'       => 'new',
			'Price'          => 'price',
			'Physical Count' => 'physical_count',
			'Product Type'   => 'product_type',
		);
	}

	public function parse()
	{
		$this->arr_csv_export = array();
		$this->index          = array();
		$index                = array();

		foreach ($this->mapField() as $k=>$v)
		{
			echo '<pre>';

			if (array_search($k, $this->arr_csv_columns[0]) !== false)
			{
				$index[array_search($k, $this->arr_csv_columns[0])] = $v;
			}
		}

		if( !empty($index))
		{
			$this->index = $index;
		}

		foreach ($this->arr_csv_import as $k=>$v)
		{
			$arr = array();

			foreach ($index as $_index=>$_k)
			{
				$value	= $v[$_index];
				$arr[$_k]	= $value;
			}

			$this->arr_csv_export[]	= $arr;
		}
		$i = 0;
	}

	public function export()
	{
		header("Content-type: application/csv");
		header("Content-Disposition: \"inline; filename=PartsExport.csv\"");

		echo '"'.implode('","',$this->index)."\"\r\n";

		foreach($this->arr_csv_export as $item)
		{
			echo '"'.implode('","',$item)."\"\r\n";
		}
	}

	public function import()
	{
		$this->getCsvHeaderFields();
		$this->parse();
	}

	public function getLines()
	{
		$this->import();

		return (array) $this->arr_csv_export;
	}

	public function getCsvHeaderFields()
	{
		$this->arr_csv_columns = array();
		$fpointer = fopen($this->file_name, "r");

		if ($fpointer)
		{
			$i = 0;

			while (!feof ($fpointer))
			{
				$arr = fgetcsv($fpointer, 4096, $this->field_separate_char);

				if(is_array($arr) && !empty($arr))
				{
					if($i == 0)
					{
						$this->arr_csv_columns[] = $arr;
					}
					else
					{
						$this->arr_csv_import[] = $arr;
					}
				}
				$i++;
			}
			unset($arr);
			fclose($fpointer);
		}
		else
		{
			$this->error = "file cannot be opened: ".(""==$this->file_name ? "[empty]" : @mysql_escape_string($this->file_name));
		}

		return $this->arr_csv_columns;
	}
}
