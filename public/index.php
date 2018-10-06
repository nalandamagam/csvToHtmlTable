<?php
/**
 * Created by PhpStorm.
 * User: nalanda
 * Date: 10/6/18
 * Time: 11:57 AM
 */

main::start("csvTestFile.csv");

class main {
    public static function start($csvFileName){
        $records = csv::getCSVRecords($csvFileName);
        $table = html::generateHTMLTable($records);
        echo $table;
    }
}

class csv {
    public static function getCSVRecords($csvFileName){
        $csvFile = fopen($csvFileName, "r");
        $columnNames = array();
        $isHeaderRecord = true;

        while(!feof($csvFile)){
            $row = fgetcsv($csvFile);
            if($isHeaderRecord){
                $columnNames = $row;
                $isHeaderRecord = false;
            } else {
                $records[] = recordFactory::createRecord($columnNames, $row);
            }
        }

        fclose($csvFile);
        return $records;
    }
}

class recordFactory {
    public static function createRecord(Array $columnNames = null, $cellValues = null){
        $record = new record($columnNames, $cellValues);
        return $record;
    }
}

class record {
    public function __construct(Array $columnNames = null, $cellValues = null) {
        $record = array_combine($columnNames, $cellValues);

        foreach ($record as $key => $value){
            $this -> createProperty($key, $value);
        }
    }

    public function createProperty($key = 'key', $value = 'value') {
        $key = '<th>'. $key . '</th>';
        $value = '<td>'. $value . '</td>';
        $this->{$key} = $value;
    }
}

class html {
    public static function generateHTMLTable($records) {

    }
}