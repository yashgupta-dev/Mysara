<?php

namespace app\core\DataGrid\src;

use Exception;
use app\core\DB;
use app\model\BaseModel;
use app\core\DataGrid\src\Action;
use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\MassAction;
use app\core\DataGrid\src\Enums\ColumnTypeEnum;
use app\core\DataGrid\src\Exports\DataGridExport;

abstract class DataGrid extends BaseModel
{
    /**
     * Prefix
     *
     * @var string
     */
    protected $prefix = '?:';

    /**
     * Primary column.
     *
     * @var string
     */
    protected $primaryColumn = 'id';

    /**
     * Primary column.
     *
     * @var string
     */
    protected $save_search    = '';

    /**
     * Default sort column of datagrid.
     *
     * @var ?string
     */
    protected $sortColumn;

    /**
     * Default sort order of datagrid.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Default items per page.
     *
     * @var int
     */
    protected $itemsPerPage = 10;

    /**
     * Per page options.
     *
     * @var array
     */
    protected $perPageOptions = [10, 20, 30, 40, 50];

    /**
     * Columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Actions.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * Mass action.
     *
     * @var array
     */
    protected $massActions = [];

    /**
     * Query builder instance.
     *
     * @var object
     */
    protected $queryBuilder;

    /**
     * Paginator instance.
     */
    protected $paginator;

    /**
     * Exportable.
     */
    protected bool $exportable = false;

    /**
     * Export file name.
     */
    protected string $exportFileName;

    /**
     * Export file format.
     */
    protected string $exportFileExtension = 'csv';

    /**
     * Prepare query builder.
     */
    abstract public function prepareQueryBuilder();

    /**
     * Prepare columns.
     */
    abstract public function prepareColumns();
    /**
     * Prepare actions.
     */
    public function prepareActions() {}

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions() {}

    /**
     * Set primary column.
     */
    public function setPrimaryColumn(string $primaryColumn): void
    {
        $this->primaryColumn = $primaryColumn;
    }

    /**
     * Get primary column.
     */
    public function getPrimaryColumn(): string
    {
        return $this->primaryColumn;
    }

    /**
     * Set sort column.
     */
    public function setSortColumn(string $sortColumn): void
    {
        $this->sortColumn = $sortColumn;
    }

    /**
     * Get sort column.
     */
    public function getSortColumn(): ?string
    {
        return $this->sortColumn;
    }

