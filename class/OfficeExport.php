<?php

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


/**
 * @desc    导出格式通过工具类
 *
 * @author  范昭瑰
 */
class OfficeExport
{
	/**
	 * @var array 标题栏目
	 */
	private $_head;

	/**
	 * @var int 列长度
	 */
	private $_colLen;

	/**
	 * @var array 列名键值  [A B C ... AA AB ...]
	 */
	private $_columArrKey;

	/**
	 * 版本信息
	 *
	 * @var string
	 */
	private $_version = '2007';

	/**
	 * @var string 导出文件名
	 */
	private $_filename;

	/**
	 * @var array 指定列的宽度 ['A' => '10', 'E' => '30']
	 */
	private $_colomArr = [];

	/**
	 * @var string 头部标题的背景色
	 */
	private $_rgb = 'FFFFFF00';

	/**
	 * @var string 导出字体
	 */
	private $_font = '宋体';

	/**
	 * @var \OfficeExport
	 */
	private static $_instance;

	private function __construct()
	{
	}

	private function __clone()
	{
	}


	/**
	 * 单例模式  Spreadsheet 对象
	 * @return \OfficeExport
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * 设置标题
	 *
	 * @author: fanzhaogui
	 * @param array $head
	 * @return $this
	 */
	public function setHead(array $head)
	{
		$this->_head   = $head;
		$this->_colLen = count($head);
		$this->setChars();

		return $this;
	}


	/**
	 * 导出的版本信息
	 *
	 * @author: fanzhaogui
	 * @param $version
	 */
	private function setVersion($version)
	{
		if (!$version) return '';
		$this->_version = $version;
	}


	/**
	 * 子标题名称
	 *
	 * @author: fanzhaogui
	 * @param $title
	 * @return $this
	 */
	public function setTitle($title)
	{
		$this->_title = $title;
		return $this;
	}


	/**
	 * 部分列宽设置宽带
	 * @param  $colomArr .. ['E'=>28, ]
	 * @return $this
	 */
	public function setWidthArr($colomArr = [])
	{
		$this->_colomArr = $colomArr;
		return $this;
	}


	/**
	 * 设置导出的文件名称
	 *
	 * @param string $version 版本
	 * @param string $filename 文件名称
	 */
	public function setFileName($version, $fileName)
	{
		$this->setVersion($version);

		if (empty($fileName)) {
			$fileName = '文件导出 ：' . date('Y-m-d H:i:s') . $this->getFileExt();
		}
		$this->_filename = $fileName . $this->getFileExt();

		return $this;
	}


	/**
	 * 设置尾部数据
	 *
	 * @author: fanzhaogui
	 * @param string $footer
	 * @return $this
	 */
	public function setFooter($footer = '')
	{
		if (empty($footer)) {
			$footer = '';
		}
		$this->_footer = is_array($footer) ? implode($footer, '   ') : $footer;

		return $this;
	}


	/**
	 * 获取row 行高
	 * @return int 单位 pt
	 */
	private function getRowHeight($row = 1)
	{

		switch ($row) {
			case 1:
				return 25.5;
				break;
			case 2 :
			case 3 :
				return 20;
				break;
			default:
				return 18;
				break;
		}

	}


	/**
	 * 获取colom 列宽
	 *
	 * @param  int $width
	 *
	 * @return int 单位 pt
	 */
	private function getColomWidth($width = 0)
	{
		return $width > 0 ? $width : 15;
	}

	/**
	 * 根据每行获取适当的行对应的字体大小
	 *
	 * @param   int $row
	 * @return  int
	 */
	private function getFontSizeByRow($row = 1)
	{
		switch ($row) {
			case 1:
				return 20;
				break;
			case 2 :
				return 11;
				break;
			default:
				return 10;
				break;
		}
	}

	/**
	 * 设置字体
	 *
	 * @return $this
	 */
	public function setFontName($font = '宋体')
	{
		$this->_font = $font;
		return $this;
	}

