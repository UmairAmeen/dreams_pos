@extends('layouts.app') 

  @section('content')

  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Product List</h4>
        <h6>Manage your Products</h6>
      </div>
      <div class="page-btn">
        <a href="{{route('product.create')}}" class="btn btn-added">
          <img src="{{asset('theme/assets/img/icons/plus.svg')}}" class="me-2" alt="img">Add Product </a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
      @if (Session::has('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Success!</strong> {{Session::get('success')}}
          </div>    
        @endif
        <div id="gridContainer"></div>
      </div>
    </div>
  </div>

  @endsection()

  @section('script')
    <script>
      var instance = null;

      $(() => {
      function isNotEmpty(value) {
      return value !== undefined && value !== null && value !== '';
      }
      //   Globalize.culture().numberFormat.currency.symbol = "Rs.";

      const store = new DevExpress.data.CustomStore({
      key: 'id',
      load(loadOptions) {
        const deferred = $.Deferred();
        const args = {};

        [
          'skip',
          'take',
          'requireTotalCount',
          'requireGroupCount',
          'sort',
          'filter',
          'totalSummary',
          'group',
          'groupSummary',
        ].forEach((i) => {
          if (i in loadOptions && isNotEmpty(loadOptions[i])) {
            args[i] = JSON.stringify(loadOptions[i]);
          }
        });
        $.ajax({
          url: "{{url('product_json')}}",
          dataType: 'json',
          data: args,
          success(result) {
            deferred.resolve(result.data, {
              totalCount: result.totalCount,
              summary: result.summary,
              groupCount: result.groupCount,
            });
          },
          error() {
            deferred.reject('Data Loading Error');
          },
          timeout: 5000,
        });

        return deferred.promise();
      },
      });

      instance = $('#gridContainer').dxDataGrid({
      dataSource: store,
      allowColumnReordering: true,
      allowColumnResizing: true,
      columnAutoWidth: true,
      showBorders: true,
      showColumnLines:true,
      showRowLines: true,
      rowAlternationEnabled: true,
      showClearButton: true,
      columnChooser: {
        enabled: true,
      },
      columnFixing: {
        enabled: true,
      },
      remoteOperations: true,
      paging: {
        pageSize: 10,
      },
      pager: {
        visible: true,
        allowedPageSizes: [10, 20, 50, 100],
        showPageSizeSelector: true,
        showInfo: true,
        showNavigationButtons: true,
      },
      export: {
              enabled: true,
              fileName: "Sale Order Summary",
              title: 'Export to excel'
      },
      filterRow: {
        visible: true,
        applyFilter: 'auto',
      },
      searchPanel: {
        visible: true,
        width: 240,
        placeholder: 'Search...',
      },
      headerFilter: {
        visible: true,
      },
      columns: [ {
        dataField: 'id',
        calculateCellValue: function(rowData) {
                  return rowData.id;
          },
        dataType: 'number',
        allowFiltering:true,
        sortOrder: "desc",
          width: 100,
      },
      {
        dataField: 'name',
        dataType: 'string',
        caption:"Product Name",
        showClearButton: true,
      },
      {
        dataField: 'category_name',
        dataType: 'string',
        caption:"Category Name",
        showClearButton: true,
      },
      {
        dataField: 'brand_name',
        dataType: 'string',
        caption:"Brand Name",
        showClearButton: true,
      },
      {
        dataField: 'description',
        dataType: 'string',
        caption:"Description",
        showClearButton: true,
      },
      {
        dataField: 'quantity',
        dataType: 'string',
        caption:"QTY",
        showClearButton: true,
      },
      {
        dataField: 'price',
        dataType: 'string',
        caption:"Price",
        showClearButton: true,
      },
      {
        dataField: 'tax',
        dataType: 'string',
        caption:"Tax",
        showClearButton: true,
      },
      {
        dataField: 'status',
        dataType: 'string',
        caption:"Status",
        showClearButton: true,
      },
    ],
      }).dxDataGrid('instance');
      });
    </script>
  @endsection()