    /**
     * Set sort order.
     */
    public function setSortOrder(string $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * Get sort order.
     */
    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    /**
     * Set items per page.
     */
    public function setItemsPerPage(int $itemsPerPage): void
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * Get items per page.
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * Set per page options.
     */
    public function setPerPageOptions(array $perPageOptions): void
    {
        $this->perPageOptions = $perPageOptions;
    }

    /**
     * Get per page options.
     */
    public function getPerPageOptions(): array
    {
        return $this->perPageOptions;
    }

    /**
     * Set columns.
     */
    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * Add column.
     */
    public function addColumn(array $column): void
    {

        $this->columns[] = Column::resolveType($column);
    }

    /**
     * Get columns.
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Set actions.
     */
    public function setActions(array $actions): void
    {
        $this->actions = $actions;
    }

    /**
     * Add action.
     */
    public function addAction(array $action): void
    {

        $this->actions[] = new Action(
            $action['index'] ?? '',
            $action['icon']  ?? '',
            $action['title'],
            $action['method'],
            $action['url'],
            $action['class'] ?? '',
            $action['type'] ?? 'list',
        );
    }

    /**
     * Get actions.
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Set mass actions.
     */
    public function setMassActions(array $massActions): void
    {
        $this->massActions = $massActions;
    }

    /**
     * Add mass action.
     */
    public function addMassAction(array $massAction): void
    {

        $this->massActions[] = new MassAction(
            $massAction['icon'] ?? '',
            $massAction['title'],
            $massAction['method'],
            $massAction['dispatch'] ?? '',
            $massAction['type'] ?? '',
            $massAction['options'] ?? [],
            $massAction['class'] ?? '',
        );
    }

    /**
     * Get mass actions.
     */
    public function getMassActions(): array
    {
        return $this->massActions;
    }

    /**
     * Set query builder.
     *
     * @param  mixed  $queryBuilder
     */
    public function setQueryBuilder($queryBuilder): void
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Get query builder.
     */
    public function getQueryBuilder(): mixed
    {
        return $this->queryBuilder;
    }

    /**
     * Map your filter.
     */
    public function addFilter(string $datagridColumn, string $queryColumn): void
    {

        foreach ($this->columns as $column) {            
            if ($column->getIndex() === $datagridColumn) {
                $column->setColumnName($queryColumn);

                break;
            }
        }
    }

    /**
     * Set exportable.
     */
    public function setExportable(bool $exportable): void
    {
        $this->exportable = $exportable;
    }

    /**
     * Get exportable.
     */
    public function getExportable(): bool
    {
        return $this->exportable;
    }

    /**
     * Is exportable.
     */
    public function isExportable(): bool
    {
        return $this->getExportable();
    }

    /**
     * Set export file name.
     */
    public function setExportFileName(string $exportFileName): void
    {
        $this->exportFileName = $exportFileName;
    }

    /**
     * Get export file name.
     */
    public function getExportFileName(): string
    {
        return $this->exportFileName;
    }

    /**
     * Set export file extension.
     */
    public function setExportFileExtension(string $exportFileExtension = 'csv'): void
    {
        $this->exportFileExtension = $exportFileExtension;
    }

    /**
     * Get export file extension.
     */
    public function getExportFileExtension(): string
    {
        return $this->exportFileExtension;
    }

    /**
     * Get exporter.
     */
    public function getExporter()
    {
        return new DataGridExport($this);
    }

    /**
     * Get export file name with extension.
     */
    public function getExportFileNameWithExtension(): string
    {
        return $this->getExportFileName() . '.' . $this->getExportFileExtension();
    }

    /**
     * Download export file.
     *
     * @return mixed
     */
    public function downloadExportFile()
    {

        return $this->getExporter()->exportData($this->formatRecords($this->queryBuilder, true), $this->getExportFileNameWithExtension(), $this->getExportFileExtension());
    }

    /**
     * Process the datagrid.
     *
     * @return array
     */
    public function process()
    {
        $this->prepare();

        if ($this->isExportable()) {
            return $this->downloadExportFile();
        }

        // return as json
        return $this->formatData();
    }

    /**
     * To json. The reason for deprecation is that it is not an action returning JSON; instead,
     * it is a process method which returns a download as well as a JSON response.
     *
     * @deprecated
     *
     * @return mixed
     */
    public function toJson()
    {
        return $this->process();
    }

    /**
     * Validated request.
     */
    protected function validatedRequest(): array
    {
        $request = $_REQUEST;
        
        $validated = [
            'filters'    => [],
            'sort'       => [],
            'pagination' => [],
            'export'     => false,
            'format'     => '',
        ];

        // Validate filters
        if (!empty($request['filters']) && is_array($request['filters'])) {
            // check filter under keys have values or not
            foreach ($request['filters'] as $key => $value) {
                if (!isset($value)) {
                    unset($request['filters'][$key]);
                }
            }

            if (empty($request['filters']) && !empty($request['q'])) {
                $request['filters']['all'][] = $request['q'];
            }

            $validated['filters'] = $request['filters'];
        }
        // validate daterange
        $validated['filters'] = array_merge($validated['filters'], $this->createFilters($request));

        // Validate sort
        $validated['sort'] = $this->createSorting($request);

        // Validate pagination
        $validated['pagination'] = $this->createPagination($request);

        // Validate export flag
        if (isset($request['export']) && intval($request['export'])) {
            $validated['export'] = (bool) $request['export'];
        }

        // Validate format
        if (!empty($request['format']) && in_array($request['format'], ['csv', 'xls', 'xml'], true)) {
            $validated['format'] = $request['format'];
        }

        $this->queryBuilder = array_merge($this->queryBuilder, $_REQUEST);
        return $validated;
    }

    /**
     * createFilters
     *
     * @param  mixed $request
     * @return array
     */
    public function createFilters($request)
    {

        $filtersRange = [];
        if (!empty($request['period']) && $request['period'] != 'A') {
            $filtersRange['period'] = $request['period'];

            if (!empty($request['time_from'])) {
                $filtersRange['from'] = $request['time_from'];
            }

            if (!empty($request['time_to'])) {
                $filtersRange['to'] = $request['time_to'];
            }
        }

        return $filtersRange;
    }

    /**
     * createSorting
     *
     * @param  mixed $request
     * @return array
     */
    public function createSorting($request)
    {
        // Validate sorting

        if (!empty($request['sort_by'])) {
            $this->sortColumn = $request['sort_by'];
        }

        if (!empty($request['sort_order'])) {
            if (strtolower($request['sort_order']) == 'desc') {
                $this->sortOrder = 'asc';
            } else {
                $this->sortOrder = 'desc';
            }
        }

        $validated['column']    = $this->sortColumn;
        $validated['order']     = $this->sortOrder;

        return $validated;
    }

    /**
     * createPagination
     *
     * @param  mixed $request
     * @return array
     */
    public function createPagination($request)
    {
        // Validate pagination
        $page = 1;
        if (!empty($request['page'])) {
            $page = intval($request['page']);
        }

        if (!empty($request['items_per_page'])) {
            $this->itemsPerPage = intval($request['items_per_page']);
        }

        $validated['per_page'] = $this->itemsPerPage;
        $validated['page'] = $page;

        return $validated;
    }

    /**
     * Process requested filters_
     *
     * @return void
     */
    protected function processRequestedFilters(array $requestedFilters): void
    {
        $whereConditions = [];
        foreach ($requestedFilters as $requestedColumn => $requestedValues) {
            if ($requestedColumn === 'all') {
                foreach ($requestedValues as $value) {

                    $subConditions = [];

                    foreach ($this->columns as $column) {
                        if (
                            $column->getSearchable()
                            && !in_array($column->getType(), [ColumnTypeEnum::BOOLEAN, ColumnTypeEnum::AGGREGATE])
                        ) {
                            $subConditions[] = "{$column->getColumnName()} LIKE '%{$value}%'";
                        }
                    }

                    if (!empty($subConditions)) {
                        $whereConditions[] = 'AND (' . implode(' OR ', $subConditions) . ')';
                    }
                }
            } else {
                $filteredColumn = null;

                foreach ($this->columns as $column) {
                    if ($column->getIndex() === $requestedColumn) {
                        $filteredColumn = $column;
                        break;
                    }
                }

                if ($filteredColumn && !empty($requestedValues)) {
                    $result = $filteredColumn->processFilter($requestedValues); // <-- Returns ['condition' => [...]]

                    if (!empty($result)) {
                        $whereConditions = array_merge($whereConditions, $result);
                    }
                }
            }
        }

        // Store the result into your query array builder
        if (!isset($this->queryBuilder['conditions'])) {
            $this->queryBuilder['conditions'] = [];
        }

        $this->queryBuilder['conditions'] = array_merge($this->queryBuilder['conditions'], $whereConditions);
    }

    /**
     * Process requested sorting.
     *
     * @return void
     */
    protected function processRequestedSorting($requestedSort): void
    {

        if (! $this->sortColumn) {
            $this->sortColumn = $this->primaryColumn;
        }

        $this->queryBuilder['column']   = $requestedSort['column'] ?? $this->sortColumn;
        $this->queryBuilder['order']    = $requestedSort['order']  ?? $this->sortOrder;
    }

    /**
     * Process requested pagination.
     */
    protected function processRequestedPagination(array $requestedPagination): void
    {

        $this->queryBuilder['per_page']     = $requestedPagination['per_page'] ?? $this->itemsPerPage;
        $this->queryBuilder['page']         = $requestedPagination['page'] ?? 1;
        $this->queryBuilder['total_items']  = $requestedPagination['total_items'] ?? 0;
    }

    /**
     * Process requested export.
     */
    protected function processRequestedExport(string $exportFileExtension = 'csv'): void
    {

        $this->setExportable(true);

        $this->setExportFileName(substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, 36));

        $this->setExportFileExtension($exportFileExtension);
    }