	/**
	 * 获取样式 应用数组
	 *
	 * @return array
	 */
	private function getStyleArrayByRow($row = 1)
	{

		$style = [
			'font'      => [
				'name' => $this->_font,
				'size' => self::getFontSizeByRow($row)
			],
			//内容水平居中  自动换行
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
				'vertical'   => Alignment::HORIZONTAL_CENTER,
				'wrapText'   => true,
			],
			//通用配置所有边框细线
			'borders'   => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
				],
			],
		];

		return $style;
	}

	/**
	 * 导出excle 数据
	 *
	 * @return void
	 */
	public function dumpExcel(array $data, $rawNum = 1)
	{

		if (!is_array($data)) {
			throw new \Exception('数据格式错误');
		}

		$spreadsheet = new Spreadsheet();
		$sheet       = $spreadsheet->getActiveSheet();

		//渲染你标题数据
		$this->renderHeaderAndTitle($sheet, $rawNum);

		//渲染主体数据data
		$row = ++ $rawNum ;
		if (!empty($data)) {
			foreach ($data as $item) {
				$dataCol = 'A';
				$sheet->getRowDimension($row)->setRowHeight($this->getRowHeight($row));
				foreach ($item as $value) {
					$sheet->getStyle($dataCol . $row)->applyFromArray($this->getStyleArrayByRow($row));
					$pType = DataType::TYPE_STRING;
					$sheet->setCellValueExplicit($dataCol . $row, $value, $pType);
					$dataCol++;
				}
				$row++;
			}
		}

		$this->renterFooter($sheet, $row);

		header('Content-Type: ' . $this->getDownMine());
		header('Content-Disposition: attachment;filename="' . $this->_filename . '"');
		header('Cache-Control: max-age=0');

		$writer = IOFactory::createWriter($spreadsheet, $this->getDownWiteType());
		ob_end_clean();
		$writer->save('php://output');

		die;
	}

	/**
	 * 头部标题渲染写入文件
	 *
	 * @param  object $sheet
	 * @param  int $rowNum 第几行开始渲染标题
	 *
	 * @return  void
	 */
	private function renderHeaderAndTitle($sheet, $rowNum)
	{
		$colomn = $this->_columArrKey;;

		foreach ($this->_head as $key => $val) {
			$cel = $colomn[$key];
			if ($this->_colomArr && isset($this->_colomArr[$cel])) {
				$width = $this->_colomArr[$cel];
				$sheet->getColumnDimension($cel)->setWidth($this->getColomWidth($width));
			}
			// 单元格内容写入
			$sheet->getRowDimension($rowNum)->setRowHeight($this->getRowHeight($rowNum));
			$sheet->setCellValue($cel . strval($rowNum), $val);
			$sheet->getStyle($cel . $rowNum)->applyFromArray($this->getStyleArrayByRow($rowNum));
		}
		//标题行添加背景
		$col = 'A' . strval($rowNum) . ':' . $colomn[$this->_colLen - 1] . strval($rowNum);
		$sheet->getStyle($col)->getFill()->setFillType(Fill::FILL_SOLID)
			->getStartColor()->setARGB($this->_rgb);
	}


	/**
	 * todo 尾部处理
	 * @desc 由于尾部处理的规则不同，故无法确认
	 *
	 * @author: fanzhaogui
	 * @param object $sheet
	 * @param $dataCol
	 * @param $rowNum
	 */
	public function renterFooter($sheet, $rowNum)
	{
		if (empty($this->footer)) return;
		$cells   = $this->_columArrKey;
		$dataCol = array_pop($cells);
		$cel     = 'A' . $rowNum . ':' . $dataCol . $rowNum;

		$sheet->mergeCells($cel);
		$sheet->getStyle($cel)->applyFromArray($this->getStyleArrayByRow($rowNum));
		$sheet->getRowDimension($rowNum)->setRowHeight($this->getRowHeight($rowNum));

		$sheet->setCellValue('A' . 1, $this->footer);
	}

	/**
	 * 获取列字母
	 *
	 * @author: fanzhaogui
	 */
	private function setChars()
	{
		$headerTitle = $this->_head;
		$key         = $startKey = ord("A");  //A--65
		$key2        = ord("@"); //@--64
		$Z_key       = ord("Z");
		$columArrKey = [];

		foreach ($headerTitle as $kh => $vh) {
			if ($key > $Z_key) {
				$key2  += 1;
				$key   = $startKey;
				$colum = chr($key2) . chr($key);//超过26个字母时才会启用
			} else {
				if ($key2 >= $startKey) {
					$colum = chr($key2) . chr($key);//超过26个字母时才会启用
				} else {
					$colum = chr($key);
				}
			}
			$columArrKey[] = $colum;
			$key++;
		}

		$this->_columArrKey = $columArrKey;
	}

	/**
	 * 获取导出文件类型的信息
	 *
	 * @author: fanzhaogui
	 * @param int $version
	 * @return mixed
	 * @throws \Exception
	 */
	private function getFileOption()
	{
		// 版本差异信息
		$version_opt = [
			'2007' => [
				'mime'       => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'ext'        => '.xlsx',
				'write_type' => 'Xlsx',
			],
			'2003' => ['mime'       => 'application/vnd.ms-excel',
					   'ext'        => '.xls',
					   'write_type' => 'Xls',
			],
			'pdf'  => ['mime'       => 'application/pdf',
					   'ext'        => '.pdf',
					   'write_type' => 'PDF',
			],
			'ods'  => ['mime'       => 'application/vnd.oasis.opendocument.spreadsheet',
					   'ext'        => '.ods',
					   'write_type' => 'OpenDocument',
			],
		];
		if (!isset($version_opt[$this->_version])) {
			throw new \Exception('不支持此版本的导出');
		}
		return $version_opt[$this->_version];
	}

	/**
	 * 获取下载文件的后缀
	 *
	 * @author: fanzhaogui
	 * @return mixed
	 */
	private function getFileExt()
	{
		return $this->getFileOption()['ext'];
	}

	/**
	 * 获取下载文件的后缀
	 *
	 * @author: fanzhaogui
	 * @return mixed
	 */
	private function getDownMine()
	{
		return $this->getFileOption()['mime'];
	}

	/**
	 * 获取下载文件的后缀
	 *
	 * @author: fanzhaogui
	 * @return mixed
	 */
	private function getDownWiteType()
	{
		return $this->getFileOption()['write_type'];
	}
}


/* 使用方式
$head    = [];
$body    = [];
$name    = '';
$version = '2007';
$title   = '导出记录';
$font = '宋体';

\tools\OfficeExport::getInstance()
    ->setHead($head)
    ->setFileName($version, $name)
    ->setTitle($title)
    ->setFontName($font)
    ->setWidthArr(['A' => '33'])
    ->dumpExcel($body);
*/