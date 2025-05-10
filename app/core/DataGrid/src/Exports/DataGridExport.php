<?php

namespace app\core\DataGrid\src\Exports;

use app\core\DataGrid\src\DataGrid;

class DataGridExport
{
    /**
     * DataGrid instance
     *
     * @var \app\core\DataGrid\src\DataGrid
     */
    protected $datagrid;

    /**
     * Constructor for DataGridExport class.
     *
     * @param \app\core\DataGrid\src\DataGrid $datagrid
     * @return void
     */
    public function __construct(DataGrid $datagrid)
    {
        $this->datagrid = $datagrid;
    }

    public function exportData($records, $filename, $extension) {
        if($extension == 'csv') {
            $this->exportToCSV($records, $filename);
        } elseif($extension == 'xml') {
            $this->exportToXml($records, $filename);
        }
    }

    /**
     * Export the data to a CSV file.
     *
     * @param array $params
     * @return void
     */
    public function exportToCSV($records, $filename)
    {
        // Send headers to download the file as CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Open the output stream for CSV
        $output = fopen('php://output', 'w');

        // Get column headings
        $headings = [];
        foreach ($this->datagrid->getColumns() as $column) {
            if ($column->getExportable()) {
                $headings[] = $column->getLabel();
            }
        }

        // Write the headers to the CSV
        fputcsv($output, $headings);

        // Write the records to the CSV
        foreach ($records['records'] as $record) {
            $row = [];
            foreach ($this->datagrid->getColumns() as $column) {
                if ($column->getExportable()) {
                    $explode = explode('.', $column->getIndex());
                    $row[] = $record->{$explode[1]};
                }
            }
            fputcsv($output, $row);
        }

        // Close the output stream
        fclose($output);
        exit;
    }

    public function exportToXml($records, $filename) {

        header('Content-Type: application/xml');
        header('Content-Disposition: attachment; filename=' . $filename .'');
        header('Pragma: no-cache');
        header('Expires: 0');

        $xml = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');

        foreach ($records['records'] as $record) {
            $item = $xml->addChild('record');
            foreach ($this->datagrid->getColumns() as $column) {
                $explode = explode('.', $column->getIndex());
                $field = $explode[1] ?? $column->getIndex();
                $item->addChild($field, htmlspecialchars((string) ($record->{$field} ?? '')));
            }
        }

        echo $xml->asXML();
        exit;
    }
}