    /**
     * Process request.
     */
    protected function processRequest(): void
    {

        /**
         * Store all request parameters in this variable; avoid using direct request helpers afterward.
         */
        $requestedParams = $this->validatedRequest();

        $this->processRequestedFilters($requestedParams['filters'] ?? []);

        $this->processRequestedSorting($requestedParams['sort'] ?? []);

        /**
         * The `export` parameter is validated as a boolean in the `validatedRequest`. An `empty` function will not work,
         * as it will always be treated as true because of "0" and "1".
         */
        isset($requestedParams['export']) && (bool) $requestedParams['export']
            ? $this->processRequestedExport($requestedParams['format'] ?? null)
            : $this->processRequestedPagination($requestedParams['pagination'] ?? []);
    }

    /**
     * Prepare all the setup for datagrid.
     */
    protected function sanitizeRow($row): \stdClass
    {
        /**
         * Convert stdClass to array.
         */
        $tempRow = json_decode(json_encode($row), true);

        foreach ($tempRow as $column => $value) {
            if (! is_string($tempRow[$column])) {
                continue;
            }

            if (is_array($value)) {
                return $this->sanitizeRow($tempRow[$column]);
            } else {
                $row->{$column} = strip_tags($value);
            }
        }

        return $row;
    }

    /**
     * Format columns.
     */
    protected function formatColumns(): array
    {
        $columns = [];
        foreach ($this->columns as $column) {
            $columns[] = $column->toArray();
        }

        return $columns;
    }

