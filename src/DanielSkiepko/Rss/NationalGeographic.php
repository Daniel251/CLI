<?php
namespace DanielSkiepko\Rss;

class NationalGeographic
{
	public function saveCsv($csv_type, $link, $path)
	{

		if ($csv_type == "csv:simple") {
			$access = "w";
		} elseif ($csv_type == "csv:extended") {
			$access = "a";
		} else {
			die ("Nie znaleziono komendy: $csv_type");
		}

		if (filter_var($link, FILTER_VALIDATE_URL) === FALSE) {
		    die('Not a valid URL!');
		}

		$html = file_get_contents($link);
		$html = str_replace('dc:creator', 'creator' ,$html);
		$xml = simplexml_load_string($html, "SimpleXMLElement");
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		$items = $array["channel"]['item'];

		if (file_exists($path) && ! is_writable($path)) {
		    die('Nie masz uprawnień do zapisu pliku!');
        }

		if (! $fp = @fopen($path, $access)) {
            die('Nie mona zapisać pliku - plik jest otwarty!');
        }
		if (file_get_contents($path) == '') {
			$head = ["title", "link", "description", "pubDate", "creator"];
			fputcsv($fp, $head, ";");
		}
		foreach ($items as $item) {
		//Usuwanie <src ... /> z description
		//	preg_match('/<img.*?\/>/', $item['description'], $mach);
		//	$item['description'] = str_replace($mach, '' , $item['description']);
            $item['pubDate'] = date("Y-m-d H:i:s",  strtotime($item['pubDate']));
			unset($item['guid']);
		    fputcsv($fp, $item, ";");
		}
		fclose($fp);
		echo "Zapisano pomyślnie!";
	}
}