    /**
     * Format actions.
     */
    protected function formatActions(): array
    {
        $actions = [];
        foreach ($this->actions as $action) {
            $actions[] = $action->toArray();
        }

        return $actions;
    }

    /**
     * Format mass actions.
     */
    protected function formatMassActions(): array
    {
        $massActions = [];
        foreach ($this->massActions as $action) {
            $massActions[] = $action->toArray();
        }

        return $massActions;
    }

    /**
     * Format records.
     */
    protected function formatRecords($params, $isExport = false): array
    {
        // Update last view

        if ($this->save_search) {
            // $params = $this->update('view', $this->save_search, $params);
            $this->queryBuilder = $params;
        }

        // Default pagination values
        try {
            $default_params = [
                'page' => $params['page'] ?? 1,
                'items_per_page' => $params['per_page'] ?? $this->itemsPerPage,
            ];

            $params = array_merge($default_params, $this->queryBuilder);

            if (!empty($this->queryBuilder['condition'])) {
                $params['conditions'] = array_merge($params['conditions'], $this->queryBuilder['condition']);
            }

            // Base variables
            $condition = $join = $group = $limit = '';

            $tablename      = $params['tablename'];
            $fields         = $params['fields'];
            $joins          = $params['joins']      ?? [];
            $groups         = $params['groups']     ?? [];
            $conditions     = $params['conditions'] ?? [];

            // Build SELECT fields
            $select_fields = implode(', ', $fields);

            // Build JOINs
            foreach ($joins as $j) {
                $join .= " $j ";
            }

            // Example conditions (you can extend as needed)
            foreach ($conditions as $c) {
                $condition .= $c;
            }

            // Example conditions (you can extend as needed)
            foreach ($groups as $g) {
                $group .= $g;
            }

            if ($group) {
                $group = " GROUP BY $group";
            }

            // Sorting
            $sort_column    = $params['column'];
            $sort_order     = $params['order'];
            $sorting        = " ORDER BY {$sort_column} {$sort_order}";

            // Pagination
            if (!empty($params['items_per_page'])) {
                $sql = "SELECT count(*) as total_items FROM {$tablename} {$join} WHERE 1 {$condition} {$group}";
                $total_items = mysqli_fetch_assoc(DB::get()->get->query($sql));
                
                $params = array_merge($params, $this->pagination($total_items, $params['items_per_page'], $params['page']));                
                $offset = $params['offset'] ?? 0;

                $limit = " LIMIT {$offset}, {$params['items_per_page']}";
            }

            $sql = "SELECT {$select_fields} FROM {$tablename} {$join} WHERE 1 {$condition} {$group} {$sorting} {$limit}";
            
            $records = mysqli_fetch_all(DB::get()->get->query($sql), MYSQLI_ASSOC);
            // Convert each record to an object
            $records = array_map(function ($record) {
                return (object) $record;
            }, $records);

            if (!empty($records)) {
                foreach ($records as $record) {
                    $record = $this->sanitizeRow($record);                    
                    foreach ($this->columns as $column) {
                        if ($closure = $column->getClosure()) {
                            $index_name = explode('.',$column->getIndex())[1] ?? $column->getIndex();
                            $record->{$index_name} = $closure($record);
                        }
                    }

                    $record->actions = [];

                    foreach ($this->actions as $index => $action) {
                        $getUrl = $action->url;

                        $record->actions[] = [
                            'index' => !empty($action->index) ? $action->index : 'action_' . ($index + 1),
                            'icon'   => $action->icon,
                            'title'  => $action->title,
                            'class'  => $action->class,
                            'method' => $action->method,
                            'url'    => $getUrl($record),
                            'type'   => $action->type,
                        ];
                    }
                }
            }

            $this->paginator['page']            = $params['page'];
            $this->paginator['per_page']        = $params['items_per_page'];
            $this->paginator['items_per_page']  = $params['items_per_page'];
            $this->paginator['total_items']     = $params['total_items'];
            $this->paginator['primary_column']  = $this->primaryColumn;

            return ['records' => $records, 'meta' => $this->paginator];
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    /**
     * Format data.
     */
    protected function formatData(): array
    {

        $collection = [
            'id'           => md5(get_called_class() . uniqid('', true)),
            'columns'      => $this->formatColumns(),
            'actions'      => $this->formatActions(),
            'mass_actions' => $this->formatMassActions(),
        ];

        $collection = array_merge($collection, $this->formatRecords($this->queryBuilder));

        $_REQUEST = array_merge($_REQUEST, $collection['meta'] ?? []); // append the requests into $_REQUEST
        $_REQUEST = array_merge($_REQUEST, ['sort_order_rev' => $this->queryBuilder['order'], 'sort_by' => $this->queryBuilder['column']]); // append the requests into $_REQUEST
        return [json_decode(json_encode($collection), true), $_REQUEST];
    }


    /**
     * Dispatch event.
     */
    protected function dispatchEvent(string $eventName, $payload): void
    {
        $reflection = new \ReflectionClass($this);
        $datagridName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $reflection->getShortName())); // Convert to snake_case
    }


    /**
     * Prepare all the setup for datagrid.
     */
    protected function prepare(): void
    {

        /**
         * Prepare columns.
         */
        $this->prepareColumns();

        /**
         * Prepare actions.
         */
        $this->prepareActions();

        /**
         * Prepare mass actions.
         */
        $this->prepareMassActions();

        /**
         * Prepare query builder.
         */
        $this->setQueryBuilder($this->prepareQueryBuilder());

        /**
         * Process request.
         */
        $this->processRequest();
    }
}
